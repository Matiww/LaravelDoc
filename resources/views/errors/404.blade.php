@extends('errors/layout')

@section('title', 'Page Not Found')

@section('message')
    <h1>404</h1>
    <p>Strona o podanym adresie nie istnieje.</p>
    <a class="btn btn-primary" href="{{ url('/') }}">Powrót</a>
@endsection
