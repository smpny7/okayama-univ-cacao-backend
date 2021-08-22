<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Room;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laracsv\Export;
use League\Csv\ByteSequence;
use League\Csv\CannotInsertRecord;
use League\Flysystem\Exception;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function home(): Renderable
    {
        return view('home');
    }

//    public function rooms(): Renderable
//    {
//        $rooms = Club::query()->where('is_admin', 0)->get();
//        foreach ($rooms as $room)
//            $room->active = $room->getNumOfActivePeople();
//
//        return view('rooms')->with('rooms', $rooms);
//    }

//    public function index(): Renderable
//    {
//        $rooms = Club::query()->get();
//
//        return view('rooms.index')->with('rooms', $rooms);
//    }

//    public function create(): Renderable
//    {
//        return view('rooms.edit')
//            ->with('action', route('rooms.register'));
//    }

//    public function edit($club_id): Renderable
//    {
//        $club = Club::query()->findOrFail($club_id);
//
//        return view('rooms.edit')
//            ->with('club', $club)
//            ->with('action', route('rooms.update', ['club_id' => $club->id]));
//    }

//    public function register(Request $request)
//    {
//        $login_id = Str::random(15);
//        $password = Str::random(15);
//        Club::query()->create(['name' => $request->input('name'), 'login_id' => $login_id, 'password' => Hash::make($password), 'image_path' => $request->input('image_path')]);
//
//        $qr_code = QrCode::size(500)->generate('id=' . $login_id . '&password=' . $password);
//
//        return view('rooms.show')->with(['qr_code' => $qr_code, 'room_name' => $request->input('name')]);
//    }

//    public function update(Request $request, $club_id)
//    {
//        $club = Club::query()->findOrFail($club_id);
//        $club->name = $request->input('name');
//        $club->image_path = $request->input('image_path');
//        $club->save();
//
//        $rooms = Club::query()->get();
//        foreach ($rooms as $room)
//            $room->active = $room->getNumOfActivePeople();
//
//        return view('rooms.index')->with('rooms', $rooms);
//    }

//    public function regenerate($club_id)
//    {
//        $login_id = Str::random(15);
//        $password = Str::random(15);
//
//        $club = Club::query()->findOrFail($club_id);
//        if ($club->is_admin) abort(401);
//        $club->login_id = $login_id;
//        $club->password = Hash::make($password);
//        $club->save();
//
//        $qr_code = QrCode::size(500)->generate('id=' . $login_id . '&password=' . $password);
//
//        return view('rooms.show')->with(['qr_code' => $qr_code, 'room_name' => $club->name]);
//    }

    public function tracking()
    {
        return view('tracking');
    }

    public function search(Request $request)
    {
        $student_id = strtoupper($request->input('student_id'));
        $students = $this->getListOfContacts($student_id);

        return view('tracking')->with(['students' => $students, 'student_id' => strtoupper($request->input('student_id'))]);
    }

    public function downloadCSV($student_id)
    {
        $student_id = strtoupper($student_id);

        $students = $this->getListOfContacts($student_id);

        try {
            $csvFileName = '/tmp/' . time() . rand() . '.csv';
            $fileName = $student_id . '.csv';
            $res = fopen($csvFileName, 'w');
            if ($res === FALSE) throw new Exception('ファイルの書き込みに失敗しました。');

            $header = [
                mb_convert_encoding('日付', 'SJIS'),
                mb_convert_encoding('学籍番号', 'SJIS'),
                mb_convert_encoding('接触部屋', 'SJIS'),
                mb_convert_encoding('接触時間', 'SJIS'),
                mb_convert_encoding('ステータス', 'SJIS')
            ];

            fputcsv($res, $header);

            foreach ($students as $dataInfo) {
                $dataInfo['status'] = $dataInfo['status'] ? '15分以上接触' : '';
                mb_convert_variables('SJIS', 'UTF-8', $dataInfo);
                fputcsv($res, $dataInfo);
            }

            fclose($res);

            header('Content-Type: application/octet-stream');

            header('Content-Disposition: attachment; filename=' . $fileName);
            header('Content-Length: ' . filesize($csvFileName));
            header('Content-Transfer-Encoding: binary');
            readfile($csvFileName);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getListOfContacts($student_id): array
    {
        $twoWeeksAgo = Carbon::today()->subDays(14);
        $students = [];

        $rooms = Room::query()->get(['id', 'name']);
        $activities = Activity::query()->whereDate('in_time', '>', $twoWeeksAgo)->where('student_id', $student_id)->whereNotNull('out_time')->orderByDesc('in_time')->get();
        foreach ($activities as $activity) {
            $raw = Activity::query()
                ->where('student_id', '<>', $student_id)
                ->where('room_id', $activity->room_id)
                ->where('in_time', '<', Carbon::parse($activity->out_time))
                ->whereNotNull('out_time')
                ->where('out_time', '>', Carbon::parse($activity->in_time))
                ->get();
            foreach ($raw as $data) {
                $from = Carbon::parse($activity->in_time)->gte(Carbon::parse($data->in_time)) ? Carbon::parse($activity->in_time) : Carbon::parse($data->in_time);
                $to = Carbon::parse($activity->out_time)->gte(Carbon::parse($data->out_time)) ? Carbon::parse($data->out_time) : Carbon::parse($activity->out_time);
                $export = array(
                    'date' => date('Y/m/d', strtotime($data->in_time)),
                    'student_id' => $data->student_id,
                    'room_id' => $rooms->find($data->room_id)->name,
                    'time' => $from->format('H:i') . ' 〜 ' . $to->format('H:i'),
                    'status' => $to->diffInMinutes($from) >= 15
                );
                array_push($students, $export);
            }
        }
        return $students;
    }
}
