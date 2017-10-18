@extends('main')
@section('stylesheets')
    <link rel="stylesheet" media="screen" href="{{ URL::asset('plugins/lou-multi-select/css/multi-select.css') }}">
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/lou-multi-select/js/jquery.multi-select.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 edit-note-container">
            <form method="POST" action="{{ route('notes.update', $note->id) }}">
                <div class="form-group">
                    <label for="title">Tytuł</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Wprowadź tytuł"
                           value="{{ $note->title }}">
                </div>
                <div class="form-group">
                    <label for="content">Opis</label>
                    <textarea class="form-control" name="content" id="content" rows="5">{{ $note->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="date" name="date" class="form-control" id="date" placeholder="">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="important_note"
                               class="form-check-input" {{ $note->important == \App\Http\Controllers\NoteController::IMPORTANT_NOTE ? 'checked' : '' }}>
                        Ważna notatka
                    </label>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Zapisz</button>
                {{ method_field('PUT') }}
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection