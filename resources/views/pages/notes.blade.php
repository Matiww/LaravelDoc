@extends('main')
@section('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('css/left-sidebar.css') }}">
@endsection
@section('left-sidebar')
    @include('widgets/left-sidebar')
@endsection
@section('content')
    <div class="row">
        @foreach($notes as $note)
            <div class="col-md-3 notes-list">
                <div class="card  bg-light mb-3" style="max-width: 20rem;">
                    <div class="ribbon"><span>WAŻNE</span></div>
                  <div class="card-body">
                    <h4 class="card-title">{{ $note->title }}</h4>
                    <p class="card-text">{{ $note->content }}</p>
                  </div>
                   <div class="card-footer ">
                     <small class="text-muted">Dodano: {{ $note->created_at }}</small>
                   </div>
                   <div class="card-actions">
                        <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Ważne"><i class="fa fa-flag"></i></button>
                        <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Podgląd"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edycja"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fa fa-trash"></i></button>
                   </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection