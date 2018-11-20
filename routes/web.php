<?php

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
    return view('index');
});

Route::get('game', function () {
    return view('index');
});

Route::get('game/{id}', function ($id) {
    return view('game', ['id' => $id]);
    // return 'Game '.$id;
    // return view('index');
});

Route::get('game/{id}/edit', function ($id) {
    return view('editGame', ['id' => $id]);
});

Route::get('members', function () {
    return view('memberList');
});
