<link rel="stylesheet" href="/css/bootstrap.css">
<div class="column displaybox">
    @include('profil.navprofil')
    <nav class="breadcrumb has-arrow-separator has-background-white" aria-label="breadcrumbs">
        <ul>
            <li><a href="/profil">Profil</a></li>
            <li class="is-active"><a href="/profil">Favorit Saya</a></li>
        </ul>
    </nav>
    <div class="containerx">
        <div class="grayme">
            <div class="row">
                    @if($favorites->count() > 0)
                    @foreach ($favorites as $favorite)
                        @include('profil.datafavorit') 
                    @endforeach 
                    @else
                        @include('profil.datakosong')
                    @endif
            </div>
            {{ $favorites->links() }}
        </div>
        
    </div>
</div>
<script>
    function deleteMe() {
    event.preventDefault();
    var form = event.target.form;
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Anda tidak bisa membatalkan!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "hsl(141, 71%, 48%)",
        cancelButtonColor: "hsl(348, 100%, 61%)",
        confirmButtonText: 'Ya, Lakukan Penghapusan!',
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
                'Daftar favoritmu diamankan :)',
                'info'
            )
        }
    });
}
</script>