<div class="column displaybox">
    @include('admin.navprofile')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/admin">Admin</a></li>
            <li class="is-active"><a href="/profil">Lihat User</a></li>
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
            <div class="media">
                <figure class="image is-128x128">
                    <img class="is-rounded" src="/uploads/avatars/{{$user->avatar}}">
                </figure>
                <div class="media-content detailsuser">
                    <p class="is-6 is-marginless"> Nama : <span class="has-text-black-bis">{{$user->name}}</span> </p>
                    <p class="is-6 is-marginless"> Email : <span class="has-text-black-bis">{{$user->email}}</span> </p>
                    <p class="is-6 is-marginless"> Asal : <span class="has-text-black-bis">{{$user->city}}</span> </p>
                    <p class="is-6 is-marginless"> Umur : <span class="has-text-black-bis">{{Carbon\Carbon::parse($user->birthday)->age}} tahun</span>                        </p>
                    <hr>
                    <div class="is-pulled-right">
                        <p class="subtitle is-7 is-marginless">
                            @if($user->email_verified_at==NULL)
                            <span class="has-text-danger has-text-weight-bold">Belum Terverifikasi</span> @else
                            <span class="has-text-success has-text-weight-bold">User Terverifikasi</span> @endif
                        </p>
                        <p class="subtitle is-7 is-marginless">
                            @if($user->NIC==null || $user->description==null || $user->address==null || $user->city==null || $user->gender==null || $user->NIC==null
                            || $user->birthday==null || $user->phoneNo==null)
                            <span class="has-text-danger has-text-weight-bold">Profil Belum Lengkap</span> @else
                            <span class="has-text-link has-text-weight-bold">Profil Lengkap</span> @endif
                        </p>
                        <hr>
                        <p class="subtitle is-7 is-marginless"> NIC : <span class="has-text-black-bis">{{$user->NIC}}</span> </p>
                        <p class="subtitle is-7 is-marginless"> Jenis Kelamin : <span class="has-text-black-bis">{{$user->gender}}</span> </p>
                        <p class="subtitle is-7 is-marginless"> No. HP : <span class="has-text-black-bis">{{$user->phoneNo}}</span> </p>
                        <p class="subtitle is-7 is-marginless"> Alamat : <span class="has-text-black-bis">{{$user->address}}</span> </p>
                        <p class="subtitle is-7 is-marginless"> Deskripsi : <span class="has-text-black-bis">{{$user->description}}</span> </p>
                    </div>
                </div>
                <hr>
            </div>
            <hr>
            <div class="subtitle has-text-black-bis containerx">Properti {{$user->name}}</div>
            <div class="column tableshow containerx" style="overflow-x: auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($properties->count() > 0) @foreach ($properties as $key=>$property)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$property->name}}</td>
                            <td>{{$property->city}}</td>
                            <td>{{$property->type}}</td>
                            <td>{{number_format($property->amount,2)}}</td>
                            <td><a href="/{{strtolower($property->type)}}/{{$property->id}}" class="button is-success nounnounderlinebtn" target="_blank"><i class="fas fa-external-link-square-alt"></i></a></td> 
                            <td><a href="/admin/{{strtolower($property->type)}}/{{$property->id}}/edit" class="button is-warning nounnounderlinebtn" target="_blank"><i class="fa fa-edit"></i></a></td> 
                            <td>
                                <form action="/admin/{{strtolower($property->type)}}/{{$property->id}}/delete" method="post">
                                    @csrf
                                    <button class="button is-danger nounnounderlinebtn" type="submit" onclick="deleteMe();"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach @endif
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
                'Data Anda Aman :)',
                'info'
            )
        }
    });
}
</script>