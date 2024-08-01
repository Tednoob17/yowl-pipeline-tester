<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index() : JsonResponse
    {
        try
        {
            $roles = Role::all();

            return response()->json([
                "status" => "success",
                "roles" => $roles,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreRequest $request) : JsonResponse
    {
        try
        {
            $role = Role::create($request->validated());

            return response()->json([
                "status" => "success",
                "role" => $role,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function show($role) : JsonResponse
    {
        try
        {
            return response()->json([
                "status" => "success",
                "role" => $role,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateRequest $request, $role) : JsonResponse
    {
        try
        {
            $role->update($request->validated());

            return response()->json([
                "status" => "success",
                "role" => $role,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($role) : JsonResponse
    {
        try
        {
            $role->delete();

            return response()->json([
                "status" => "success",
                "message" => "Role deleted successfully",
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }
}
