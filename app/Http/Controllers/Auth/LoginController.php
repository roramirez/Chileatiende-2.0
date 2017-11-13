<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backend';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('layouts/layout',[
            'title' => 'Login',
            'content' => view('auth/login')
        ]);
    }

    public function redirectToProvider()
    {
        return Socialite::driver('claveunica')->redirect();
    }


    public function handleProviderCallback()
    {
        $user = Socialite::driver('claveunica')->user();
        $authUser = User::where('run',$user->run)->first();
        if (!$authUser) {
            $authUser = new User();
        }
        $authUser->email = null;
        $authUser->run = $user->run;
        $authUser->dv = $user->dv;
        $authUser->first_name = $user->first_name;
        $authUser->last_name = $user->last_name;
        //$authUser->access_token = $user->token;
        //$authUser->refresh_token = $user->refreshToken;
        $authUser->save();

        Auth::login($authUser, true);
        return redirect('/');
    }
}
