@extends('main')
@section('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/fullcalendar-3.6.1/fullcalendar.css') }}" crossorigin="anonymous">
@endsection
@section('javascripts')
<script src="{{ asset('plugins/fullcalendar-3.6.1/lib/moment.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/fullcalendar-3.6.1/fullcalendar.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/fullcalendar-3.6.1/locale/pl.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/welcome.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 calendar-container">
        <div id='calendar'></div>
    </div>
</div>
@endsection