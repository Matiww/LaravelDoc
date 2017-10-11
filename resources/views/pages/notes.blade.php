@extends('main')
@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('css/left-sidebar.css') }}">
    <link rel="stylesheet" media="screen" href="{{ URL::asset('plugins/lou-multi-select/css/multi-select.css') }}">
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/lou-multi-select/js/jquery.multi-select.js') }}"></script>
@endsection
@section('left-sidebar')
    @include('widgets/left-sidebar')
@endsection
@section('content')
    <div class="row notes-container">
    @if(count($notes) > 0)
        @foreach($notes as $note)
            <div class="col-md-3 notes-list">
                <div class="card bg-light mb-3" style="max-width: 20rem;">
                    <div class="ribbon"><span>WAŻNE</span></div>
                  <div class="card-body">
                    <h4 class="card-title">{{ $note->title }}</h4>
                    <p class="card-text">{{ str_limit($note->content, 90, '...') }}</p>
                     <small class="text-muted">Przez: {{ $note->name }}</small>
                  </div>
                   <div class="card-footer ">
                     <small class="text-muted">Dodano: {{ date('d-m-Y H:i:s', strtotime($note->created_at)) }}</small>
                   </div>
                   <div class="card-actions">
                        <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Ważne"><i class="fa fa-flag"></i></button>
                        <a href="/notes/{{ $note->id }}" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Podgląd"><i class="fa fa-eye"></i></a>
                        <a href="/notes/{{ $note->id }}/edit" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edycja"><i class="fa fa-edit"></i></a>
                        <button data-id="{{ $note->id }}" type="button" class="btn btn-light delete-note" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fa fa-trash"></i></button>
                   </div>
                </div>
            </div>
        @endforeach
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