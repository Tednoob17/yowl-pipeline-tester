<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;


Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});


Route::get('/auth/github', [GithubController::class, 'redirect'])->name('auth.github');

Route::get('/auth/github/callback', [GithubController::class, 'callback']);


Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("/dashboard", function () {
        return Inertia::render("Dashboard");
    })->name("dashboard");
});
