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
        $rooms = Club::query()->get();
        foreach ($rooms as $room)
            $room->active = $room->getNumOfActivePeople();

        return view('rooms')->with('rooms', $rooms);
    }

    public function edit(): Renderable
    {
        $rooms = Club::query()->get();

        return view('edit')->with('rooms', $rooms);
    }
}
