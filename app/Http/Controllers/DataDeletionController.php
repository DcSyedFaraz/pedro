<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class DataDeletionController extends Controller
{
    /**
     * Show the data deletion request form
     */
    public function index()
    {
        return view('data-deletion.index');
    }

    /**
     * Verify user email and send confirmation code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No account found with this email address.');
        }

        // Generate a 6-digit verification code
        $verificationCode = random_int(100000, 999999);

        // Store the code in session with timestamp
        session([
            'deletion_verification_code' => $verificationCode,
            'deletion_user_email' => $request->email,
            'deletion_code_timestamp' => now(),
        ]);

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
            return back()->with('error', 'Failed to send verification email. Please try again.');
        }

        return view('data-deletion.confirm', [
            'email' => $request->email
        ]);
    }

    /**
     * Confirm deletion with verification code
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:6',
            'confirm_deletion' => 'required|accepted',
        ], [
            'confirm_deletion.accepted' => 'You must confirm that you understand this action is irreversible.',
        ]);

        // Check if session data exists
        $sessionEmail = session('deletion_user_email');
        $sessionCode = session('deletion_verification_code');
        $codeTimestamp = session('deletion_code_timestamp');

        if (!$sessionEmail || !$sessionCode || !$codeTimestamp) {
            return redirect()->route('data-deletion.index')
                ->with('error', 'Verification session expired. Please start again.');
        }

        // Check if code is expired (15 minutes)
        if (now()->diffInMinutes($codeTimestamp) > 15) {
            session()->forget(['deletion_verification_code', 'deletion_user_email', 'deletion_code_timestamp']);
            return redirect()->route('data-deletion.index')
                ->with('error', 'Verification code expired. Please request a new one.');
        }

        // Verify the code and email
        if ($request->email !== $sessionEmail || $request->verification_code != $sessionCode) {
            return back()->with('error', 'Invalid verification code or email.');
        }

        // Find the user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('data-deletion.index')
                ->with('error', 'User account not found.');
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

            // Clear session data
            session()->forget(['deletion_verification_code', 'deletion_user_email', 'deletion_code_timestamp']);

            return redirect()->route('data-deletion.success');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Data deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete account. Please contact support.');
        }
    }

    /**
     * Show success page
     */
    public function success()
    {
        return view('data-deletion.success');
    }

    /**
     * Resend verification code
     */
    public function resendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No account found with this email address.');
        }

        // Generate a new 6-digit verification code
        $verificationCode = random_int(100000, 999999);

        // Store the code in session
        session([
            'deletion_verification_code' => $verificationCode,
            'deletion_user_email' => $request->email,
            'deletion_code_timestamp' => now(),
        ]);

        // Send verification email
        try {
            Mail::send('data-deletion.emails.verification-code', [
                'code' => $verificationCode,
                'user' => $user
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Data Deletion Verification Code');
            });

            return back()->with('success', 'New verification code sent to your email.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send verification email. Please try again.');
        }
    }
}

