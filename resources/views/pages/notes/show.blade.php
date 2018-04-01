@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Strona główna</a></li>
            <li><a href="{{ url('notes') }}"><i class="fa fa-sticky-note-o"></i> Notatki</a></li>
            <li class="active"><i class="fa fa-eye"></i> Podgląd</li>
        </ol>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Podgląd
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="preview-box">
                        <h1>{{ $note->title }}</h1>
                        <article>
                            @if(!empty($note->content))
                                <content>
                                    <blockquote class="blockquote">
                                        <p>{!! nl2br(e($note->content)) !!}</p>
                                        <footer><cite title="author">{{ $note->name }}</cite></footer>
                                    </blockquote>
                                </content>
                            @else
                                <p>
                                    Przez: {{ $note->user->email }}
                                </p>
                            @endif
                            <p>
                                Dodano: {{ date('d-m-Y H:i:s', strtotime($note->created_at)) }}
                            </p>
                            <p>
                                Ostatnia aktualizacja: {{ date('d-m-Y H:i:s', strtotime($note->updated_at)) }}
                            </p>
                        </article>
                    </div>
                        <a href="{{ url()->previous() }}" type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Wróć</a>
                        <div class="float-right">
                            <a href="{{ url('notes') }}/{{ $note->id }}/edit" type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Edytuj</a>
                        </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection