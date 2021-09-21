<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Room;
use Illuminate\Contracts\View\View;

class VisitorController extends Controller
{
    /**
     * Display a listing of the visitor.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * @var Room $room
         **/
        $rooms = Room::query()->where('is_admin', 0)->get();
        foreach ($rooms as $room)
            $room->numOfActive = $room->getNumOfActive();

        return view('visitors.index')->with('rooms', $rooms);
    }

    /**
     * Display the specified resource.
     *
     * @param string $room_id
     * @return View
     */
    public function show(string $room_id): View
    {
        /**
         * @var Room $room
         **/
        $room = Room::query()->findOrFail($room_id);
        $visitors = $room->getActiveMembers();

        return view('visitors.show')->with(['room' => $room, 'visitors' => $visitors]);
    }

    /**
     * Display the PDF template.
     *
     * @param string $room_id
     * @param int $year
     * @param int $month
     * @param bool $forcePrint
     * @return View
     */
    public function print(string $room_id, int $year, int $month, bool $forcePrint): View
    {
        /**
         * @var Room $room
         **/
        $room = Room::query()->findOrFail($room_id);

        $activities = Activity::query()
            ->where('room_id', $room->id)
            ->whereYear('in_time', '=', $year)
            ->whereMonth('in_time', '=', $month)
            ->orderBy('in_time')
            ->get();

        return view('visitors.print')->with(['room' => $room, 'activities' => $activities, 'forcePrint' => $forcePrint]);
    }
}
