<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Throwable;

class RoomController extends Controller
{
    /**
     * Display a listing of the room.
     *
     * @return View
     */
    public function index(): View
    {
        $rooms = Room::query()->get();
        return view('rooms.index')->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new room.
     *
     * @return View
     */
    public function create(): View
    {
        return view('rooms.edit')->with('action', route('rooms.store'));
    }

    /**
     * Store a newly created room in storage.
     *
     * @param Request $request
     * @return View|RedirectResponse
     * @noinspection PhpUndefinedMethodInspection
     */
    public function store(Request $request)
    {
        try {
            $login_id = Str::random(15);
            $password = Str::random(15);
            Room::query()->create(['name' => $request->input('name'), 'login_id' => $login_id, 'password' => Hash::make($password), 'image_path' => $request->input('image_path')]);

            $qr_code = QrCode::size(500)->generate('id=' . $login_id . '&password=' . $password);

            return view('rooms.regenerate')->with(['qr_code' => $qr_code, 'room_name' => $request->input('name')]);
        } catch (Throwable $e) {
            return redirect()->route('rooms.index')
                ->with('alert_error', 'エラーが発生しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return View|RedirectResponse
     * @noinspection PhpUndefinedMethodInspection
     */
    public function show(string $id)
    {
        /**
         * @var Room $room
         **/
        try {
            $login_id = Str::random(15);
            $password = Str::random(15);

            $room = Room::query()->findOrFail($id);
            if ($room->is_admin) abort(401);
            $room->login_id = $login_id;
            $room->password = Hash::make($password);
            $room->saveOrFail();

            $qr_code = QrCode::size(500)->generate('id=' . $login_id . '&password=' . $password);

            return view('rooms.regenerate')->with(['qr_code' => $qr_code, 'room_name' => $room->name]);
        } catch (Throwable $e) {
            return redirect()->route('rooms.index')->with('alert_error', 'QRコードの更新に失敗しました。');
        }
    }

    /**
     * Show the form for editing the specified room.
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        /**
         * @var Room $room
         **/
        $room = Room::query()->findOrFail($id);

        return view('rooms.edit')
            ->with('action', route('rooms.update', ['room' => $room->id]))
            ->with('room', $room);
    }

    /**
     * Update the specified room in storage.
     *
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        /**
         * @var Room $room
         **/
        try {
            $room = Room::query()->findOrFail($id);
            $room->name = $request->input('name');
            $room->image_path = $request->input('image_path');
            $room->saveOrFail();
            return redirect()->route('rooms.index')
                ->with('alert_success', '部屋を更新しました。');
        } catch (Throwable $e) {
            return redirect()->route('rooms.index')
                ->with('alert_error', '部屋の更新に失敗しました。');
        }
    }

    /**
     * Remove the specified room from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $room = Room::query()->findOrFail($id);
            $room->delete();

            return redirect()->route('rooms.index')
                ->with('alert_success', '部屋を削除しました。');
        } catch (Throwable $e) {
            return redirect()->route('rooms.index')
                ->with('alert_error', '部屋の削除に失敗しました。');
        }
    }
}
