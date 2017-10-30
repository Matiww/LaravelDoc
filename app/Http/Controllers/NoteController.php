<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNote;
use Illuminate\Http\Request;
use App\Note;
use Auth;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller {
    const NOTES_PER_PAGE = 25;
    const PRIVATE_NOTE = 1;
    const IMPORTANT_NOTE = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    const NOTES_ACTIVE = 1;
    const NOTE_CONTENT_LENGTH = 500; //90

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $limit = isset($request->limit) ? $request->limit : self::NOTES_PER_PAGE;

        $query = DB::table('users');
        $query->select(
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
            ->orderBy('notes.active', 'desc')
            ->orderBy('notes.important', 'desc')
            ->orderBy('notes.created_at', 'desc');
        if (isset($request->search)) {
            $query->where('notes.title', 'LIKE', '%' . $request->search . '%');
            $query->orWhere('notes.content', 'LIKE', '%' . $request->search . '%');
        }

        if (isset($request->important)) {
            if ($request->important == 0) {
                $query->where('notes.important', '=', 0);
            } else {
                $query->whereIn('notes.important', self::IMPORTANT_NOTE);
            }
        }
        $notes = $query->paginate($limit);

        return view('pages/notes', [
            'notes' => $notes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages/add-note');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNote $request) {
        $note = new Note;

        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->user_id = Auth::id();
        if (isset($request->important_note) && ($request->important_note == "on" || $request->important_note == 1)) {
            $note->important = self::IMPORTANT_NOTE[0];
        }
        if (isset($request->scale_level)) {
            $note->important = $request->scale_level;
        }
        if (isset($request->private_note) && ($request->private_note == "on" || $request->private_note == 1)) {
            $note->private = self::PRIVATE_NOTE;
        }
        $note->date = $request->date ? $request->date : null;
        $note->created_at = date('Y-m-d H:i:s');
        $note->updated_at = date('Y-m-d H:i:s');

        $note->save();

        return $request->ajax == true ? array(
            'success'    => true,
            'id'         => $note->id,
            'title'      => $note->title,
            'content'    => $note->content ? $note->content : '',
            'important'  => $note->important,
            'date'       => $note->date ? date('d-m-Y', strtotime($request->date)) : 'Brak',
            'created_at' => date('d-m-Y H:i:s', strtotime(date('Y-m-d H:i:s'))),
            'name'       => Auth::user()->name
        ) : redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $note = DB::table('notes')
            ->select(
                'users.name',
                'users.email',
                'notes.id',
                'notes.title',
                'notes.content',
                'notes.important',
                'notes.date',
                'notes.created_at',
                'notes.updated_at'

            )
            ->join('users', 'notes.user_id', '=', 'users.id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.id', '=', $id)
            ->get();
        if (!empty($note[0])) {
            return view('pages/show-note')->with('note', $note[0]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $note = Note::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        if (!empty($note)) {
            return view('pages/edit-note')->with('note', $note);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNote $request, $id) {
        $note = Note::find($id);

        $note->title = $request->input('title');
        $note->content = $request->input('content');

        $note->important = 0;
        if (isset($request->important_note) && $request->important_note == "on") {
            $note->important = self::IMPORTANT_NOTE[0];
        }
        if (isset($request->scale_level)) {
            $note->important = $request->scale_level;
        }
        $note->private = 0;
        if (isset($request->private_note) && $request->private_note == "on") {
            $note->private = self::PRIVATE_NOTE;
        }
        $note->date = $request->date ? $request->date : null;
        $note->updated_at = date('Y-m-d H:i:s');

        $note->save();

        return redirect()->route('notes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $note = Note::find($id);
        if ($note->user_id == Auth::id()) {
            $note->delete();

            return array('success' => true);
        }
    }

    /**
     * Enable note
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function enable($id) {
        $note = Note::find($id);
        if ($note->user_id == Auth::id()) {
            $note->active = 1;
            $note->save();
        }

        return redirect()->route('notes.index');
    }

    /**
     * Disable note
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function disable($id) {
        $note = Note::find($id);
        if ($note->user_id == Auth::id()) {
            $note->active = 0;
            $note->save();
        }

        return redirect()->route('notes.index');
    }


    public function getCalendarEvents() {
        $note = DB::table('notes')
            ->select(
                'users.name',
                'users.email',
                'notes.id',
                'notes.title',
                'notes.content',
                'notes.date',
                'notes.created_at',
                'notes.updated_at',
                'notes.important'

            )
            ->join('users', 'notes.user_id', '=', 'users.id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.active', '=', self::NOTES_ACTIVE)
            ->where('notes.date', '!=', null)
            ->get();

        $response = response()->json($note);

        return $response;
    }
}
