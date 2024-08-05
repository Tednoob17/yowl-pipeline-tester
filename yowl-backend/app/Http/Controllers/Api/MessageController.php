<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($room_id)
    {
        $messages = Message::where('room_id', $room_id)->with('user')->paginate(10);

        return response()->json([
            "success" => true,
            "data" => $messages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try
        {
            $message = new Message();
            $message->user_id = $request->user_id;
            $message->room_id = $request->room_id;
            $message->content = $request->content;
            $message->save();

            return response()->json([
                "success" => true,
                "data" => $message
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show($message)
    {
        try
        {
            $message = Message::find($message);

            return response()->json([
                "success" => true,
                "data" => $message
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $message)
    {
        try
        {
            $message = Message::find($message);
            $message->content = $request->content;
            $message->save();

            return response()->json([
                "success" => true,
                "data" => $message
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($message)
    {
        try
        {
            $message = Message::find($message);
            $message->delete();

            return response()->json([
                "success" => true,
                "message" => "Message deleted successfully"
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
