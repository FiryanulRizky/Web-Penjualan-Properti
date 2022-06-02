<div class="column displaybox">
    @include('admin.navprofile')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/admin">Admin</a></li>
            <li class="is-active"><a href="/profil">Edit User</a></li>
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
            <h1 class="title has-text-centered">Edit User - {{$user->name}}</h1>
            <form action="/admin/user/edit" method="post" enctype="multipart/form-data">
              @csrf
              <div class="field">
                  <label class="label">Id</label>
                  <p class="control has-icons-left">
                    <input class="input" type="text" value="{{$user->id}}" placeholder="Id User" name="id" readonly>
                    <span class="icon is-small is-left">
                      <i class="fas fa-user"></i>
                    </span>
                  </p>
                </div>
              <div class="field">
                <label class="label">Nama</label>
                <p class="control has-icons-left">
                  <input class="input" type="text" value="{{$user->name}}" placeholder="Masukkan Nama" name="name">
                  <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                  <label class="label">Email</label>
                <p class="control has-icons-left">
                  <input class="input" type="email" value="{{$user->email}}" placeholder="Masukkan Email" name="email">
                  <span class="icon is-small is-left">
                    <i class="fas fa-at"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                  <label class="label">Deskripsi (Maks 100 Kata)</label>
                <p class="control has-icons-left">
                  <input class="input" type="text" value="{{$user->description}}" placeholder="Deskripsi (Maks 100 Kata)" name="descrption">
                  <span class="icon is-small is-left">
                        <i class="fas fa-address-card"></i>
                    </span>
                </p>
          </div>
          <div class="field">
              <label class="label">NIC</label>
            <p class="control has-icons-left">
              <input class="input" type="text" value="{{$user->NIC}}" placeholder="NIC" name="nic">
              <span class="icon is-small is-left">
                <i class="fas fa-id-badge"></i>
              </span>
            </p>
          </div>
          <div class="field">
              <label class="label">Alamat</label>
            <p class="control has-icons-left">
              <input class="input" type="text" value="{{$user->address}}" placeholder="Masukkan Alamat" name="address">
              <span class="icon is-small is-left">
                <i class="fas fa-location-arrow"></i>
              </span>
            </p>
          </div>
          <div class="field">
              <label class="label">Kota</label>
            <p class="control has-icons-left">
              <input class="input" type="text" value="{{$user->city}}" placeholder="Masukkan Kota Tinggal" name="city">
              <span class="icon is-small is-left">
                <i class="fas fa-thumbtack"></i>
              </span>
            </p>
          </div>
          <div class="field">
              <label class="label">Jenis Kelamin</label>
            <div class="control has-icons-left">
              <div class="select">
              <select name="gender">
                <option>Laki-Laki</option>
                <option>Perempuan</option>
              </select>
              <span class="icon is-small is-left">
                <i class="fas fa-venus-mars"></i>
              </span>
          </div>
        </div>
        </div>
        <div class="field">
              <label class="label">No. HP</label>
            <p class="control has-icons-left">
              <input class="input" type="text" value="{{$user->phoneNo}}" placeholder="Masukkan No. HP" name="phoneno">
              <span class="icon is-small is-left">
                <i class="fas fa-phone-volume"></i>
              </span>
            </p>
          </div>
          <div class="field">
              <label class="label">Foto Profil</label>
              <div class="column image is-128x128"><img class="is-rounded" src="/uploads/avatars/{{$user->avatar}}" /></div>
              <input  class="input" type="file" name="avatar" value="{{$user->avatar}}">
            </div>
          <div class="field">
            <p class="control has-text-centered">
              <button type="submit" class="button is-success">
                    <span class="buttonspace">Simpan</span>
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