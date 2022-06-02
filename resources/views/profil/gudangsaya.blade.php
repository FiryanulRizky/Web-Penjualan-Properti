<link rel="stylesheet" href="/css/bootstrap.css">
<div class="column displaybox">
    @include('profil.navprofil')
    <nav class="breadcrumb has-arrow-separator has-background-white" aria-label="breadcrumbs">
        <ul>
            <li><a href="/profil">Profil</a></li>
            <li class="is-active"><a href="/profil">Gudang Saya</a></li>
        </ul>
    </nav>
    <div class="containerx">
        <div class="grayme">
            <div class="row">
                    @if($warehouses->count() > 0) 
                    @foreach ($warehouses as $warehouse)
                        @include('profil.datagudang') 
                    @endforeach 
                    @else
                        @include('profil.datakosong')
                    @endif
                    
            </div>
            {{ $warehouses->links() }}
        </div>
    </div>
</div>
<script>
        function deleteMe() {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Data Anda tidak akan dapat dikembalikan !",
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