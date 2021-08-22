<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getRoomName(Request $request): JsonResponse
    {
        $room_name = $request->user()->name;
        return response()->json([
            'success' => true,
            'data' => $room_name,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getRoomNameFromID(Request $request): JsonResponse
    {
        /**
         * @var Room $room
         **/
        $room_id = $request->input('room_id');
        $room = Room::query()->find($room_id);

        if (is_null($room)) return response()->json([
            'success' => false,
            'errors' => ['Invalid Room ID.'],
        ]);

        return response()->json([
            'success' => true,
            'data' => $room->name,
        ]);
    }
}
