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

Route::get('/', 'HomeController@index');

Route::resource('/notes', 'NoteController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/notes/{id}/enable', array( "as" => "note.enable", "uses" => "NoteController@enable"));
Route::get('/notes/{id}/disable', array( "as" => "note.disable", "uses" => "NoteController@disable"));
Route::post('notes/events', 'NoteController@getCalendarEvents');
