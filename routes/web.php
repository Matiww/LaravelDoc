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


Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/calendar', 'HomeController@calendar');
    Route::post('notes/events', 'NoteController@getCalendarEvents');
});

Auth::routes();


Route::middleware(['auth', 'isNoteOwner'])->group(function () {
    Route::resource('/notes', 'NoteController');
    Route::get('/notes/{id}/enable', array( "as" => "note.enable", "uses" => "NoteController@enable"));
    Route::get('/notes/{id}/disable', array( "as" => "note.disable", "uses" => "NoteController@disable"));
});

