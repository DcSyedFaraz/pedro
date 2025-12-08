<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register_form()
    {

        $data['roles'] = Role::select(['id', 'name'])
            ->where(function ($query) {
                $query->where('name', '!=', 'Admin');
                $query->where('name', '!=', 'account manager');
            })->get();
        return view('auth.register', $data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->merge([
            'name' => $this->sanitizeName($request->input('name', '')),
        ]);

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request. Names are restricted
     * to letters, numbers, spaces, apostrophes, dashes and dots, and URLs are blocked.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?!.*(https?:\\/\\/|www\\.))[\\pL\\pM0-9\\s\'\\-.]{2,255}$/u',
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm-password'],
            'roles' => 'required',
            'phonenumber' => 'nullable',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $cleanName = $this->sanitizeName($data['name']);

        $user = User::create([
            'name' => $cleanName,
            'email' => $data['email'],
            'phone' => $data['phonenumber'] ?? null,
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['roles']);
        Session::flash('success', 'User created successfully');
        return $user;
    }

    /**
     * Remove tags, collapse whitespace and trim the provided name.
     */
    protected function sanitizeName(string $name): string
    {
        $name = strip_tags($name);
        $name = preg_replace('/\s+/', ' ', $name);

        return trim($name);
    }


}
