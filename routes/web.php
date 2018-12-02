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

Route::get('/', 'GameController@index')->name('index');
Route::get('game', 'GameController@index');
Route::get('game/{id}', 'GameController@getGame');
Route::post('game', 'RentController@createRent')->name('rentgame');
Route::post('unrent', 'RentController@deleteRent')->name('unrentgame');
Route::get('game/{id}/edit', 'GameController@editGameView')->middleware('auth')->middleware('volunteer');
Route::post('game/{id}/edit', 'GameController@editGame')->middleware('auth')->middleware('volunteer')->name('editGame');
Route::get('game/{id}/delete', 'GameController@deleteGame')->middleware('auth')->middleware('volunteer');
Route::get('newGame', 'GameController@newGame')->middleware('auth')->middleware('volunteer');
Route::post('newGame', 'GameController@createGame')->name('newGame')->middleware('volunteer');
Route::get('members', 'UserController@getUsers')->middleware('auth')->middleware('volunteer');
Route::post('members', 'UserController@setVolunteer')->name('members')->middleware('auth')->middleware('volunteer');
Route::get('account', 'UserController@getCurrentUser')->middleware('auth');
Route::get('account/{id}', 'UserController@getUser')->middleware('auth');

Route::get('error/{id}', function ($id) {
    return view('error', ['info' => __("errors.{$id}")]);
})->name('error');

Auth::routes();
