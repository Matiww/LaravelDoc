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
        <div class="col-md-8 show-note-container">
            <div class="show-note">
                <h1 class="display-4">
                    {{ $note->title }}
                </h1>
                <blockquote class="blockquote">
                  <p class="mb-0">{!! nl2br(e($note->content)) !!}</p>
                  <footer class="blockquote-footer"><cite title="Source Title">{{ $note->name }}</cite></footer>
                </blockquote>
                <p>
                    Dodano: {{ date('d-m-Y H:i:s', strtotime($note->created_at)) }}
                </p>
                <p>
                    Ostatnia aktualizacja: {{ date('d-m-Y H:i:s', strtotime($note->updated_at)) }}
                </p>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection