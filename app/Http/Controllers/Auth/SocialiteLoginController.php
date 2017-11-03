<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('claveunica')->scopes(['openid run name'])->redirect();
    }


    public function handleProviderCallback()
    {
        $user = Socialite::driver('claveunica')->user();
        $authUser = User::where('run',$user->run)->first();
        if (!$authUser) {
            $authUser = new User();
        }
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
