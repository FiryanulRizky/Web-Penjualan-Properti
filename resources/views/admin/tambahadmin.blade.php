<div class="column displaybox">
  @include('admin.navprofile')
  <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
    <ul>
      <li><a href="/admin">Admin</a></li>
      <li class="is-active"><a href="/profil">Tambah Admin</a></li>
    </ul>
  </nav>
  <div class="columns is-mobile is-centered">
    <div class="column is-half">
      @include('layouts.errors') @if(session()->has('message'))
      <div class="notification is-success">
        <button class="delete"></button>
        <h1 class="is-size-7"><b> {{ session()->get('message') }}</b></h1>
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
    <div class="containerx" style="padding: 0 10% 0 10%;">
      <h1 class="title has-text-centered">Tambah Administrator</h1>
      <form action="/admin/tambah" method="post" enctype="multipart/form-data">
        @csrf
        <div class="field">
          <label class="label">Nama</label>
          <p class="control has-icons-left">
            <input class="input" type="text" placeholder="Masukkan Nama Admin" name="name">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <label class="label">Email</label>
          <p class="control has-icons-left">
            <input class="input" type="email" placeholder="Masukkan Email Admin" name="email">
            <span class="icon is-small is-left">
              <i class="fas fa-at"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <label class="label">Password</label>
          <p class="control has-icons-left">
            <input class="input" type="password" placeholder="Masukkan Password Admin" name="password">
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <label class="checkbox">
            <input type="checkbox" name="issuper">
            Izinkan Super Admin
          </label>
        </div>
        <div class="field">
          <p class="control has-text-centered">
            <button type="submit" class="button is-success">
              <span class="buttonspace">Tambah Admin</span>
            </button>
          </p>
        </div>
      </form>
    </div>
  </div>
</div>
<br>
<br>
</div>