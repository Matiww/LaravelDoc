<?php

namespace App\Helpers;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * @param null $level
     *
     * @return mixed
     */
    public static function countNotes($level = null) {
        $query = DB::table('notes');
            $query->select('notes.id')
            ->join('users', 'users.id', '=', 'notes.user_id')
            ->where('notes.user_id', '=', Auth::id());
            if(!is_null($level)) {
                $query->where('notes.important', '=', $level);
            }
        $notes = $query->count();
        return $notes;
    }

}