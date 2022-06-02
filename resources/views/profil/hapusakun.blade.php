<div class="column displaybox">
    @include('profil.navprofil')
    <nav class="breadcrumb has-arrow-separator has-background-white" aria-label="breadcrumbs">
        <ul>
            <li><a href="/profil">Profil</a></li>
            <li class="is-active"><a href="/profil">Hapus Akun</a></li>
        </ul>
    </nav>
    <div class="card cardmargin">
        <div class="containerx">
            <h1 class="title has-text-centered">Hapus Akun</h1>
            <div class="centerinputbox has-text-centered">
                <div class="subtitle">Anda ingin menghapus akun, akun Anda tidak bisa dipulihkan kembali. Silahkan lanjutkan dengan resiko Anda.</div>
                <div class="subtitle is-6 has-text-link has-text-weight-bold">Penting: Semua Properti Anda akan terhapus.</div>
                <form action="/profil/user/{{auth()->user()->id}}/hapus" method="post">
                    @csrf
                    <button class="button is-danger" type="submit" onclick="deleteMe();">Hapus Akun</button>
                </form>
            </div>
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
        footer: "Perhatian: Semua Properti Anda Akan Dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "hsl(141, 71%, 48%)",
        cancelButtonColor: "hsl(348, 100%, 61%)",
        confirmButtonText: 'Yes, delete it!',
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
                'Your account is safe :)',
                'info'
            )
        }
    });
}
</script>