<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse
    {
        $age=Carbon::parse($request->birthdate)->age;
        if($age < 13 || $age > 35){
            return $this->handleResponse("", "This platfrom allow only people with age between 13 and 35 years old", 403, false);
        }else{
        // if (Auth::guest()) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bithdate' => $request->birthdate,
            'password' => Hash::make($request->password),
            'terms' => $request->terms
        ]);

        $success = ["access_token" => $user->createToken("authToken")->plainTextToken];

        return $this->handleResponse($success, "User succesfully created");
        // } else {
        //     return $this->handleResponse("Unauthorized to register again",  "Already registred and connected", Response::HTTP_FORBIDDEN);
        // }
        }
    }
}
