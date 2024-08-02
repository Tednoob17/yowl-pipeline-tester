<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])) {
            $user = User::find(auth()->user()->id);

            $success = [
                "access_token" => $user->createToken("authToken")->plainTextToken,
            ];

            return $this->handleResponse($success, "User succesfully connected");
        } else {
            return $this->handleResponse("Unauthorized to login",  "Bad email or password", Response::HTTP_FORBIDDEN);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $age = Carbon::parse($request->birthdate)->age;
        if ($age < 13 || $age > 35) {
            return $this->handleResponse("", "This platfrom allow only people with age between 13 and 35 years old", 403, false);
        } else if ($request->terms == false) {
            return $this->handleResponse("", "You must accept the terms and conditions", 403, false);
        } else {
            if (Auth::guest()) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'birthdate' => $request->birthdate,
                    'password' => Hash::make($request->password),
                    'terms' => $request->terms
                ]);

                $success = ["access_token" => $user->createToken("authToken")->plainTextToken];

                return $this->handleResponse($success, "User succesfully created");
            } else {
                return $this->handleResponse("Unauthorized to register again",  "Already registred and connected", Response::HTTP_FORBIDDEN);
            }
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request?->user()->currentAccessToken()->delete();

        return $this->handleResponse(null, "User succesfully disconnected");
    }

    public function logoutAll(Request $request): JsonResponse
    {
        $request?->user()->tokens()->delete();

        return $this->handleResponse(null, "User succesfully disconnected from all devices");
    }

    public function refresh(Request $request): JsonResponse
    {
        $request?->user()->currentAccessToken()->delete();

        $success = ["access_token" => $request?->user()->createToken("authToken")->plainTextToken];

        return $this->handleResponse($success, "User succesfully refreshed token");
    }

    public function currentUser()
    {
        return $this->handleResponse(auth()->user(), "Current auth user");
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->handleResponse("", "Email sent with password reset link")
            : $this->handleResponse("", "Email not sent", 403, false);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only(['email', 'password', 'password_confirmation', 'token']),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->handleResponse("", "Password reset successfully")
            : $this->handleResponse("", "Password not reset", 403, false);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return $this->handleResponse("", "Current password is incorrect", 403, false);
        }

        $request->user()->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return $this->handleResponse("", "Password updated successfully");
    }

    public function deleteAccount(Request $request): JsonResponse
    {
        $request->user()->delete();

        return $this->handleResponse("", "User succesfully deleted");
    }
}
