<?php

namespace App\Helpers;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * @param $active
     *
     * @return bool
     */
    public static function countNotes($active = NoteController::NOTES_ACTIVE) {
        $notes = DB::table('notes')
            ->select('notes.id')
            ->join('users', 'users.id', '=', 'notes.user_id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.active', '=', $active)
            ->count();

        return $notes;
    }

}