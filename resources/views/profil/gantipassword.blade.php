<div class="column displaybox">
  @include('profil.navprofil')
  <nav class="breadcrumb has-arrow-separator has-background-white" aria-label="breadcrumbs">
    <ul>
      <li><a href="/profil">Profil</a></li>
      <li class="is-active"><a href="/profil">Ganti Password</a></li>
    </ul>
  </nav>
  <div class="columns is-mobile is-centered">
      <div class="column is-half">
          @include('layouts.errors') 
          @if(session()->has('errormsg'))
          <div class="notification is-danger">
              <button class="delete"></button>
              <h1 class="is-size-7"><b> {{ session()->get('errormsg') }}</b></h1>
          </div>
          @endif
          @if(session()->has('warningmsg'))
          <div class="notification is-warning">
              <button class="delete"></button>
              <h1 class="is-size-7"><b> {{ session()->get('warningmsg') }}</b></h1>
          </div>
          @endif
          @if(session()->has('success'))
          <div class="notification is-success">
              <button class="delete"></button>
              <h1 class="is-size-7"><b> {{ session()->get('success') }}</b></h1>
          </div>
          @endif
      </div>
      <script>
          document.addEventListener('DOMContentLoaded', () => {
              (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                  $notification = $delete.parentNode;
                  $delete.addEventListener('click', () => {
                      $notification.parentNode.removeChild($notification);
                  });
              });
          });
      </script>
  </div>
  <div class="card cardmargin">
    <div class="containerx">
      <h1 class="title has-text-centered"> Ganti Password</h1>
      <div class="centerinputbox">
        <form action="/profile/updatepassword" method="post">
          @csrf
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Password Saat ini" name="current_password">
              <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Password Baru" name="password">
              <span class="icon is-small is-left">
                                                    <i class="fas fa-lock"></i>
                                                  </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Konfirmasi Password Baru" name="password_confirmation">
              <span class="icon is-small is-left">
                                                        <i class="fas fa-lock"></i>
                                                      </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-text-centered">
              <button class="button is-success" type="submit">
                                                <span class="buttonspace">Simpan</span>
                                              </button>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>