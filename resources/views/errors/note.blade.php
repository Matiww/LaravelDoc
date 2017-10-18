@extends('errors/layout')

@section('title', 'Page Not Found')

@section('message')
    <p>Notatka nie istnieje lub nie masz uprawnień, aby ją zobaczyć.</p>
    <a class="btn btn-primary" href="{{ url('/notes') }}">Powrót</a>
@endsection
