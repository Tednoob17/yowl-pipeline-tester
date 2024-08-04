<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHaveAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            $user = auth()->user();

            $age = Carbon::parse($user->birthdate)->age;

            if ($age < 13 || $age > 35) {
                return response()->json([
                    "success" => false,
                    "message" => "This platfrom allow only people with age between 13 and 35 years old"
                ], 403);
            }
        }

        return $next($request);
    }
}
