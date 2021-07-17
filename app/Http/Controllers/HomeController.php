<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function index(): Renderable
    {
        $rooms = Club::query()->get();

        return view('rooms.index')->with('rooms', $rooms);
    }

    public function create(): Renderable
    {
        return view('rooms.edit')
            ->with('action', route('rooms.register'));
    }

    public function edit($club_id): Renderable
    {
        $club = Club::query()->findOrFail($club_id);

        return view('rooms.edit')
            ->with('club', $club)
            ->with('action', route('rooms.update', ['club_id' => $club->id]));
    }

    public function register(Request $request)
    {
        $login_id = Str::random(15);
        $password = Str::random(15);
        Club::query()->create(['name' => $request->input('name'), 'login_id' => $login_id, 'password' => Hash::make($password), 'image_path' => $request->input('image_path')]);

        $qr_code = QrCode::size(500)->generate('id=' . $login_id . '&password=' . $password);

        return view('rooms.show')->with(['qr_code' => $qr_code, 'room_name' => $request->input('name')]);
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

        return view('rooms.index')->with('rooms', $rooms);
    }

    public function regenerate($club_id)
    {
        $login_id = Str::random(15);
        $password = Str::random(15);

        $club = Club::query()->findOrFail($club_id);
        if ($club->is_admin) abort(401);
        $club->login_id = $login_id;
        $club->password = Hash::make($password);
        $club->save();

        $qr_code = QrCode::size(500)->generate('id=' . $login_id . '&password=' . $password);

        return view('rooms.show')->with(['qr_code' => $qr_code, 'room_name' => $club->name]);
    }
}
