@extends('main')
@section('stylesheets')
    <link rel="stylesheet" media="screen" href="{{ URL::asset('plugins/lou-multi-select/css/multi-select.css') }}">
    <link rel="stylesheet" media="screen"
          href="{{ URL::asset('plugins/ion.rangeSlider-2.2.0/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" media="screen"
          href="{{ URL::asset('plugins/ion.rangeSlider-2.2.0/css/ion.rangeSlider.skinNice.css') }}">
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/lou-multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/ion.rangeSlider-2.2.0/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 edit-note-container">
            <form method="POST" action="{{ route('notes.update', $note->id) }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="errors-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                {{--<div class="form-check">--}}
                    {{--<label class="form-check-label">--}}
                        {{--<input type="checkbox" name="important_note"--}}
                               {{--class="form-check-input important-note" {{ in_array($note->important, \App\Http\Controllers\NoteController::IMPORTANT_NOTE) ? 'checked' : '' }}>--}}
                        {{--Ważna notatka--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="form-group {{ in_array($note->important, \App\Http\Controllers\NoteController::IMPORTANT_NOTE) ? '' : 'display-none' }} scale-handle">--}}
                    {{--Skala ważności--}}
                    {{--<input type="text" id="scale" name="scale_level" value="{{ $note->important }}"/>--}}
                {{--</div>--}}
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Zapisz</button>
                {{ method_field('PUT') }}
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection