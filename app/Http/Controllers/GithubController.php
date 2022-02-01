<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class GithubController extends Controller
{
    public function auth()
    {
        return Socialite::driver('github')->redirect();
    }


    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();
    
        $user = User::where('github_id', $githubUser->id)->first();

        if ($user) {
            $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
        } else {
            // validate uniqueness of the email
            $validator = Validator::make(["email" => $githubUser->email], [
            'email' => ['required', "unique:users"]
        ]);

            if ($validator->fails()) {
                return redirect('/login')
                        ->withErrors($validator);

                // create new user with github information
                $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password'=>$githubUser->token,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
            }

            Auth::login($user);

            return redirect('/posts');
        }
    }
}

