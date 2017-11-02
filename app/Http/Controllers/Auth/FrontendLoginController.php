<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FrontendLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('claveunica')->redirect();
    }


    public function handleProviderCallback()
    {
        $user = Socialite::driver('claveunica')->user();
        $authUser = User::where('rut',$user->rut)->first();
        if (!$authUser) {
            $authUser = new User();
        }
        $authUser->rut = $user->rut;
        $authUser->dv = $user->dv;
        $authUser->email = $user->email;
        $authUser->name = $user->name;
        $authUser->access_token = $user->token;
        $authUser->refresh_token = $user->refreshToken;
        $authUser->extra = $user->extra;
        $authUser->save();

        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
}
