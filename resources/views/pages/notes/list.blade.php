@extends('layouts.main')
@section('title', 'Lista notatek')
@section('javascripts')
    <script src="{{ asset('plugins/masonry.pkgd.min.js') }}"></script>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Strona główna</a></li>
            <li><a href="{{ url('notes') }}"><i class="fa fa-sticky-note-o"></i> Notatki</a></li>
            <li class="active"><i class="fa fa-list"></i> Lista</li>
        </ol>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Lista
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row notes-container">
                @if(count($notes) > 0)
                    <div class="grid">
                        <div class="grid-sizer"></div>
                        <div class="gutter-sizer"></div>
                        @foreach($notes as $note)
                            <div class="grid-item notes-list">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title {{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? '' : 'not-active' }}">{{ $note->title }}</h3>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
                                        <p class="{{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? '' : 'not-active' }}">{!! nl2br(e(str_limit($note->content, \App\Http\Controllers\NoteController::NOTE_CONTENT_LENGTH, '...'))) !!}</p>
                                        <small class="additional-info {{ $note->active == 1 ? 'text-muted' : 'not-active' }}">
                                            Termin: {{ isset($note->date) ? date('d-m-Y', strtotime($note->date)) : 'Brak' }}</small>
                                        <small class="additional-info {{ $note->active == 1 ? 'text-muted' : 'not-active' }}">
                                            Przez: {{ $note->name }}</small>
                                        @if($note->created_at == $note->updated_at)
                                            <small class="{{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? 'text-muted' : 'not-active' }} note-timestamps">
                                                <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top"
                                                   title="Data dodania"></i> {{ date('d-m-Y H:i:s', strtotime($note->created_at)) }}
                                            </small>
                                        @else
                                            <small class="{{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? 'text-muted' : 'not-active' }} note-timestamps">
                                                <i class="fa fa-calendar-plus-o" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Ostatnia aktualizacja"></i> {{ date('d-m-Y H:i:s', strtotime($note->updated_at)) }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="box-footer text-center">
                                        @include('pages.notes.actions')
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="error-page">
                        {{--<h2 class="headline text-yellow"> 0 notatek</h2>--}}

                        <div class="error-content">
                            <h3><i class="ion-document text-blue"></i> Brak notatek do wyświetlenia.</h3>

                            <p>
                                Możesz je dodać <a href="{{ url('/notes/create') }}">tutaj</a>.
                            </p>
                        </div>
                    </div>
            @endif
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection