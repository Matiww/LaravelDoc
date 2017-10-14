<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    const NOTES_PER_PAGE = 8;
    const PRIVATE_NOTE = 1;
    const IMPORTANT_NOTE = 1;
    const NOTES_ACTIVE = 1;
    const NOTE_CONTENT_LENGTH = 90; //90
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = isset($request->limit) ? $request->limit : self::NOTES_PER_PAGE;

        $notes = DB::table('users')
            ->select(
                'users.name',
                'users.email',
                'notes.id',
                'notes.id',
                'notes.title',
                'notes.content',
                'notes.created_at',
                'notes.updated_at',
                'notes.active',
                'notes.important',
                'notes.date',
                'notes.private'
            )
            ->join('notes', 'users.id', '=', 'notes.user_id')
            ->where('users.id', '=', Auth::id())
            ->where('notes.active', '=', self::NOTES_ACTIVE)
            ->orderBy('notes.created_at', 'desc')
            ->paginate($limit);

        $notes_count = DB::table('notes')
            ->select(DB::raw('count(id) as notes_count'))
            ->where('user_id', '=', Auth::id())
            ->get();

        return view('pages/notes', [
            'notes' => $notes,
            'notes_count' => $notes_count[0]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/add-note');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable'
        ]);
        $note = new Note;

        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->user_id = Auth::id();
        if(isset($request->important_note) && $request->important_note == "on") {
            $note->important = self::IMPORTANT_NOTE;
        }
        if(isset($request->private_note) && $request->private_note == "on") {
            $note->private = self::PRIVATE_NOTE;
        }
        $note->date = null;
        $note->created_at = date('Y-m-d H:i:s');
        $note->updated_at = date('Y-m-d H:i:s');

        $note->save();

        return redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = DB::table('notes')
            ->select(
                'users.name',
                'users.email',
                'notes.id',
                'notes.title',
                'notes.content',
                'notes.created_at',
                'notes.updated_at'

            )
            ->join('users', 'notes.user_id', '=', 'users.id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.id', '=', $id)
            ->get();
        if(!empty($note[0])) {
            return view('pages/show-note')->with('note', $note[0]);
        } else {
            return view('errors/note');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', Auth::id())
        ->first();
        if(!empty($note)) {
            return view('pages/edit-note')->with('note', $note);
        } else {
            return view('errors/note');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable'
        ]);
        $note = Note::find($id);

        $note->title = $request->input('title');
        $note->content = $request->input('content');

        $note->important = 0;
        if(isset($request->important_note) && $request->important_note == "on") {
            $note->important = self::IMPORTANT_NOTE;
        }

        $note->private = 0;
        if(isset($request->private_note) && $request->private_note == "on") {
            $note->private = self::PRIVATE_NOTE;
        }
        $note->updated_at = date('Y-m-d H:i:s');

        $note->save();

        return redirect()->route('notes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        return array('success' => true);
    }
}
