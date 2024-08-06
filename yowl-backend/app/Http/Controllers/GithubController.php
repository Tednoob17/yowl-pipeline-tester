<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GithubController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }


    public function callback(): RedirectResponse
    {
        $user = Socialite::driver('github')->user();
        $githubUser = User::updateOrCreate([
            'github_id' => $user->id
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt(request(Str::random()))
        ]);
        auth()->login($githubUser, true);
        return redirect()->intended('/dashboard');
    }
}
