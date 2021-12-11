<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetRoomNameFromIDRequest;
use App\Models\Room;
use App\Models\Visitor;
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
     * @param GetRoomNameFromIDRequest $request
     * @return JsonResponse
     */
    public function getRoomNameFromID(GetRoomNameFromIDRequest $request): JsonResponse
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


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function oucrc(): JsonResponse
    {
        $room_id = env('OUCRC_UUID');
        Room::query()->findOrFail($room_id);

        $visitors = Visitor::query()->where('room_id', $room_id)->get(['student_id', 'created_at']);

        return response()->json(['success' => true, 'data' => $visitors]);
    }
}
