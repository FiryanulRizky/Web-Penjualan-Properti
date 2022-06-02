<div class="column displaybox profileback">
    @include('profil.navprofil')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/profil">Profil</a></li>
            <li class="is-active"><a href="/profil">Tandai Properti Terjual</a></li>
        </ul>
    </nav>
    <div class="column profileback tableshow">
        <div class="title is-5 has-text-success">Tandai Properti Terjual</div>
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Properti</th>
                        <th>Nama Properti</th>
                        <th>Lokasi Properti</th>
                        <th>Jenis Properti</th>
                        <th>Harga</th>
                        <th>Tandai Terjual</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID Properti</th>
                        <th>Nama Properti</th>
                        <th>Lokasi Properti</th>
                        <th>Jenis Properti</th>
                        <th>Harga</th>
                        <th>Tandai Terjual</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if(count($properties)) @foreach ($properties as $key=>$property)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$property->id}}</td>
                        <td>{{$property->name}}</td>
                        <td>{{$property->city}}</td>
                        <td>{{$property->type}}</td>
                        <td>{{number_format($property->amount,2)}}</td>
                        @if(strcmp($property->availability,"YES") == 0)
                            <td><a href="/profil/terjual/{{$property->id}}/tandaiterjual" class="button is-danger nounnounderlinebtn">Terjual</a></td>
                        @else
                            <td><a href="/profil/terjual/{{$property->id}}/tandaibelumterjual" class="button is-success nounnounderlinebtn">Belum Terjual</a></td>
                        @endif
                    </tr>
                    @endforeach @else
                    <tr>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td><a href="" class="button is-success disabled nounnounderlinebtn" disabled>Kontak</a></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $properties->links() }}
    </div>
</div>