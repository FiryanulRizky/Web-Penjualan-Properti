<div class="column displaybox">
    @include('admin.navprofile')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/admin">Admin</a></li>
            <li class="is-active"><a href="/profil">Semua User</a></li>
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
        <div class="containerx">
            <div class="subtitle has-text-black-bis">Semua User Teregistrasi</div>
            <a href="/admin/user/tambah" class="button is-dark nounnounderlinebtn is-pulled-right">Tambah USer</a>
          <div class="column tableshow style="overflow-x: auto">   
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id User</th>
                  <th>Nama User</th>
                  <th>Email User</th>
                  <th>Kelengkapan Profil</th>
                  <th>Status</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id User</th>
                  <th>Nama User</th>
                  <th>Email User</th>
                  <th>Kelengkapan Profil</th>
                  <th>Status</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($users as $key=>$user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->NIC==null || $user->description==null || $user->address==null || $user->city==null || $user->gender==null || $user->NIC==null || $user->birthday==null || $user->phoneNo==null)
                          <span class="has-text-danger">Belum Lengkap</span>
                        @else
                        <span class="has-text-success">Lengkap</span>
                        @endif
                    </td>
                    <td>
                      @if($user->email_verified_at==NULL)
                        <span class="has-text-danger"> Belum Terverifikasi </span>
                      @else
                        <span class="has-text-success"> Terverifikasi </span>
                      @endif
                    </td>
                  <td><a href="/admin/user/{{$user->id}}/tampil" class="button is-success nounnounderlinebtn" target="_blank"><i class="fas fa-external-link-square-alt"></i></a></td>
                  <td><a href="/admin/user/{{$user->id}}/kontak" class="button is-link nounnounderlinebtn" target="_blank"><i class="far fa-comment-alt"></i></a></td> 
                  <td><a href="/admin/user/{{$user->id}}/edit" class="button is-warning nounnounderlinebtn" target="_blank"><i class="fa fa-edit"></i></a></td> 
                  <td>
                    <form action="/admin/user/{{$user->id}}/hapus" method="post">
                      @csrf
                      <button class="button is-danger nounnounderlinebtn" type="submit" onclick="deleteMe();"><i class="far fa-trash-alt"></i></button>
                  </form>
                  </td> 
                  </tr>
                @endforeach
            </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
<br>
<br>
</div>
<script>
    function deleteMe() {
    event.preventDefault();
    var form = event.target.form;
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Data Anda tidak akan dapat dikembalikan!!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "hsl(141, 71%, 48%)",
        cancelButtonColor: "hsl(348, 100%, 61%)",
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            
            form.submit();

        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            Swal.fire(
                'Diabatalkan',
                'Akun User Anda Tetap Aktif :)',
                'info'
            )
        }
    });
}
</script>