<?php

namespace App\Helpers;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * @return mixed
     */
    public static function countActiveNotes() {
        $notes = DB::table('notes')
            ->select('notes.id')
            ->join('users', 'users.id', '=', 'notes.user_id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.active', '=', NoteController::NOTES_ACTIVE)
            ->count();

        return $notes;
    }

    /**
     * @return mixed
     */
    public static function countDisabledNotes() {
        $notes = DB::table('notes')
            ->select('notes.id')
            ->join('users', 'users.id', '=', 'notes.user_id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.active', '=', 0)
            ->count();

        return $notes;
    }
}