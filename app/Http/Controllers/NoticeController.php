<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Support\Carbon;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::query()->whereDate('created_at', '<=', Carbon::today())->orderByDesc('created_at')->get();
        return view('notice')->with('notices', $notices);
    }
}
