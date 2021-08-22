<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Throwable;

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
        return view('information')->with('notices', $notices);
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
        try {
            Notice::query()->create([
                'sender_name' => $request->input('sender_name'),
                'sender_icon_url' => $request->input('sender_icon_url'),
                'released_at' => $request->input('released_at'),
                'contents' => $request->input('contents'),
            ]);

            return redirect()->route('notices.index')
                ->with('alert_success', '新しいお知らせを作成しました。');
        } catch (Throwable $e) {
            return redirect()->route('notices.index')
                ->with('alert_error', 'エラーが発生しました。');
        }
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        /**
         * @var Notice $notice
         **/
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
        /**
         * @var Notice $notice
         **/
        try {
            $notice = Notice::query()->findOrFail($id);
            $notice->sender_name = $request->input('sender_name');
            $notice->sender_icon_url = $request->input('sender_icon_url');
            $notice->released_at = $request->input('released_at');
            $notice->contents = $request->input('contents');
            $notice->saveOrFail();
            return redirect()->route('notices.index')
                ->with('alert_success', 'お知らせを更新しました。');
        } catch (Throwable $e) {
            return redirect()->route('notices.index')
                ->with('alert_error', 'お知らせの更新に失敗しました。');
        }
    }

    /**
     * Remove the specified notice from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $notice = Notice::query()->findOrFail($id);
            $notice->delete();

            return redirect()->route('notices.index')
                ->with('alert_success', 'お知らせを削除しました。');
        } catch (Throwable $e) {
            return redirect()->route('notices.index')
                ->with('alert_error', 'お知らせの削除に失敗しました。');
        }
    }
}
