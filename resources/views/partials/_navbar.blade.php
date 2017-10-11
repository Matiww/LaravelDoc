<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top circle">
  <a class="navbar-brand" href="#">Laravel<span class="site-title-second">Doc</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ \Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">Strona główna</a>
      </li>
      <li class="nav-item {{ \Request::is('notes') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('notes') }}">Notatki</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        <form>
          <input class="form-control mr-sm-2" type="text" placeholder="Fraza" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i> Szukaj</button>
        </form>
          <ul class="navbar-nav mr-auto">
                <li class="nav-item profile-nav">
                   <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                </li>
            <li class="nav-item logout-nav">
                  <a class="nav-link logout" href="{{ route('logout') }}">Wyloguj</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
            </li>
          </ul>
    </div>
  </div>
</nav>