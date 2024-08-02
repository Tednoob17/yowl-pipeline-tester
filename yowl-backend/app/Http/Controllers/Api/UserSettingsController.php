<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return response()->json([
            "status" => "success,",
            "user" => $user
        ], 200);
    }

    public function enable2fa(Request $request)
    {
        $user = auth()->user();

        // $user->twoFactorAuthenticatable()->enableTwoFactorAuth();

        return response()->json([
            "status" => "success",
            "message" => "2FA enabled successfully",
            "user" => $user
        ], 200);
    }

    public function disable2fa(Request $request)
    {
        $user = auth()->user();

        // $user->twoFactorAuthenticatable()->disableTwoFactorAuth();

        return response()->json([
            "status" => "success",
            "message" => "2FA disabled successfully",
            "user" => $user
        ], 200);
    }

    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(UserUpdateRequest $request): JsonResponse
    {
        $user = auth()->user();

        if (isset($request->photo)) {
            $user->updateProfilePhoto($request->photo);
        }

        if ($request->birthdate) {
            $user->update([
                'birthdate' => $request->birthdate
            ]);
        }

        if (
            $request->email !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $request);
        } else {
            $user->forceFill([
                'name' => $request->name,
                'email' => $request->email
            ])->save();
        }

        return response()->json([
            "status" => "success",
            "message" => "Profile updated successfully",
            "user" => $user
        ], 200);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, Request $request): void
    {
        $user->forceFill([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}

