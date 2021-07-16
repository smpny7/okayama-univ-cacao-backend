<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(): Renderable
    {
        return view('home');
    }

    public function rooms(): Renderable
    {
        $rooms = Club::query()->where('is_admin', 0)->get();
        foreach ($rooms as $room)
            $room->active = $room->getNumOfActivePeople();

        return view('rooms')->with('rooms', $rooms);
    }

    public function list(): Renderable
    {
        $rooms = Club::query()->get();

        return view('rooms.list')->with('rooms', $rooms);
    }

    public function edit($club_id): Renderable
    {
        $club = Club::query()->findOrFail($club_id);

        return view('rooms.edit')->with('club', $club);
    }

    public function update(Request $request, $club_id)
    {
        $club = Club::query()->findOrFail($club_id);
        $club->name = $request->input('name');
        $club->image_path = $request->input('image_path');
        $club->save();

        $rooms = Club::query()->get();
        foreach ($rooms as $room)
            $room->active = $room->getNumOfActivePeople();

        return view('rooms.list')->with('rooms', $rooms);
    }
}
