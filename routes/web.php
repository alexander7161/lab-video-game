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

Route::post('rent', 'RentController@createRent')->name('rentgame');
Route::post('unrent', 'RentController@deleteRent')->name('unrentgame');
Route::get('addextension/{id}', 'RentController@addExtension');

Route::get('game/{id}/edit', 'GameController@editGameView')->middleware('volunteer');
Route::post('game/{id}/edit', 'GameController@editGame')->middleware('volunteer')->name('editGame');
Route::get('game/{id}/delete', 'GameController@deleteGame')->middleware('volunteer');

Route::get('newGame', 'GameController@newGameView')->middleware('volunteer');
Route::post('newGame', 'GameController@createGame')->name('newGame')->middleware('volunteer');

Route::get('members', 'UserController@getUsers')->middleware('volunteer');
Route::post('members', 'UserController@setVolunteer')->name('members')->middleware('volunteer');
Route::post('makeSecretary', 'UserController@makeSecretary')->name('makeSecretary')->middleware('secretary');
Route::get('account', 'UserController@getCurrentUser')->middleware('authenticated');
Route::get('account/{id}', 'UserController@getUser')->middleware('authenticated');
Route::get('account/{id}/ban', 'UserController@banUser')->middleware('volunteer')->name('ban');
Route::get('account/{id}/unban', 'UserController@unBanUser')->middleware('volunteer')->name('unban');
Route::get('account/{id}/addviolation', 'UserController@createViolation')->middleware('volunteer')->name('addviolation');
Route::get('account/removeviolation/{id}', 'UserController@removeViolation')->middleware('volunteer');

Route::get('rules', 'RulesController@index')->middleware('secretary')->name('rules');
Route::post('rules', 'RulesController@edit')->middleware('secretary')->name('editRules');

Route::get('error/{id?}', function ($id = 7) {
    return view('error', ['info' => __("errors.{$id}")]);
})->name('error');

Auth::routes();
