@extends('layouts.main')
@section('title', 'Strona główna')
@section('javascripts')
    <script src="{{ asset('js/welcome.js') }}"></script>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <ol class="breadcrumb">
            <li class="active"><a href="{{ url('/') }}"><i class="fa fa-home"></i> Strona główna</a></li>
        </ol>
        <section class="content-header">
            <h1>
                Strona główna
                <small>Informacje odnośnie notatek i zbliżających się terminów</small>
            </h1>
            <div class="home-actions">
                <a href="{{ url('notes/create') }}" class="btn btn-sm btn-primary btn-flat"><i
                            class="fa fa-plus"></i> Dodaj notatkę</a>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ Helper::countNotes() }}</h3>

                            <p>Notatki</p>
                        </div>
                        <div class="icon">
                            <i class="ion-clipboard"></i>
                        </div>
                        <a href="{{ url('/notes') }}" class="small-box-footer">Więcej <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ Helper::countNotes(1) }}</h3>

                            <p>Ważne</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-star-outline"></i>
                        </div>
                        <a href="#" class="small-box-footer">Soon™ <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ Helper::countNotes(2) }}</h3>

                            <p>Bardzo ważne</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-star-outline"></i><i class="ion-ios-star-outline"></i>
                        </div>
                        <a href="#" class="small-box-footer">Soon™ <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ Helper::countNotes(3) }}</h3>

                            <p>Najważniejsze</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-star-outline"></i><i class="ion-ios-star-outline"></i><i class="ion-ios-star-outline"></i>
                        </div>
                        <a href="#" class="small-box-footer">Soon™ <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">10 najważniejszych notatek</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                       aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Tytuł
                                        </th>
                                        <th class="sorting width-20" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Ważność
                                        </th>
                                        <th class="sorting width-20" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Akcje
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($important) > 0)
                                        @foreach($important as $note)
                                            @php
                                                $importantKey = array_search($note->important, \App\Http\Controllers\NoteController::IMPORTANT_NOTE)
                                            @endphp
                                            <tr role="row" class="odd">
                                                <td><a href="{{ url('/notes/'.$note->id) }}">{{ $note->title }}</a></td>
                                                <td>{{ \App\Http\Controllers\NoteController::IMPORTANT_NOTE_DESCRIPTION[$importantKey] }}</td>
                                                <td>
                                                    <span class="label label-{{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? 'success' : 'warning' }}">
                                                        {{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? 'Aktywna' : 'Zablokowana' }}
                                                    </span>
                                                </td>
                                                <td style="width:12%" class="notes-actions">
                                                    @include('pages.notes.actions')
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Brak notatek</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">10 notatek ze zbliżającymi się terminami</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                       aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Tytuł
                                        </th>
                                        <th class="sorting width-20" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Termin
                                        </th>
                                        <th class="sorting width-20" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Akcje
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($dueDates) > 0)
                                        @foreach($dueDates as $note)
                                            <tr role="row" class="odd">
                                                <td><a href="{{ url('/notes/'.$note->id) }}">{{ $note->title }}</a></td>
                                                <td>{{ !is_null($note->date) ? date('d-m-Y', strtotime($note->date)) : '-' }}</td>
                                                <td>
                                                    <span class="label label-{{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? 'success' : 'warning' }}">
                                                        {{ $note->active == \App\Http\Controllers\NoteController::NOTES_ACTIVE ? 'Aktywna' : 'Zablokowana' }}
                                                    </span>
                                                </td>
                                                <td style="width:12%" class="notes-actions">
                                                    @include('pages.notes.actions')
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Brak notatek</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection