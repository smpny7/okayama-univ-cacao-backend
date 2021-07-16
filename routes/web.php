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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/rooms', [App\Http\Controllers\HomeController::class, 'rooms'])->name('rooms');
Route::get('/rooms/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
