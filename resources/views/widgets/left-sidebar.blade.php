<div id="left-sidebar" class="sidenav">

    <ul class="nav nav-tabs" id="sidebarTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-expanded="true">Szybka notka</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Filtry</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form method="POST" action="{{ route('notes.store') }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="title">Tytuł</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="" required>
                    {{--<small id="titleHelp" class="form-text text-muted">Do 40 znaków zanim zostanie ucięty na liście.</small>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    <label for="content">Opis</label>
                    <textarea class="form-control" name="content" id="content" rows="5"></textarea>
                    {{--<small id="contentHelp" class="form-text text-muted">Od 15 do {{ \App\Http\Controllers\NoteController::NOTE_CONTENT_LENGTH }} znaków zanim zostanie ucięty na liście.</small>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    <label for="date">Data</label>
                    <input type="date" name="date" class="form-control" id="date" placeholder="">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="important_note" class="form-check-input important-note">
                        Ważna notatka
                    </label>
                </div>
                {{--<div class="form-check">--}}
                {{--<label class="form-check-label">--}}
                {{--<input type="checkbox" name="private_note" class="form-check-input private-note">--}}
                {{--Prywatna notatka--}}
                {{--</label>--}}
                {{--</div>--}}
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type="submit" class="btn btn-primary save-note"><i class="fa fa-floppy-o"></i> Zapisz</button>
            </form>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form method="GET" action="{{ route('notes.store') }}">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Wyników na stronie</label>
                    <select class="form-control" name="limit" id="exampleFormControlSelect1">
                        <option value="8">8</option>
                        <option value="16">16</option>
                        <option value="32">32</option>
                        <option value="64">64</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtruj</button>
            </form>
        </div>
    </div>

</div>