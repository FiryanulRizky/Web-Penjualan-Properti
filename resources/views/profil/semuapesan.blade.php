<div class="column displaybox">
    @include('profil.navprofil')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/profil">Profil</a></li>
            <li class="is-active"><a href="/profil/pesan">Pesan</a></li>
        </ul>
    </nav>
    <div class="containerx">
        <div class="column">
                <div class="div" style="margin-bottom: 6%;">
                    <a href="/profil/pesan" class="button is-link nounnounderlinebtn is-pulled-right">Pesan Belum Terbaca</a>
                </div>
                @if($messages->count() > 0) 
                @foreach ($messages as $message)
                    @include('profil.layoutpesan') 
                @endforeach 
                @else
                    @include('profil.datakosong')
                @endif
            </div>
            {{ $messages->links() }}
    </div>
</div>