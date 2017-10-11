<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Note;
use Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
    public function index()
    {
        $notes = DB::table('users')
            ->select(
                'users.name',
                'users.email',
                'notes.id',
                'notes.title',
                'notes.content',
                'notes.created_at',
                'notes.updated_at'

            )
            ->join('notes', 'users.id', '=', 'notes.user_id')
            ->orderBy('notes.created_at', 'desc')
            ->get();

        return view('pages/notes')->with('notes', $notes);
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
        $note = new Note;

        $note->title = $request->title;
        $note->content = $request->description;
        $note->user_id = Auth::id();
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
            ->where('notes.id', '=', $id)
            ->get();
        return view('pages/show-note')->with('note', $note[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return view('pages/edit-note')->with('note', $note);
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
        $note = Note::find($id);

        $note->title = $request->input('title');
        $note->content = $request->input('description');
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
