<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with(['user', 'messages'])->paginate(10);

        return response()->json([
            "success" => true,
            "rooms" => $rooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        try
        {
            $room = Room::create([
                'name' => $request->name,
                'description' => $request->description,
                'password' => $request->password,
                'user_id' => $request->user()->id,
            ]);

            if($request->has('users') && count($request->users) > 1)
            {
                $room->users()->attach($request->users);
            }

            return response()->json([
                "success" => true,
                "room" => $room,
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($room)
    {
        try
        {
            $room = Room::find($room);

            return response()->json([
                "success" => true,
                "room" => $room,
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $room)
    {
        try
        {
            $room = Room::find($room);

            $room->update([
                'name' => $request->name,
                'description' => $request->description,
                'password' => $request->password,
                'user_id' => $request->user()->id,
            ]);

            return response()->json([
                "success" => true,
                "room" => $room,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($room)
    {
        try
        {
            $room = Room::find($room);

            $room->delete();

            return response()->json([
                "success" => true,
                "message" => "Room deleted successfully",
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
