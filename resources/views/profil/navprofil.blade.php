<nav class="navbar profilenavbar" role="navigation" aria-label="main navigation">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-end is-pulled-right">
            <div class="navbar-item is-pulled-right">
                <div class="buttons is-pulled-right">
                    <style>
                    </style>
                    @if(Auth::guard('admin')->check())
                        <a class="button is-transaprent is-pulled-right" href="#">
                    @endif
                    <a class="button is-transaprent is-pulled-right" href="/profil/pesan">
                        <span>
                            @if($messages->count() > 0)
                                <i class="far fa-envelope has-text-danger"></i>
                                <span class="has-text-danger has-text-weight-bold">{{$messages->count()}}</span>
                            @else
                                <i class="far fa-envelope"></i>
                            @endif
                        </span>

                    </a>
                    <a class="button is-light is-pulled-right nounderlinebtn" href="{{ route('logout') }}">
                      Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>