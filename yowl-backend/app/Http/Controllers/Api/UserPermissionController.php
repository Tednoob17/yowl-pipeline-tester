<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function index(): JsonResponse
    {
        $permissions = Permission::paginate(10);

        return response()->json([
            "status" => "success",
            "permissions" => $permissions,
        ], 200);
    }


    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Permission created successfully",
            "permission" => $permission,
        ], 201);
    }

    public function show($permission): JsonResponse
    {
        try
        {
            $permission = Permission::find($permission);
            return response()->json([
                "status" => "success",
                "permission" => $permission,
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Permission not found",
            ], 404);
        }
    }
}
