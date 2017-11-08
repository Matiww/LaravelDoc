<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreNote;
use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller {
    const NOTES_PER_PAGE = 25;
    const PRIVATE_NOTE = 1;
    const IMPORTANT_NOTE = [1, 2, 3];
    //TODO save in db
    const IMPORTANT_NOTE_DESCRIPTION = ['Ważna', 'Bardzo ważna', 'Najważniejsza'];
    const NOTES_ACTIVE = 1;
    const NOTE_CONTENT_LENGTH = 90; //90
    const NOTES_FETCH = [
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
    ];
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $limit = isset($request->limit) ? $request->limit : self::NOTES_PER_PAGE;

        $query = DB::table('users');
        $query->select(self::NOTES_FETCH)
            ->join('notes', 'users.id', '=', 'notes.user_id')
            ->where('users.id', '=', Auth::id())
            ->orderBy('notes.active', 'desc')
            ->orderBy('notes.updated_at', 'desc')
            ->orderBy('notes.created_at', 'desc');
        if (isset($request->search)) {
            $query->where('notes.title', 'LIKE', '%' . $request->search . '%');
            $query->orWhere('notes.content', 'LIKE', '%' . $request->search . '%');
        }
        $notes = $query->paginate($limit);

        return view('pages.notes.list', [
            'notes' => $notes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.notes.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNote $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreNote $request) {

        $this->storeUpdateNote($request);

        return redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
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

        return view('pages.notes.show')->with('note', $note[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $note = Note::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        return view('pages.notes.add-edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNote $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreNote $request, $id) {

        $this->storeUpdateNote($request, $id);

        return redirect()->route('notes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return array
     */
    public function destroy($id) {
        $note = Note::find($id);
        $note->delete();

        return array('success' => true, 'notesCount' => Helper::countNotes());
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

        $note->active = 1;
        $note->save();

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
        $note->active = 0;
        $note->save();

        return redirect()->route('notes.index');
    }

    /**
     * Get all calendar events
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCalendarEvents() {
        $notes = DB::table('notes')
            ->select(
                'notes.id',
                'notes.title',
                'notes.date',
                'notes.important'
            )
            ->join('users', 'notes.user_id', '=', 'users.id')
            ->where('notes.user_id', '=', Auth::id())
            ->where('notes.active', '=', self::NOTES_ACTIVE)
            ->where('notes.date', '!=', null)
            ->get();

        //$note->important have different type on local/production - temporary fix
//        FIXME
        foreach ($notes as $note) {
            $note->important = (int) $note->important;
        }
        $response = response()->json($notes);

        return $response;
    }

    /**
     * @param $request
     * @param null $id
     *
     * @return bool
     */
    public function storeUpdateNote($request, $id = null) {
        //edit note
        if(!empty($id)) {
            $note = Note::find($id);
        } else {
            //new note
            $note = new Note;
            $note->user_id = Auth::id();
            $note->created_at = date('Y-m-d H:i:s');

        }

        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->important = 0;
        if (isset($request->important)) {
            $note->important = $note->important = $request->important_level;
        }
        $note->date = $request->date ? date('Y-m-d', strtotime(str_replace('/', '-', $request->date))) : null;
        $note->updated_at = date('Y-m-d H:i:s');

        $note->save();

        return true;
    }
}
