<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {
    protected $table = 'notes';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function getAll() {
        return Note::with('user')->orderBy('created_at')->get();
    }
}
