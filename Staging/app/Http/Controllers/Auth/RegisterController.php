<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    protected function redirectTo()
    {
        $role = Auth()->user()->user_type;
        if($role == 'super_admin'){
            return 'admin/dashboard';
        }
        elseif($role == 'client')
        {
            return 'client/dashboard';
        }
        elseif($role == 'admin'){
            return 'app/dashboard';
        }
        else{
            return back();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required'],
            'company_id' => ['required'],
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
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => $data['user_type'],
            'company_id' => $data['company_id'],
        ]);

        $invitation = Invitation::where('email', $user->email)->firstOrFail();
        $invitation->registered_at = $user->created_at;
        $invitation->save();

        return $user;
    }

    public function showRegistrationForm(Request $request)
    {
    $invitation_token = $request->get('invitation_token');

    $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();

    $email = $invitation->email;
    $is_admin = $invitation->is_admin;
    $company_id = $invitation->company_id;

    return view('auth.register', compact('email', 'is_admin', 'company_id'));

    }
}
