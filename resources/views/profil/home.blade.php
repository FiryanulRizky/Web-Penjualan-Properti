<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Profil {{$user->name}}</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/sweetalert2.min.css">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600" rel="stylesheet">

</head>
<body>
    <div class="columns panelboard">
        <div class="column is-one-fifth sidebar">
            <aside class="menu">
                <figure class="image is-128x128 profileavatar" id="myBtn">
                    <img class="is-rounded is-centered has-text-centered avatarstyle" src="/uploads/avatars/{{auth()->user()->avatar}}">
                    <figcaption>
                      <h5 class="has-text-centered has-text-white"><span><i class="fas fa-cloud-upload-alt"></i></span><br>Ganti Foto</h5>
                    </figcaption>	
                </figure>
                <p class="has-text-dark has-text-centered is-4 is-size-7 has-text-weight-bold is-uppercase">Selamat Datang, {{auth()->user()->name}}</p>
                <p class="menu-label has-text-link is-4 is-size-7 has-text-weight-bold is-uppercase">
                  Umum
                </p>
                <ul class="menu-list listitem is-size-6">
                  <li><a href="/profil">Dashboard</a></li>
                  <li><a href="/profil/favoritsaya">Favorit</a></li>
                  <li><a href="/profil/transaksisaya">Transaksi</a></li>
                  <li><a href="/profil/pesan">Kotak Masuk</a></li>
                </ul>
                <p class="menu-label has-text-link is-4 is-size-7 has-text-weight-bold is-uppercase">
                  Administrasi
                </p>
                <ul class="menu-list listitem">
                  <li><a href="/profil/editprofil">Edit Akun</a></li>
                  <li><a href="/profil/gantipassword">Ganti Password</a></li>
                  <li><a href="/profil/hapusakun">Hapus Akun</a></li>
                </ul>
                <p class="menu-label has-text-link is-4 is-size-7 has-text-weight-bold is-uppercase">
                  Poperti Saya
                </p>
                <ul class="menu-list listitem">
                  <li><a href="/profil/rumahsaya">Rumah</a></li>
                  <li><a href="/profil/lahansaya">Lahan</a></li>
                  <li><a href="/profil/gedungsaya">Gedung</a></li>
                  <li><a href="/profil/apartemensaya">Apartemen</a></li>
                  <li><a href="/profil/gudangsaya">Gudang</a></li>
                </ul>
                <p class="menu-label has-text-link is-4 is-size-7 has-text-weight-bold is-uppercase">
                  Lainnya
                </p>
                <ul class="menu-list listitem">
                  <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
              </aside>
        </div>
          @if(Request::is('profil'))
            @include('profil.dashboard')
          @elseif(Request::is('profil/gantipassword'))
            @include('profil.gantipassword')
          @elseif(Request::is('profil/transaksisaya'))
            @include('profil.transaksisaya')
          @elseif(Request::is('profil/editprofil'))
            @include('profil.editprofil')
          @elseif(Request::is('profil/favoritsaya'))
            @include('profil.favoritsaya')
          @elseif(Request::is('profil/pesan/semua'))
            @include('profil.semuapesan')
          @elseif(Request::is('profil/pesan'))
            @include('profil.pesan')
          @elseif(Request::is('profil/terjual'))
            @include('profil.tandaiterjual')
          @elseif(Request::is('profil/pesan/*/tampil'))
            @include('profil.lihatpesan')
          @elseif(Request::is('profil/hapusakun'))
            @include('profil.hapusakun')
          @elseif(Request::is('profil/rumahsaya'))
            @include('profil.rumahsaya')
          @elseif(Request::is('profil/lahansaya'))
            @include('profil.lahansaya')
          @elseif(Request::is('profil/apartemensaya'))
            @include('profil.apartemensaya')
          @elseif(Request::is('profil/gedungsaya'))
            @include('profil.gedungsaya')
          @elseif(Request::is('profil/gudangsaya'))
            @include('profil.gudangsaya')
          @elseif(Request::is('profil/semuatransaksi'))
            @include('profil.transaksi')
          @elseif(Request::is('profil/transaksi/*/kontak'))
            @include('profil.kontaktransaksi')
          @elseif(Request::is('profil/transaksi/*/kontak/pemilik'))
            @include('profil.kontakpemiliktransaksi')
          @elseif(Request::is('profil/rumah/*/edit'))
            @include('profil.editrumah')
          @elseif(Request::is('profil/lahan/*/edit'))
            @include('profil.editlahan')
          @elseif(Request::is('profil/gedung/*/edit'))
            @include('profil.editgedung')
          @elseif(Request::is('profil/apartemen/*/edit'))
            @include('profil.editapartemen')
          @elseif(Request::is('profil/gudang/*/edit'))
            @include('profil.editgudang')  
          @else
            @include('profil.dashboard')
          
          @endif
        <div id="myModal" class="modal column is-half is-offset-one-quarter">
            <div class="modal-content">
                <div class="is-pulled-right">
                        <span class="close has-text-danger"><i class="far fa-times-circle"></i></span>
                </div>
                <p>Pilih Foto Profil</p>
                <form action="/profil/updateavatar" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="file has-name is-centered">
                            <label class="file-label">
                              <input class="file-input" type="file" name="avatar" id="file-input">
                              <span class="file-cta">
                                <span class="file-icon">
                                  <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                  Pilih file…
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
    {{-- Footer --}}
    @include('layouts.footer')

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