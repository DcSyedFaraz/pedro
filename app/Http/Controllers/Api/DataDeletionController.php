<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class DataDeletionController extends BaseController
{
    /**
     * Request data deletion - send verification code to user's email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestDeletion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors()->toArray(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendError('No account found with this email address.', [], 404);
        }

        // Generate a 6-digit verification code
        $verificationCode = random_int(100000, 999999);

        // Store the code in cache for 15 minutes with email as key
        $cacheKey = 'deletion_verification_' . md5($request->email);
        Cache::put($cacheKey, [
            'code' => $verificationCode,
            'email' => $request->email,
            'timestamp' => now(),
        ], now()->addMinutes(15));

        // Send verification email
        try {
            Mail::send('data-deletion.emails.verification-code', [
                'code' => $verificationCode,
                'user' => $user
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Data Deletion Verification Code');
            });
        } catch (\Exception $e) {
            return $this->sendError('Failed to send verification email. Please try again.', [], 500);
        }

        return $this->sendResponse([
            'email' => $request->email,
            'expires_in_minutes' => 15,
        ], 'Verification code sent to your email.');
    }

    /**
     * Verify the code sent to user's email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verification_code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors()->toArray(), 422);
        }

        $cacheKey = 'deletion_verification_' . md5($request->email);
        $cachedData = Cache::get($cacheKey);

        if (!$cachedData) {
            return $this->sendError('Verification session expired. Please request a new code.', [], 410);
        }

        // Verify the code and email
        if ($request->email !== $cachedData['email'] || $request->verification_code != $cachedData['code']) {
            return $this->sendError('Invalid verification code or email.', [], 422);
        }

        // Mark code as verified by updating cache
        $cachedData['verified'] = true;
        Cache::put($cacheKey, $cachedData, now()->addMinutes(15));

        return $this->sendResponse([
            'email' => $request->email,
            'verified' => true,
        ], 'Verification code is correct. You can now proceed with account deletion.');
    }

    /**
     * Confirm and execute account deletion
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmDeletion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verification_code' => 'required|digits:6',
            'confirm_deletion' => 'required|boolean|accepted',
        ], [
            'confirm_deletion.accepted' => 'You must confirm that you understand this action is irreversible.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors()->toArray(), 422);
        }

        $cacheKey = 'deletion_verification_' . md5($request->email);
        $cachedData = Cache::get($cacheKey);

        if (!$cachedData) {
            return $this->sendError('Verification session expired. Please start again.', [], 410);
        }

        // Check if code is expired (15 minutes)
        if (now()->diffInMinutes($cachedData['timestamp']) > 15) {
            Cache::forget($cacheKey);
            return $this->sendError('Verification code expired. Please request a new one.', [], 410);
        }

        // Verify the code and email
        if ($request->email !== $cachedData['email'] || $request->verification_code != $cachedData['code']) {
            return $this->sendError('Invalid verification code or email.', [], 422);
        }

        // Check if code was verified
        if (!isset($cachedData['verified']) || !$cachedData['verified']) {
            return $this->sendError('Please verify your code first.', [], 422);
        }

        // Find the user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendError('User account not found.', [], 404);
        }

        DB::beginTransaction();

        try {
            // Delete related data
            if ($user->customer) {
                // Delete customer related data
                $user->customer->delete();
            }

            if ($user->userdetail) {
                // Delete vendor/company profile
                $user->userdetail->delete();
            }

            // Delete company documents
            if ($user->files) {
                $user->files()->delete();
            }

            // Delete services relationships
            $user->services()->detach();
            $user->areasOfWork()->detach();

            // Delete stored services
            $user->service()->delete();

            // Delete primary contacts
            $user->pricontact()->delete();

            // Revoke all roles and permissions
            $user->roles()->detach();
            $user->permissions()->detach();

            // Delete the user account
            $userName = $user->name;
            $userEmail = $user->email;
            $user->delete();

            DB::commit();

            // Send confirmation email
            try {
                Mail::send('data-deletion.emails.deletion-confirmed', [
                    'name' => $userName
                ], function ($message) use ($userEmail) {
                    $message->to($userEmail)
                        ->subject('Account Deletion Confirmed');
                });
            } catch (\Exception $e) {
                // Log but don't fail the deletion process
                \Log::error('Failed to send deletion confirmation email: ' . $e->getMessage());
            }

            // Clear cache data
            Cache::forget($cacheKey);

            return $this->sendResponse([
                'deleted' => true,
                'email' => $userEmail,
            ], 'Account has been successfully deleted.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Data deletion failed: ' . $e->getMessage());
            return $this->sendError('Failed to delete account. Please contact support.', [], 500);
        }
    }

    /**
     * Resend verification code
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors()->toArray(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendError('No account found with this email address.', [], 404);
        }

        // Generate a new 6-digit verification code
        $verificationCode = random_int(100000, 999999);

        // Store the code in cache
        $cacheKey = 'deletion_verification_' . md5($request->email);
        Cache::put($cacheKey, [
            'code' => $verificationCode,
            'email' => $request->email,
            'timestamp' => now(),
        ], now()->addMinutes(15));

        // Send verification email
        try {
            Mail::send('data-deletion.emails.verification-code', [
                'code' => $verificationCode,
                'user' => $user
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Data Deletion Verification Code');
            });

            return $this->sendResponse([
                'email' => $request->email,
                'expires_in_minutes' => 15,
            ], 'New verification code sent to your email.');
        } catch (\Exception $e) {
            return $this->sendError('Failed to send verification email. Please try again.', [], 500);
        }
    }
}
