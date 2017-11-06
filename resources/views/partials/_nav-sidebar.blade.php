<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img height="40" src="{{ url('images/note-2.png') }}"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Note</b>ww
                <img height="40" src="{{ url('images/note-2.png') }}">
            </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url('images/placeholder_logo.png') }}"
                             class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ url('images/placeholder_logo.png') }}"
                                 class="img-circle" alt="User Image">

                            <p>
                                {{ Auth::user()->name }}
                                <small>Dołączył/a {{ date('d-m-Y', strtotime(Auth::user()->created_at)) }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">#</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">#</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">#</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat logout">Wyloguj</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('images/placeholder_logo.png') }}"
                     class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p class="margin-top-10">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <!-- search form -->
        <form method="GET" action="{{ route('notes.index') }}" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Szukaj notatki..." value="{{ app('request')->search }}">
                <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ \Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-home"></i> <span>Strona główna</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li class="treeview {{ strpos(app('request')->path(), 'notes') !== false ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-sticky-note-o"></i>
                    <span>Notatki</span>
                    <span class="pull-right-container">
                           <span class="label label-warning pull-right">{{ Helper::countNotes(0) }}</span>
                           <span class="label label-success pull-right notesCount">{{ Helper::countNotes() }}</span>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ \Request::is('notes') ? 'active' : '' }}"><a href="{{ url('notes') }}"><i
                                    class="fa fa-list"></i> Lista</a></li>
                    <li class="{{ \Request::is('notes/create') ? 'active' : '' }}"><a class="add-note"
                                href="{{ url('notes/create') }}"><i class="fa fa-plus"></i> Dodaj notatkę</a></li>
                    {{--<li class="{{ \Request::is('notes/tasks') ? 'active' : '' }}"><a href="#"><i--}}
                                    {{--class="fa fa-tasks"></i> Zadania</a></li>--}}
                </ul>
                <li class="{{ \Request::is('calendar') ? 'active' : '' }}">
                    <a href="{{ url('calendar') }}">
                        <i class="fa fa-calendar"></i><span>Kalendarz</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
            </li>
            {{--<li class="treeview {{ strpos(app('request')->path(), 'documents') !== false ? 'active' : '' }}">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-file-text-o"></i>--}}
                    {{--<span>Dokumenty</span>--}}
                    {{--<span class="pull-right-container">--}}
                           {{--<span class="label label-primary pull-right">0</span>--}}
                        {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li class="{{ \Request::is('notes') ? 'active' : '' }}"><a href="{{ url('notes') }}"><i--}}
                                    {{--class="fa fa-list"></i> Lista</a></li>--}}
                    {{--<li class="{{ \Request::is('notes/create') ? 'active' : '' }}"><a--}}
                                {{--href="{{ url('notes/create') }}"><i class="fa fa-plus"></i> Dodaj dokument</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="header">DODATKOWE</li>--}}
            {{--<li class="{{ \Request::is('/changelog') ? 'active' : '' }}">--}}
                {{--<a href="{{ url('/') }}">--}}
                    {{--<i class="fa fa-code"></i> <span>Co nowego</span>--}}
                    {{--<span class="pull-right-container">--}}
                        {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>