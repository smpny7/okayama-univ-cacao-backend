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
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RegisterBodyTempRequest $request
     * @param $student_id
     * @return JsonResponse
     */
    public function registerBodyTemp(RegisterBodyTempRequest $request, $student_id): JsonResponse
    {
        $student = new Student;
        $club_id = $request->input('club_id');

        if (Club::query()->where('id', $club_id)->doesntExist())
            return $this->_errorResponse('Club is invalid.');
        if (!is_null($student->getActiveClubId($student_id)))
            return $this->_errorResponse('Bad request.');
        // TODO: 体温 float確認

        $this->_setInRoom($student_id, $club_id, floatval($request->input('body_temp')));

        return response()->json(['success' => true]);
    }


    /**
     * @param $student_id
     * @param $club_id
     * @param $body_temp
     * @return void
     */
    private function _setInRoom($student_id, $club_id, $body_temp): void
    {
        Activity::query()->create([
            'student_id' => $student_id,
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
