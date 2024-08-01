<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\StoreRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('user')->paginate(10);

        return response()->json([
            "status" => "success",
            "notes" => $notes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try
        {
            $note = Note::create([
                'stars' => $request->stars,
                'user_from_id' => $request->user()->id,
                'user_to_id' => $request->user_to_id
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Note created successfully",
                "note" => $note
            ], 201);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Internal server error"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        try
        {
            $note = Note::with('user')->find($note->id);
            return response()->json([
                "status" => "success",
                "note" => $note
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Note not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        try
        {
            $note->update([
                'stars' => $request->stars
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Note updated successfully",
                "note" => $note
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Internal server error"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($note)
    {
        try
        {
            $note->delete();
            return response()->json([
                "status" => "success",
                "message" => "Note deleted successfully"
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Internal server error"
            ], 500);
        }
    }
}
