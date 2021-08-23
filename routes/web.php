<?php

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacyPolicy', function () {
    return view('privacyPolicy');
});

Route::get('/guidelinesForHealth', function () {
    return view('guidelinesForHealth');
});

// This routing will be deleted.
Route::get('/notice', [App\Http\Controllers\NoticeController::class, 'information']);
// ↓ Will be changed to this routing.
Route::get('/information', [App\Http\Controllers\NoticeController::class, 'information'])->name('information');


Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/visitors', [App\Http\Controllers\RoomController::class, 'visitors'])->name('visitors');
    Route::get('/tracking', [App\Http\Controllers\HomeController::class, 'tracking'])->name('tracking');
    Route::post('/tracking', [App\Http\Controllers\HomeController::class, 'search'])->name('tracking.search');
    Route::get('/tracking/download/{student_id}', [App\Http\Controllers\HomeController::class, 'downloadCSV'])->name('tracking.downloadCSV');

    Route::resource('rooms', RoomController::class);
    Route::resource('notices', NoticeController::class)->except('show');
});
