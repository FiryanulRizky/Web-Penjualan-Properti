<nav class="navbar is-transparent navcolor">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
        <img src="img/logo.png" width="112" height="28">
      </a>
    <div class="navbar-burger burger navcolor" onclick="document.querySelector('.navbar-menu').classList.toggle('is-active');"
      data-target="navid">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="navid" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item menutext" href="/rumah">
                Rumah
            </a>
      <a class="navbar-item menutext" href="/lahan">
                Lahan
            </a>
      <a class="navbar-item menutext" href="/apartemen">
                Apartemen
            </a>
      <a class="navbar-item menutext thisactive" href="/gedung">
                Gedung
            </a>
      <a class="navbar-item menutext" href="/gudang">
              Gudang
            </a>
      <a class="navbar-item menutext" href="/blog">
              Blog
            </a>
      <a class="navbar-item menutext" href="/tentangkami">
              Tentang Kami
            </a>
      <a class="navbar-item menutext" href="/kontak_kami">
              Kontak Kami
            </a>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
          <div class="field is-grouped">
            @guest
            <p class="control">
              <a class="button is-primary is-inverted is-outlined signupbutton" href="{{ route('login') }}">
                      <span>
                        Login
                      </span>
                    </a>
            </p>
            @if (Route::has('register'))
            <p class="control">
              <a class="button is-primary is-inverted is-outlined loginbutton" href="{{ route('register') }}">
                      <span>Register</span>
                    </a>
            </p>
            @endif @else
            <div class="dropdown is-hoverable">
              <div class="dropdown-trigger">
                <button class="button is-primary is-inverted is-outlined usermenu" aria-haspopup="true" aria-controls="dropdown-menu3">
                          <span>{{ Auth::user()->name }}</span>
                          <span class="icon is-small">
                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                          </span>
                        </button>
              </div>
              <div class="dropdown-menu" id="dropdown-menu3" role="menu">
                <div class="dropdown-content">
                  <a href="/profil" target="_blank" class="dropdown-item">Profil Saya</a>
                  <a href="/tambahproperti" class="dropdown-item">Tambah Properti</a>
                  <a href="/profil/gantipassword target="_blank" class="dropdown-item">Ganti Password</a>
                  <a href="/kontak_kami" class="dropdown-item">Kontak</a>
                  <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                          </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </div>
            </div>
            @endguest
          </div>
        </div>
      </div>
    </div>
  </nav>