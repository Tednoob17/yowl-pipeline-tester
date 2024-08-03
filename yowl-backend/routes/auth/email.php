<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Email verification link sent']);
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    // $request->fulfill();

    return response()->json([
        'success' => true,
        'message' => 'Email successfully verified',
        'data' => $request->user(),
    ]);

})->name('verification.verify');
