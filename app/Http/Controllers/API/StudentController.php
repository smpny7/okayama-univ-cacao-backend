<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterBodyTempRequest;
use App\Models\Activity;
use App\Models\Club;
use App\Models\Student;
use App\Models\Visitor;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RegisterBodyTempRequest $request
     * @return JsonResponse
     */
    public function status(Request $request): JsonResponse
    {
        $student = new Student;
        $student_id = $request->input('student_id');

        $active_club = $student->getActiveClub($student_id);
        $is_my_room = $active_club == $request->user()->id;
        return response()->json(['success' => true, 'data' => ['active_club' => $active_club, 'is_my_room' => $is_my_room]]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param RegisterBodyTempRequest $request
     * @return JsonResponse
     */
    public function enter(RegisterBodyTempRequest $request): JsonResponse
    {
        $student = new Student;
        $student_id = $request->input('student_id');
        $club_id = $request->user()->id;

        if (!is_null($student->getActiveClubId($student_id)))
            return $this->_errorResponse('Bad request.');
        // TODO: 体温 float確認

        $this->_enterRoom($student_id, $club_id, floatval($request->input('body_temp')));

        return response()->json(['success' => true]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param RegisterBodyTempRequest $request
     * @return JsonResponse
     */
    public function leave(Request $request): JsonResponse //TODO: Request Model
    {
        $student = new Student;
        $student_id = $request->input('student_id');
        $club_id = $request->user()->id;

        if (is_null($student->getActiveClubId($student_id))) // TODO: isInRoom (Student Model)
            return $this->_errorResponse('Bad request.');

        $this->_leaveRoom($student_id, $club_id);

        return response()->json(['success' => true]);
    }


    /**
     * @param $student_id
     * @param $club_id
     * @param $body_temp
     * @return void
     */
    private function _enterRoom($student_id, $club_id, $body_temp): void
    {
        Activity::query()->create([
            'student_id' => $student_id,
            'club_id' => $club_id,
            'body_temp' => $body_temp,
            'physical_condition' => '良好',
            'stifling' => 'なし',
            'fatigue' => 'なし',
            'in_time' => new DateTime(),
        ]);

        Visitor::query()->create([
            'student_id' => $student_id,
            'club_id' => $club_id,
        ]);
    }


    /**
     * @param $student_id
     * @param $club_id
     * @return void
     */
    private function _leaveRoom($student_id, $club_id): void
    {
        Activity::query()->orderByDesc('id')
            ->where('student_id', $student_id)->where('club_id', $club_id)->first()
            ->update([
                'out_time' => new DateTime(),
            ]);

        Visitor::query()->where('student_id', $student_id)->delete();
    }


    /**
     * @param $error_message
     * @return JsonResponse
     */
    private function _errorResponse($error_message): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $error_message,
        ], 400);
    }
}
