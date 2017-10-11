<div id="left-sidebar" class="sidenav">

    <ul class="nav nav-tabs" id="sidebarTabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Dodaj notatkę</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Filtry</a>
      </li>
      <li class="nav-item">
         <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Tytuł</label>
              <input type="text" class="form-control" id="exampleInput1" aria-describedby="emailHelp" placeholder="">
            </div>
           <div class="form-group">
               <label for="exampleFormControlTextarea1">Opis</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
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
                <input type="checkbox" class="form-check-input">
                Ważna notatka
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input private-note">
                Prywatna notatka
              </label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Zapisz</button>
          </form>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
             <form>
               <div class="form-group">
                 <label class="form-control-label" for="formGroupExampleInput">Example label</label>
                 <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
               </div>
               <div class="form-group">
                 <label class="form-control-label" for="formGroupExampleInput2">Another label</label>
                 <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
               </div>
             </form>

             <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>

             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                 Option one is this and that&mdash;be sure to include why it's great
               </label>
             </div>
             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                 Option two can be something else and selecting it will deselect option one
               </label>
             </div>
             <div class="form-check disabled">
               <label class="form-check-label">
                 <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                 Option three is disabled
               </label>
             </div>

             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox" value="">
                 Option one is this and that&mdash;be sure to include why it's great
               </label>
             </div>
             <div class="form-check disabled">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox" value="" disabled>
                 Option two is disabled
               </label>
             </div>
             <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtruj</button></div>
    </div>

</div>