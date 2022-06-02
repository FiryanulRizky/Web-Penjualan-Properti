<div class="column displaybox">
    @include('admin.navprofile')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/admin">Admin</a></li>
            <li class="is-active"><a href="/profil">Semua Admin</a></li>
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
            <div class="subtitle has-text-black-bis">Semua Administrator</div>
            <a href="/admin/tambah" class="button is-dark nounnounderlinebtn is-pulled-right">Tambah Admin</a>
            <div class="column tableshow style=" overflow-x: auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Admin</th>
                            <th>Nama Admin</th>
                            <th>Email Admin</th>
                            <th>Super Admin</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Id Admin</th>
                            <th>Nama Admin</th>
                            <th>Email Admin</th>
                            <th>Super Admin</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($admins as $key=>$admin)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            @if ($admin->issuper == 1)
                            <td>{{('Yes')}}</td>
                            @else
                            <td>{{('No')}}</td>
                            @endif

                            <td><a href="/admin/{{$admin->id}}/edit" class="button is-warning nounnounderlinebtn"
                                    target="_blank"><i class="fa fa-edit"></i></a></td>
                            <td>
                                <form action="/admin/{{$admin->id}}/hapus" method="post">
                                    @csrf
                                    <button class="button is-danger nounnounderlinebtn" type="submit"
                                        onclick="deleteMe();"><i class="far fa-trash-alt"></i></button>
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
                    'Tindakan Dibatalkan',
                    'Akun Anda Aman :)',
                    'info'
                )
            }
        });
    }
</script>