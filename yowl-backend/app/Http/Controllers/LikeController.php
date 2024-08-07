<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($post)
    {
        $likes = Like::where('post_id', $post)->with('user')->get();

        return response()->json([
            "success" => true,
            "likes" => $likes,
        ]);
    }

    // if exists, remove like, else create like
    public function store(Request $request)
    {
        try
        {
            $like = Like::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first();
            if ($like)
            {
                $like->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Like removed.',
                ]);
            }
            else
            {
                $like = Like::create($request->all());
                return response()->json([
                    'success' => true,
                    'message' => 'Like created.',
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
