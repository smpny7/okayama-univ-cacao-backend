<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnterRequest;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\StatusRequest;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Visitor;
use DateTime;
use Illuminate\Http\JsonResponse;
use Throwable;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param StatusRequest $request
     * @return JsonResponse
     */
    public function status(StatusRequest $request): JsonResponse
    {
        $student = new Student;
        $student_id = $request->input('student_id');

        $active_room = $student->getActiveRoom($student_id);
        $is_my_room = $active_room == $request->user()->id;
        return response()->json(['success' => true, 'data' => ['active_room' => $active_room, 'is_my_room' => $is_my_room]]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param EnterRequest $request
     * @return JsonResponse
     */
    public function enter(EnterRequest $request): JsonResponse
    {
        $student = new Student;
        $student_id = $request->input('student_id');
        $room_id = $request->user()->id;

        if (!is_null($student->getActiveRoomId($student_id)))
            return $this->_errorResponse();

        try {
            $body_temp = floatval($request->input('body_temp'));

            $this->_enterRoom($student_id, $room_id, $body_temp);

            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'errors' => 'Invalid Body Temperature.',
            ], 400);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @param LeaveRequest $request
     * @return JsonResponse
     */
    public function leave(LeaveRequest $request): JsonResponse
    {
        $student = new Student;
        $student_id = $request->input('student_id');
        $room_id = $request->user()->id;

        if (is_null($student->getActiveRoomId($student_id)))
            return $this->_errorResponse();

        $this->_leaveRoom($student_id, $room_id);

        return response()->json(['success' => true]);
    }


    /**
     * @param $student_id
     * @param $room_id
     * @param $body_temp
     * @return void
     */
    private function _enterRoom($student_id, $room_id, $body_temp): void
    {
        Activity::query()->create([
            'student_id' => $student_id,
            'room_id' => $room_id,
            'body_temp' => $body_temp,
            'physical_condition' => '良好',
            'stifling' => 'なし',
            'fatigue' => 'なし',
            'in_time' => new DateTime(),
        ]);

        Visitor::query()->create([
            'student_id' => $student_id,
            'room_id' => $room_id,
        ]);
    }


    /**
     * @param $student_id
     * @param $room_id
     * @return void
     */
    private function _leaveRoom($student_id, $room_id): void
    {
        $activity = Activity::query()->orderByDesc('id')
            ->where('student_id', $student_id)->where('room_id', $room_id)->first();

        if (!is_null($activity)) $activity->update([
            'out_time' => new DateTime(),
        ]);

        Visitor::query()->where('student_id', $student_id)->delete();
    }


    /**
     * @return JsonResponse
     */
    private function _errorResponse(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => 'Bad request.',
        ], 400);
    }
}
