<?php

namespace App\Http\Controllers;

use App\Models\ExtensionWeb;
use Illuminate\Http\Request;

class ExtensionWebController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'link' => 'url|required'
        ]);

        $extensionWeb = ExtensionWeb::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Extension web created',
            'extensionWeb' => $extensionWeb
        ], 201);
    }

    public function get($id)
    {
        $extensionWeb = ExtensionWeb::find($id);

        if (!$extensionWeb) {
            return response()->json([
                'success' => false,
                'message' => 'Extension web not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'extensionWeb' => $extensionWeb
        ]);
    }
}
