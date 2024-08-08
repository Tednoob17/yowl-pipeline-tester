<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\UserSettingsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExtensionWebController;
use App\Http\Controllers\LikeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function () {
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
    Route::apiResource('comments', CommentController::class);
    Route::post('comments/{post}', [CommentController::class, 'getPostComments']);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('messages', MessageController::class);

    // post route
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::get('posts/vues/{post}', [PostController::class, 'vues']);

    // likes route
    Route::get('likes/{post}', [LikeController::class, 'index']); // get all likes for a post
    Route::post('likes', [LikeController::class, 'store']); // like or unlike a post

    // settings
    Route::get('/user-set', [UserSettingsController::class, 'index']);
    // enable 2fa
    Route::post('/enablefa', [UserSettingsController::class, 'enable2fa']);

    // update user profile
    Route::put('/update-profile', [UserSettingsController::class, 'update']);
    // delete user profile
    Route::delete('/delete-profile', [UserSettingsController::class, 'deleteAccount']);
});

Route::get('posts', [PostController::class, 'index']);

Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::post('/extension-web', [ExtensionWebController::class, 'create']);
Route::get('/extension-web/{id}', [ExtensionWebController::class, 'get']);

require __DIR__ . '/auth/email.php';
