<?php

use App\Mail\VerificationMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\PersonalAccessToken;

Route::get('/email/verify/{token}', function (Request $request) {
    Mail::to($request->user())->send(new VerificationMail($this->token));
    return response()->json(['message' => 'Email verification link sent']);
})->name('verification.notice');

Route::get('/email/verify/{token}', function ($token) {

    $user = PersonalAccessToken::findToken($token)->tokenable;

    if (!$user) {
        return Redirect::to('http://localhost:5173/login');
    }

    $user->markEmailAsVerified();

    Redirect::to('http://localhost:5173/login');

})->name('mail.verify');
