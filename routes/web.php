<?php

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
    User::query()->where('email', 'morris@gmail.com')->get();
    $users = User::all();
    $users;

    return view('index', ['users' => $users]);
})->name('home');

Route::resource('/user/{id}', [UserController::class, 'show']);
// Controller functie koppelen

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::post('/overview', function () {
    return view('overview');
})->name('overview');

Route::post('/details', function () {
    return view('details');
})->name('details');
