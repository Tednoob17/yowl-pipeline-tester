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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($like)
    {
        try
        {
            $like = Like::find($like);
            $like->delete();

            return response()->json([
                "success" => true,
                "message" => "Like deleted successfully",
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
