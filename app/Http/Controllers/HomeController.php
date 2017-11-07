<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use DateTime;
class HomeController extends Controller {
    const HOME_NOTE_CONTENT_LENGTH = 120;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $important = DB::table('users')
            ->select(NoteController::NOTES_FETCH)
            ->join('notes', 'users.id', '=', 'notes.user_id')
            ->where('users.id', '=', Auth::id())
            ->where('notes.important', '>', 0)
            ->orderBy('notes.important', 'desc')
            ->limit(10)->get();

        $dueDates = DB::table('users')
            ->select(NoteController::NOTES_FETCH)
            ->join('notes', 'users.id', '=', 'notes.user_id')
            ->where('users.id', '=', Auth::id())
            ->where('notes.date', '!=', null)
            ->orderBy('notes.date', 'asc')
            ->limit(10)->get();

        $important = $important->filter(function($note) {
            return $note->important > 0;
        });

        $dueDates = $dueDates->filter(function ($note) {
//            FIXME
            $today = new DateTime(date("Y-m-d H:i:s"));
            $date = new DateTime($note->date);
            return $date > $today;
        });

        return view('pages.home', compact('dueDates', 'important'));
    }

    public function calendar() {
        return view('pages.calendar');
    }
}
