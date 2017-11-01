<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top circle">
    <a class="navbar-brand logo-a" href="{{ url('/') }}">Note<span class="site-title-second">ww</span><span
                class="logo"></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ \Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">@lang('site.home')</a>
            </li>
            <li class="nav-item {{ \Request::is('notes') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('notes') }}">@lang('site.notes')</a>
            </li>
            <li class="nav-item {{ \Request::is('notes/create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('notes/create') }}">@lang('site.add_note')</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <form id="note-search-form" class="display-none" method="GET" action="{{ route('notes.index') }}">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Fraza" value="{{ app('request')->search }}" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
            </form>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item search-menu">
                    <a class="nav-link" href="#"><i class="fa fa-search"></i> Szukaj</a>
                </li>
                {{--<li class="nav-item lang-menu">--}}
                    {{--<a class="nav-link" href="#"><i class="fa fa-language"></i> Język</a>--}}
                {{--</li>--}}
                <li class="nav-item profile-nav">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item logout-nav">
                    <a class="nav-link logout" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> @lang('site.logout')</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <div class="lang-options display-none">
                <ul>
                    <li><img src="{{ url('images/pl.png') }}"> polski</li>
                    <li><img src="{{ url('images/en.png') }}"> angielski</li>
                    <li><img src="{{ url('images/es.png') }}"> hiszpański</li>
                    <li><img src="{{ url('images/de.png') }}"> niemiecki</li>
                </ul>
            </div>
        </div>
    </div>
</nav>