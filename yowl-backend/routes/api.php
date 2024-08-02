<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum',  ]], function () {
    Route::post('/update-password', [AuthController::class, 'updatePassword']);

    // profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/current-user', [AuthController::class, 'currentUser']);

    // ressources routes
    Route::apiResource('reports', ReportController::class);
    Route::apiResource('permissions', UserPermissionController::class);
    Route::apiResource('roles', UserRoleController::class);
    Route::apiResource('notes', NoteController::class);
    Route::apiResource('categories', CategorieController::class);
    Route::apiResource('rooms', RoomController::class);

    // settings
    Route::get('/user-set', [UserSettingsController::class, 'index']);
    // enable 2fa
    Route::post('/enable-2fa', [UserSettingsController::class, 'enable2fa']);
    // disable 2fa
    Route::post('/disable-2fa', [UserSettingsController::class, 'disable2fa']);
    // update user profile
    Route::post('/update-profile', [UserSettingsController::class, 'update']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
