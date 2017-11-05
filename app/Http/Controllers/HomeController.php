<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Auth;
use DateTime;
class HomeController extends Controller {
    const HOME_NOTE_LIMIT = 10;
    const HOME_NOTE_CONTENT_LENGTH = 120;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $query = DB::table('users');
        $query->select(NoteController::NOTES_FETCH)
            ->join('notes', 'users.id', '=', 'notes.user_id')
            ->where('users.id', '=', Auth::id())
            ->orderBy('notes.active', 'desc')
            ->orderBy('notes.important', 'desc')
            ->orderBy('notes.created_at', 'desc');

        $notes = $query->limit(self::HOME_NOTE_LIMIT)->get();

        $tasks = $notes->filter(function ($note) {
            return !is_null($note->date) && $note->active == 1;
        });
        $notActive = $notes->filter(function ($note) {
            return $note->active == 0;
        });
        $dueDates = $notes->sortBy('date');

//        $dueDates = $sortByDate->filter(function ($note) {
//            $today = date('Y-m-d');
//            $date = date_create($note->date);
//            $now = date_create($today);
//
//            $diff=date_diff($date,$now);
//            $text = $date->diff($now)->format("%d days, %h hours and %i minuts");
//
//           return $date > $now;
//        });

        return view('pages.home', compact('notes', 'tasks', 'notActive', 'dueDates'));
    }

    public function calendar() {
        return view('pages.calendar');
    }
}
