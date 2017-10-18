@extends('main')
@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('css/left-sidebar.css') }}">
    <link rel="stylesheet" media="screen" href="{{ URL::asset('plugins/lou-multi-select/css/multi-select.css') }}">
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/lou-multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/masonry.pkgd.min.js') }}"></script>
@endsection
@section('left-sidebar')
    @include('widgets/left-sidebar')
@endsection
@section('content')
    <div class="row notes-container">
        <input type="hidden" id="notes_count" name="notes_count" value="{{ $notes_count->notes_count }}"/>
        <div class="grid">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>
            @if(count($notes) > 0)
                @foreach($notes as $note)
                    <div class="grid-item notes-list">
                        <div class="card bg-light mb-3 {{ $note->active == 1 ? '' : 'not-active no-shadow' }}"
                             style="max-width: 20rem;">
                            @if($note->important == \App\Http\Controllers\NoteController::IMPORTANT_NOTE)
                                <div class="ribbon-important"><span>WAŻNA</span></div>
                            @endif
                            {{--@if($note->private == \App\Http\Controllers\NoteController::PRIVATE_NOTE)--}}
                            {{--<div class="ribbon-private"><span>PRYWATNA</span></div>--}}
                            {{--@endif--}}
                            <div class="card-body">
                                <h4 class="card-title">{{ $note->title }}</h4>
                                <p class="card-text">{!! nl2br(e(str_limit($note->content, \App\Http\Controllers\NoteController::NOTE_CONTENT_LENGTH, '...'))) !!}</p>
                                <small class="additional-info {{ $note->active == 1 ? 'text-muted' : 'not-active' }}">
                                    Data: {{ isset($note->date) ? date('d-m-Y', strtotime($note->date)) : 'Brak' }}</small>
                                <small class="additional-info {{ $note->active == 1 ? 'text-muted' : 'not-active' }}">
                                    Przez: {{ $note->name }}</small>
                            </div>
                            <div class="card-footer">
                                @if($note->created_at == $note->updated_at)
                                    <small class="{{ $note->active == 1 ? 'text-muted' : 'not-active' }} note-timestamps">
                                        <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top"
                                           title="Data dodania"></i> {{ date('d-m-Y H:i:s', strtotime($note->created_at)) }}
                                    </small>
                                @else
                                    <small class="{{ $note->active == 1 ? 'text-muted' : 'not-active' }} note-timestamps">
                                        <i class="fa fa-refresh" data-toggle="tooltip" data-placement="top"
                                           title="Ostatnia aktualizacja"></i> {{ date('d-m-Y H:i:s', strtotime($note->updated_at)) }}
                                    </small>
                                @endif
                            </div>
                            <div class="card-actions no-wrap">
                                @if($note->active == 1)
                                    <a href="/notes/{{ $note->id }}/disable" class="btn btn-light disable-note"
                                       data-toggle="tooltip" data-placement="top" title="Zablokuj"><i
                                                class="fa fa-ban"></i></a>
                                    <a href="/notes/{{ $note->id }}" class="btn btn-light" data-toggle="tooltip"
                                       data-placement="top" title="Podgląd"><i class="fa fa-eye"></i></a>
                                    <a href="/notes/{{ $note->id }}/edit" class="btn btn-light" data-toggle="tooltip"
                                       data-placement="top" title="Edycja"><i class="fa fa-edit"></i></a>
                                    <button data-id="{{ $note->id }}" type="button" class="btn btn-light delete-note"
                                            data-toggle="tooltip" data-placement="top" title="Usuń"><i
                                                class="fa fa-trash"></i></button>
                                @else
                                    <a href="/notes/{{ $note->id }}/enable" class="btn btn-light enable-note"
                                       data-toggle="tooltip" data-placement="top" title="Odblokuj"><i
                                                class="fa fa-unlock-alt"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12 margin-top-20 pagination-container">
                    <div class="text-center">
                        {{ $notes->links() }}
                    </div>
                </div>
        </div>
        @else
            <div class="col-md-4"></div>
            <div class="col-md-4 notes-list">
                <div class="alert alert-info" role="alert">
                    Brak notatek
                </div>
            </div>
            <div class="col-md-4"></div>
        @endif
    </div>
@endsection