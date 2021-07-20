<?php

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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/rooms', [App\Http\Controllers\HomeController::class, 'rooms'])->name('rooms');
Route::get('/rooms/index', [App\Http\Controllers\HomeController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [App\Http\Controllers\HomeController::class, 'create'])->name('rooms.create');
Route::get('/rooms/edit/{club_id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('rooms.edit');
Route::post('/rooms/register', [App\Http\Controllers\HomeController::class, 'register'])->name('rooms.register');
Route::post('/rooms/update/{club_id}', [App\Http\Controllers\HomeController::class, 'update'])->name('rooms.update');
Route::get('/rooms/regenerate/{club_id}', [App\Http\Controllers\HomeController::class, 'regenerate'])->name('rooms.regenerate');

Route::get('/tracking', [App\Http\Controllers\HomeController::class, 'tracking'])->name('tracking');
Route::post('/tracking', [App\Http\Controllers\HomeController::class, 'search'])->name('tracking.search');
