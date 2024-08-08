<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $average = Post::avg('vues');
        $post_hot = Post::with(['user', 'likes', 'comment', 'comment.user', 'images'])->where('vues', '>', $average)->orderBy('vues', 'desc')->limit(10)->get();
        $post_recent = Post::with(['user', 'likes', 'comment', 'comment.user', 'images'])->orderBy('created_at', 'desc')->limit(10)->get();
        $post_all = Post::with(['user', 'likes', 'images'])->withCount('comment', 'likes')->paginate(5);

        return response()->json([
            "success" => true,
            "post_hot" => $post_hot,
            "post_recent" => $post_recent,
            "post_all" => $post_all,
        ]);
    }

    public function imcrementVue($post): JsonResponse
    {
        try {
            $post = Post::find($post);
            $post->vues += 1;
            $post->save();

            return response()->json([
                "success" => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function show($post): JsonResponse
    {
        try {
            $post = Post::with(['user', 'likes', 'comment', 'comment.user', 'images'])->withCount('comment', 'likes')->find($post);
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
     * Create a new Post
     */
    public function store(StoreRequest $request): JsonResponse
    {
        // dd($request);

        try {
            $request->link = str_replace('http', 'https', $request->link);

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

                if ($request->hasFile('file')) {
                    // $request->file('file')->isValid()

                    foreach ($request->file as $file) {

                        if ($file->isValid()) {
                            $post_image = new PostImage();

                            $post_image->post_id = $post->id;

                            $path = public_path('images/posts/');
                            !is_dir($path) &&
                                mkdir($path, 0777, true);

                            $post_image->path = "posts/" . time() . '.' . $file->extension();

                            $file->move($path, $post_image->path);

                            $base_url = url('/');
                            $post_image->path =  "$base_url/images/$post_image->path";

                            $post_image->save();
                        }
                    }
                }

                $post = Post::with(['user', 'comment', 'images'])->find($post);

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
                "message" => "Post updated successfully",
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
