<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\Api\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum',  ]], function () {
    Route::post('/update-password', [AuthController::class, 'updatePassword']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/current-user', [AuthController::class, 'currentUser']);

    Route::apiResource('reports', ReportController::class);
    Route::apiResource('permissions', UserPermissionController::class);
    Route::apiResource('roles', UserRoleController::class);
    Route::apiResource('categories', CategorieController::class);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
