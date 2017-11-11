@extends('layouts.main')
@section('title', 'Dodawanie/Edycja notatki')
@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('plugins/jquery-labelauty-master/source/jquery-labelauty.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker-master/dist/datepicker.css') }}">
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/jquery-labelauty-master/source/jquery-labelauty.js') }}"></script>
    <script src="{{ asset('plugins/datepicker-master/dist/datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker-master/i18n/datepicker.pl-PL.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(":checkbox").labelauty({
                label: false
            });
            $(":radio").labelauty();
            $('#important').on("click", function() {
                $('.importan-additional').slideToggle();
            });
        });
        $('#date').datepicker({
            language: 'pl-PL',
            format: 'dd-mm-yyyy',
            autoHide: true
        });
        $('.clear-date').on("click", function() {
           $('#date').val('');
        });
    </script>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Strona główna</a></li>
            <li><a href="{{ url('notes') }}"><i class="fa fa-sticky-note-o"></i> Notatki</a></li>
            <li class="active"><i class="fa fa-{{ isset($note) ? 'edit' : 'plus' }}"></i> {{ isset($note) ? 'Edycja' : 'Dodawanie' }}</li>
        </ol>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ isset($note) ? 'Edycja' : 'Dodawanie' }} notatki
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="callout callout-info">
                <p>Przypisanie terminu do notatki wyświetli ją w <a href="{{ url('calendar') }}">kalendarzu</a>.</p>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Notatka</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ isset($note) ? route('notes.update', $note->id) : route('notes.store') }}">
                    @if ($errors->any())
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger">
                                    <ul class="errors-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Tytuł</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Wprowadź tytuł" value="{{ isset($note->title) ? $note->title : '' }}" required>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">Opis</label>

                            <div class="col-sm-8">
                                <textarea class="form-control" name="content" id="content" rows="5" placeholder="Wprowadź opis (opcjonalne)">{{ isset($note->content) ? $note->content : '' }}</textarea>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Termin</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="date" id="date" placeholder="dd/mm/yyyy" value="{{ isset($note->date) ? date('d-m-Y', strtotime($note->date)) : '' }}" readonly>
                                <i data-toggle="tooltip"
                                   data-placement="top"
                                   title="Wyczyść" class="fa fa-times clear-date"></i>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Ważna</label>

                            <div class="col-sm-8">
                                <input type="checkbox" id="important" name="important" value="1" {{ !empty($note->important) ? 'checked' : '' }}>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group {{ !empty($note->important) ? '' : 'display-none' }} importan-additional">
                            <label for="date" class="col-sm-2 control-label text-muted">Poziom (opcjonalnie)</label>
                            <div class="col-sm-8 additional-part">
                                <input type="radio" data-labelauty="Ważna" name="important_level" id="important1" value="1" {{ !empty($note->important) && $note->important == \App\Http\Controllers\NoteController::IMPORTANT_NOTE[0] ? 'checked' : (!empty($note->important) ? '' : 'checked') }}>
                                <input type="radio" data-labelauty="Bardzo ważna" name="important_level" id="important2" value="2" {{ !empty($note->important) && $note->important == \App\Http\Controllers\NoteController::IMPORTANT_NOTE[1] ? 'checked' : '' }}>
                                <input type="radio" data-labelauty="Najważniejsza" name="important_level" id="important3" value="3" {{ !empty($note->important) && $note->important == \App\Http\Controllers\NoteController::IMPORTANT_NOTE[2] ? 'checked' : '' }}>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <a href="{{ url()->previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Wróć</a>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Zapisz</button>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    @if(isset($note))
                        {{ method_field('PUT') }}
                    @endif
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection