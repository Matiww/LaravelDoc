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
        <div class="col-md-8 add-note-container">
            <form method="POST" action="{{ route('notes.store') }}">
              <div class="form-group">
                <label for="title">Tytuł</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Wprowadź tytuł">
              </div>
              <div class="form-group">
                <label for="description">Opis</label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
              </div>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
              <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Zapisz</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection