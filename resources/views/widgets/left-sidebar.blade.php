<div id="left-sidebar" class="sidenav">

    <ul class="nav nav-tabs" id="sidebarTabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Szybka notka</a>
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
            </div>
           <div class="form-group">
               <label for="content">Opis</label>
               <textarea class="form-control" name="content" id="content" rows="5"></textarea>
             </div>
             {{--<div class="form-group responsible-select">--}}
                {{--<label for="optgroup">Widoczne dla--}}
                    {{--<i id="select-all" data-toggle="tooltip" data-placement="top" title="Zaznacz wszystkich" class="fa fa-user-plus"></i>--}}
                    {{--<i id="deselect-all" data-toggle="tooltip" data-placement="top" title="Odznacz wszystkich" class="fa fa-user-times"></i>--}}
                {{--</label>--}}
                {{--<select id='optgroup' multiple='multiple'>--}}
                  {{--<optgroup label='Znajomi'>--}}
                    {{--<option value='1'>Yoda</option>--}}
                    {{--<option value='2'>Obiwan</option>--}}
                  {{--</optgroup>--}}
                  {{--<optgroup label='Grupa'>--}}
                    {{--<option value='3'>Palpatine</option>--}}
                    {{--<option value='4' disabled>Darth Vader</option>--}}
                  {{--</optgroup>--}}
                {{--</select>--}}
             {{--</div>--}}
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" name="important_note" class="form-check-input">
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Zapisz</button>
          </form>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
             <form method="GET" action="{{ route('notes.store') }}">
               {{--<div class="form-group">--}}
                 {{--<label class="form-control-label" for="formGroupExampleInput">Example label</label>--}}
                 {{--<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">--}}
               {{--</div>--}}
               {{--<div class="form-group">--}}
                 {{--<label class="form-control-label" for="formGroupExampleInput2">Another label</label>--}}
                 {{--<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">--}}
               {{--</div>--}}

                 <div class="form-group">
                    <label for="exampleFormControlSelect1">Wyników na stronie</label>
                    <select class="form-control" name="limit" id="exampleFormControlSelect1">
                      <option value="8">8</option>
                      <option value="16">16</option>
                      <option value="32">32</option>
                      <option value="64">64</option>
                    </select>
                  </div>

             {{--<div class="form-check">--}}
               {{--<label class="form-check-label">--}}
                 {{--<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>--}}
                 {{--Option one is this and that&mdash;be sure to include why it's great--}}
               {{--</label>--}}
             {{--</div>--}}
             {{--<div class="form-check">--}}
               {{--<label class="form-check-label">--}}
                 {{--<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">--}}
                 {{--Option two can be something else and selecting it will deselect option one--}}
               {{--</label>--}}
             {{--</div>--}}
             {{--<div class="form-check disabled">--}}
               {{--<label class="form-check-label">--}}
                 {{--<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>--}}
                 {{--Option three is disabled--}}
               {{--</label>--}}
             {{--</div>--}}

             {{--<div class="form-check">--}}
               {{--<label class="form-check-label">--}}
                 {{--<input class="form-check-input" type="checkbox" value="">--}}
                 {{--Option one is this and that&mdash;be sure to include why it's great--}}
               {{--</label>--}}
             {{--</div>--}}
             {{--<div class="form-check disabled">--}}
               {{--<label class="form-check-label">--}}
                 {{--<input class="form-check-input" type="checkbox" value="" disabled>--}}
                 {{--Option two is disabled--}}
               {{--</label>--}}
             {{--</div>--}}
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtruj</button>
             </form>
      </div>
    </div>

</div>