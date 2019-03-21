<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function index(){
        return view('auth/login');
    }

    public function create(){
        // this function use to create user account

    }
    public function username(){

        return 'username';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
            "email", "user_age_range", "user_birthday", "user_gender", "user_posts", "user_status"])->redirect();
    }

    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->user();
        $splitName = explode(' ', $auth_user->name, 2);
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        $user = User::updateOrCreate(
            [
                'email' => $auth_user->email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'gender' => $auth_user->user['gender'],
                'password' => md5(rand(1,10000)),
                'token' => $auth_user->token
            ]
        );
 
        Auth::login($user, true);
        return redirect()->to('/'); 
    }
}
