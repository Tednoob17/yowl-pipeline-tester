<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('reports', ReportController::class);
Route::apiResource('permissions', UserPermissionController::class);
Route::apiResource('roles', UserRoleController::class);

Route::post('/signup', [AuthController::class, 'register']);
