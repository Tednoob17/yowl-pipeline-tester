<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::with(['user', 'likes'])->get();
        foreach ($posts as $post) {
            $post["medias"] = $post->getMedia();
        }
        //, 'comment', 'comment.user', 'comment.comment', 'comment.comment.user'])->paginate(10);

        return response()->json([
            "success" => true,
            "posts" => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function show($post): JsonResponse
    {
        try {
            $post = Post::with(['user', 'comment'])->find($post);
            return response()->json([
                "success" => true,
                "post" => $post,
                "media" => $post->getMedia(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a new Post
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $post = Post::where('link', $request->link)->first();

            if ($post) {
                $comment = Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::id(),
                    'content' => $request->panda,
                ]);

                return response()->json([
                    "success" => true,
                    "comment" => $comment,
                ]);
            } else {
                $post = Post::create([
                    'link' => $request->link,
                    'panda' => $request->panda,
                    'user_id' => Auth::id(),
                ]);

                $post->addAllMediaFromRequest();

                return response()->json([
                    "success" => true,
                    "post" => $post,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $post): JsonResponse
    {
        try {
            $post = Post::find($post);
            $post->update([
                'link' => $request->link,
                'panda' => $request->panda,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                "success" => true,
                "post" => $post,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post): JsonResponse
    {
        try {
            $post = Post::find($post);
            $post->delete();

            return response()->json([
                "success" => true,
                "message" => "Post deleted successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
