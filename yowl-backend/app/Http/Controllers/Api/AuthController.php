<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        // if (Auth::guest()) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bithdate'=>$request->birthdate,
            'password' => Hash::make($request->password),
            'terms' => $request->terms
        ]);

        $success = ["access_token" => $user->createToken("authToken")->plainTextToken];

        return $this->handleResponse($success, "User succesfully createed");
        // } else {
        //     return $this->handleResponse("Unauthorized to register again",  "Already registred and connected", Response::HTTP_FORBIDDEN);
        // }
    }
}
