<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $comments = Comment::with('user')->get();
            return response()->json([
                'status' => 'success',
                'comments' => $comments,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getPostComments($post)
    {
        try
        {
            $comments = Comment::with('user')->where('post_id', $post)->get();
            return response()->json([
                'status' => 'success',
                'comments' => $comments,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try
        {
            $comment = Comment::create($request->all());

            // $comments = Comment::with('user')->where('post_id', $request->post_id)->get();
            return response()->json([
                'status' => 'success',
                'comments' => $comment->with('user')->get(),
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($comment)
    {
        try
        {
            $comment = Comment::with('user')->find($comment);

            return response()->json([
                'status' => 'success',
                'comment' => $comment,
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $comment)
    {
        try
        {
            $comment = Comment::find($comment);
            $comment->update($request->all());

            return response()->json([
                'status' => 'success',
                'comment' => $comment,
                'message' => 'Comment updated successfully',
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($comment)
    {
        try
        {
            $comment = Comment::find($comment);
            $comment->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Comment deleted successfully',
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
