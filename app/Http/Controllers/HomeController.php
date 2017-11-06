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

        $dueDates = $dueDates->filter(function ($note) {
            return !is_null($note->date) && $note->active == 1;
        });

        return view('pages.home', compact('notes', 'tasks', 'notActive', 'dueDates'));
    }

    public function calendar() {
        return view('pages.calendar');
    }
}
