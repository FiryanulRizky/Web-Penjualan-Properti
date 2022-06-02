<div class="column displaybox profileback">
        @include('profil.navprofil')
        <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
            <ul>
                <li><a href="/profil">Profil</a></li>
                <li class="is-active"><a href="/profil">Semua Transaksi</a></li>
            </ul>
        </nav>
        <div class="column profileback tableshow">
          <div class="title is-5 has-text-success">Semua Transaksi</div>
          <div style="overflow-x: auto;">
              <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Properti</th>
                      <th>Nama Properti</th>
                      <th>Lokasi Properti</th>
                      <th>Jenis Properti</th>
                      <th>Transaksi</th>
                      <th>Pembeli</th>
                      <th>Kontak</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>ID Properti</th>
                      <th>Nama Properti</th>
                      <th>Lokasi Properti</th>
                      <th>Jenis Properti</th>
                      <th>Transaksi</th>
                      <th>Pembeli</th>
                      <th>Kontak</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if(count($offers))
                        @foreach ($offers as $key=>$offer)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$offer->property_id}}</td>
                          <td>{{$offer->property->name}}</td>
                          <td>{{$offer->property->city}}</td>
                          <td>{{$offer->property->type}}</td>
                          <td>Rp. {{number_format($offer->offerAmount,2)}}</td>
                          <td>{{$offer->offeredUser}}</td>
                          <td><a href="/profil/transaksi/{{$offer->id}}/kontak" class="button is-success nounnounderlinebtn">Kontak</a></td>
                        </tr>
                      @endforeach
                    @else
                    <tr>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td class="has-text-danger">Tidak Ada Hasil</td>
                        <td><a href="" class="button is-success disabled nounnounderlinebtn" disabled>Contact</a></td>
                      </tr>
                    @endif
                  </tbody>
                </table>
          </div>
          {{ $offers->links() }}
        </div>
    </div>