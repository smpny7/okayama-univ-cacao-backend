<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class NoticeController extends Controller
{
    /**
     * Display a listing of the information.
     *
     * @return View
     */
    public function information(): View
    {
        $notices = Notice::query()->whereDate('released_at', '<=', Carbon::today())->orderByDesc('released_at')->get();
        return view('notice')->with('notices', $notices);
    }

    /**
     * Display a listing of the notice.
     *
     * @return View
     */
    public function index(): View
    {
        $notices = Notice::query()->get();
        return view('notices.index')->with('notices', $notices);
    }

    /**
     * Show the form for creating a new notice.
     *
     * @return View
     */
    public function create(): View
    {
        return view('notices.edit')->with('action', route('notices.store'));
    }

    /**
     * Store a newly created notice in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Notice::query()->create([
            'sender_name' => $request->input('sender_name'),
            'sender_icon_url' => $request->input('sender_icon_url'),
            'released_at' => $request->input('released_at'),
            'contents' => $request->input('contents'),
        ]);

        return redirect()->route('notices.index');
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $notice = Notice::query()->findOrFail($id);
        return view('notices.edit')
            ->with('action', route('notices.update', ['notice' => $notice->id]))
            ->with('notice', $notice);
    }

    /**
     * Update the specified notice in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $notice = Notice::query()->findOrFail($id);
        $notice->sender_name = $request->input('sender_name');
        $notice->sender_icon_url = $request->input('sender_icon_url');
        $notice->released_at = $request->input('released_at');
        $notice->contents = $request->input('contents');

        try {
            $notice->saveOrFail();
        } catch (\Throwable $e) {
            Log::error($e);
        }

        return redirect()->route('notices.index');
    }

    /**
     * Remove the specified notice from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $notice = Notice::query()->findOrFail($id);
        $notice->delete();

        return redirect()->route('notices.index');
    }
}
