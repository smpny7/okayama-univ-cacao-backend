<?php

namespace App\Http\Controllers;


use App\Models\Activity;
use App\Models\Room;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the student.
     *
     * @return View
     */
    public function index(): View
    {
        return view('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $student_id = strtoupper($request->input('student_id'));
        $activities = Activity::query()
            ->whereBetween('in_time', [Carbon::today()->subMonth(), Carbon::today()])
            ->where('student_id', $student_id)
            ->orderByDesc('in_time')
            ->with('room')
            ->get();

        $average_temp = Activity::query()->where('student_id', $student_id)->average('body_temp');
        $room_id = Visitor::query()->where('student_id', $student_id)->orderByDesc('id')->first('room_id');
        $current_room = $room_id ? Room::query()->findOrFail($room_id)->get('name') : null;

        return view('students.show')
            ->with('student_id', $student_id)
            ->with('average_temp', round($average_temp, 1))
            ->with('current_room', $current_room)
            ->with('activities', $activities);
    }
}
