<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        // dd('here');
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            // dd($user);

            $finduser = User::where('google_id', $user->id)->first();

            // dd($finduser);

            if ($finduser) {

                // dd('here');

                Auth::login($finduser);

                return redirect('/home');
            } else {

                // dd($user->id);


                $newUser = new User();

                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                // $newUser->password = encrypt('123456dummy');
                $newUser->password = encrypt(uniqid());

                $newUser->save();

                Auth::login($newUser);

                return redirect('/home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
