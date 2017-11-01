<div id="left-sidebar" class="sidenav">
    <ul class="nav nav-tabs" id="sidebarTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ isset(app('request')->limit) ? '' : 'active' }}" id="home-tab" data-toggle="tab"
               href="#home" role="tab" aria-controls="home"
               aria-expanded="true">Szybka notka</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset(app('request')->limit) ? 'active' : '' }}" id="profile-tab" data-toggle="tab"
               href="#profile" role="tab" aria-controls="profile">Filtry</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show {{ isset(app('request')->limit) ? '' : 'active' }}" id="home" role="tabpanel"
             aria-labelledby="home-tab">
            <form method="POST" action="{{ route('notes.store') }}">
                <div class="alert alert-danger display-none">
                    <ul class="errors-list">
                    </ul>
                </div>
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
                {{--<div class="form-check">--}}
                    {{--<label class="form-check-label">--}}
                        {{--<input type="checkbox" name="important_note" class="form-check-input important-note">--}}
                        {{--Ważna notatka--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="form-group display-none scale-handle">--}}
                    {{--Skala ważności--}}
                    {{--<input type="text" id="scale" name="scale_level" disabled />--}}
                {{--</div>--}}
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
        <div class="tab-pane fade show {{ isset(app('request')->limit) ? 'active' : '' }}" id="profile" role="tabpanel"
             aria-labelledby="profile-tab">
            <form method="GET" action="{{ route('notes.index') }}">
                <div class="form-group">
                    <label for="dateFrom">Data od</label>
                    <input type="date" class="form-control" id="dateFrom" placeholder="">
                </div>
                <div class="form-group">
                    <label for="dateTo">Data do</label>
                    <input type="date" class="form-control" id="dateTo" placeholder="">
                </div>
                <div class="form-group">
                    <label for="notesPerPage">Wyników na stronie</label>
                    <select class="form-control" name="limit" id="notesPerPage">
                        <option value="{{ \App\Http\Controllers\NoteController::NOTES_PER_PAGE }}">{{ \App\Http\Controllers\NoteController::NOTES_PER_PAGE }}
                            (default)
                        </option>
                        <option value="8">8</option>
                        <option value="16">16</option>
                        <option value="32">32</option>
                        <option value="64">64</option>
                    </select>
                </div>
                <label>Wyświetl</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="important" id="radio1"
                               value="1" {{ app('request')->important === '1' ? 'checked' : '' }}>
                        Ważne
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="important" id="radio2"
                               value="0" {{ app('request')->important === '0' ? 'checked' : '' }}>
                        Nie oznaczone
                    </label>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtruj</button>
                @if(app('request')->limit)
                    <button data-url="{{ url('notes') }}" type="button" class="btn btn-danger refresh-filters"><i
                                class="fa fa-refresh" aria-hidden="true"></i> Wyczyść
                    </button>
                @endif
            </form>
        </div>
    </div>

</div>