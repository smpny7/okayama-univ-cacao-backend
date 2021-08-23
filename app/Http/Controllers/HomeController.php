<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Room;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use League\Flysystem\Exception;
use Throwable;

class HomeController extends Controller
{
    /**
     * Display a listing of items.
     *
     * @return View
     */
    public function home(): Renderable
    {
        return view('home');
    }

    /**
     * Display tracking input screen.
     *
     * @return View
     */
    public function tracking(): View
    {
        return view('tracking');
    }

    /**
     * Show the table of tracking results.
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $student_id = strtoupper($request->input('student_id'));
        $students = $this->getListOfContacts($student_id);

        return view('tracking')->with(['students' => $students, 'student_id' => strtoupper($request->input('student_id'))]);
    }

    /**
     * Download the tracking result csv file.
     *
     * @param string $student_id
     */
    public function downloadCSV(string $student_id)
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

        } catch (Throwable $e) {
            abort(500);
        }
    }

    public function getListOfContacts($student_id): array
    {
        /**
         * @var Room $room
         **/
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
                $room = $rooms->find($data->room_id);
                $export = array(
                    'date' => date('Y/m/d', strtotime($data->in_time)),
                    'student_id' => $data->student_id,
                    'room_name' => $room->name,
                    'time' => $from->format('H:i') . ' 〜 ' . $to->format('H:i'),
                    'status' => $to->diffInMinutes($from) >= 15
                );
                array_push($students, $export);
            }
        }
        return $students;
    }
}
