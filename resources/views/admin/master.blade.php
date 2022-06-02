<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Panel Administrator - E-Commerce Properti</title>

  {{-- CSS Files --}}
  <link rel="stylesheet" href="/css/bulma.min.css">
  <link rel="stylesheet" href="/css/custom.css">
  <link rel="stylesheet" href="/css/bootstrap.css"> {{-- Google Fonts --}}
  <link
    href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
    rel="stylesheet">

</head>

<body>
  <div class="columns panelboard">
    <div class="column is-one-fifth adminsidebar">
      <aside class="menu">
        <br>
        <br>
        <div class="subtitle has-text-white has-text-centered">
          @if (Auth::user()->issuper)
          Panel Super Admin
          @else
          Admin Panel
          @endif
        </div>
        <figure class="image is-96x96 profileavatar adminprofileavatar adminavatar" id="myBtn">
          <img class="is-rounded is-centered has-text-centered adminavatarstyle"
            src="/uploads/avatars/{{Auth::user()->avatar}}">
          <figcaption>
            <p class="has-text-centered has-text-white"><span><i class="fas fa-cloud-upload-alt"></i></span><br>Change
            </p>
          </figcaption>
        </figure>
        <p class="has-text-white is-4 is-size-7 has-text-weight-bold has-text-centered is-uppercase">Selamat Datang,
          {{Auth::user()->name}}</p>
        <p class="menu-label is-4 is-size-7 has-text-weight-bold has-text-dark is-uppercase">
          <i class="fas fa-pastafarianism"></i> Umum
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/admin">Dashboard</a></li>
        </ul>
        <p class="menu-label is-4 is-size-7 has-text-weight-bold has-text-dark is-uppercase">
          <i class="fas fa-home"></i> Manajemen Properti
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/admin/properti/semua">Semua</a></li>
          <li><a href="/admin/properti/rumah">Rumah</a></li>
          <li><a href="/admin/properti/lahan">Lahan</a></li>
          <li><a href="/admin/properti/gedung">Gedung</a></li>
          <li><a href="/admin/properti/apartemen">Apartemen</a></li>
          <li><a href="/admin/properti/gudang">Gudang</a></li>
        </ul>
        <p class="menu-label has-text-dark is-4 is-size-7 has-text-weight-bold is-uppercase">
          <i class="fas fa-lock"></i> Manajemen Report
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/admin/report"> Lihat Report</a></li>
        </ul>
        <p class="menu-label has-text-dark is-4 is-size-7 has-text-weight-bold is-uppercase">
          <i class="fab fa-blogger-b"></i> Manajemen Blog
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/blog/baru">Artikel Baru</a></li>
          <li><a href="/admin/artikel"> Lihat Artikel</a></li>
        </ul>
        <p class="menu-label has-text-dark is-4 is-size-7 has-text-weight-bold is-uppercase">
          <i class="fab fa-blogger-b"></i> Manajemen Pertanyaan
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/admin/pertanyaan/tampil">Lihat Pertanyaan</a></li>
        </ul>
        <p class="menu-label has-text-dark is-4 is-size-7 has-text-weight-bold is-uppercase">
          <i class="fas fa-users"></i> Manajemen User
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/admin/user/tambah">User Baru</a></li>
          <li><a href="/admin/user/semua">Lihat User</a></li>
        </ul>
        <p class="menu-label has-text-dark is-4 is-size-7 has-text-weight-bold is-uppercase">
          <i class="fas fa-user-shield"></i> Manajemen Administrator
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="/admin/tambah">Admin Baru</a></li>
          <li><a href="/admin/semua">Lihat Admin</a></li>
        </ul>
        <p class="menu-label has-text-dark is-4 is-size-7 has-text-weight-bold is-uppercase">
          <i class="fas fa-cogs"></i> Lainnya
        </p>
        <ul class="menu-list adminlistitem">
          <li><a href="{{ route('admin.logout') }}">Logout</a></li>
        </ul>
      </aside>
    </div>
    @if(Request::is('admin'))
    @include('admin.dashboard')
    @elseif(Request::is('admin/user/*/tampil'))
    @include('admin.tampiluser')
    @elseif(Request::is('admin/user/*/kontak'))
    @include('admin.kontakuser')
    @elseif(Request::is('admin/user/*/edit'))
    @include('admin.edituser')
    @elseif(Request::is('admin/user/tambah'))
    @include('admin.tambahuser')
    @elseif(Request::is('admin/rumah/*/edit'))
    @include('profil.editrumah')
    @elseif(Request::is('admin/lahan/*/edit'))
    @include('profil.editlahan')
    @elseif(Request::is('admin/gedung/*/edit'))
    @include('profil.editgedung')
    @elseif(Request::is('admin/apartemen/*/edit'))
    @include('profil.editapartemen')
    @elseif(Request::is('admin/gudang/*/edit'))
    @include('profil.editgudang')
    @elseif(Request::is('admin/properti/semua'))
    @include('admin.semuaproperti')
    @elseif(Request::is('admin/properti/rumah'))
    @include('admin.semuarumah')
    @elseif(Request::is('admin/properti/lahan'))
    @include('admin.semualahan')
    @elseif(Request::is('admin/properti/gedung'))
    @include('admin.semuagedung')
    @elseif(Request::is('admin/properti/apartemen'))
    @include('admin.semua_apartemen')
    @elseif(Request::is('admin/properti/gudang'))
    @include('admin.semuagudang')
    @elseif(Request::is('admin/user/semua'))
    @include('admin.semuauser')
    @elseif(Request::is('admin/semua'))
    @include('admin.semua_admin')
    @elseif(Request::is('admin/tambah'))
    @include('admin.tambahadmin')
    @elseif(Request::is('admin/*/edit'))
    @include('admin.editadmin')
    @elseif(Request::is('admin/report'))
    @include('admin.report')
    @elseif(Request::is('admin/artikel'))
    @include('admin.semua_artikel')
    @elseif(Request::is('admin/pertanyaan/tampil'))
    @include('admin.semuapertanyaan')
    @elseif(Request::is('admin/pertanyaan/*/balas'))
    @include('admin.balaspertanyaan')
    @else
    @include('admin.dashboard') @endif
    <div id="myModal" class="modal column is-half is-offset-one-quarter">
      <div class="modal-content">
        <div class="is-pulled-right">
          <span class="close has-text-danger"><i class="far fa-times-circle"></i></span>
        </div>
        <p>Pilih Foto Profil</p>
        <form action="/admin/updateavatar" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="file has-name is-centered">
            <label class="file-label">
              <input class="file-input" type="file" name="avatar" id="file-input">
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                  Pilih File…
                </span>
              </span>
              <div class="file-name has-text-dark" id="file-name">

              </div>
            </label>
          </div>
          <br>
          <div class="field is-centered has-text-centered">
            <button type="submit" class="button is-primary"><span class="savebutton">Simpan</span></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- JavaScript Files --}}
  <script src="/js/jquery-3.3.1.min.js"></script>
  <script src="/js/fontawesome.js"></script>
  <script src="/js/bootstrap.js"></script>
  <script src="/js/sweetalert2.all.min.js"></script>
  <script src="/js/sweetalert.min.js"></script>
  @include('sweetalert::alert')
  <script>
    var modal = document.getElementById('myModal');
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];
            btn.onclick = function() {
              modal.style.display = "block";
            }
            span.onclick = function() {
              modal.style.display = "none";
            }
            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            }

            //Display File Name
            var input = document.getElementById( 'file-input' );
            var infoArea = document.getElementById( 'file-name' );
            input.addEventListener( 'change', showFileName );
            function showFileName( event ) {      
            var input = event.srcElement;         
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
}
  </script>

</body>

</html>