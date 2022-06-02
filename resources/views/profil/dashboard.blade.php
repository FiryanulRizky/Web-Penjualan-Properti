<div class="column displaybox profileback">
        @include('profil.navprofil')
        <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
            <ul>
                <li><a href="/profil">Profil</a></li>
                <li class="is-active"><a href="/profil">Dashboard</a></li>
            </ul>
        </nav>
        @if($user->NIC==null || $user->description==null || $user->address==null || $user->city==null || $user->gender==null || $user->NIC==null || $user->birthday==null || $user->phoneNo==null)
        <div class="columns is-mobile is-centered content">
            <div class="column is-half">
                <div class="notification is-warning">
                    <button class="delete"></button> {{ __('Silahkan lengkapi Biodata Anda,')
                    }} <a href="/profil/editprofil">Klik Disini</a></div>

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
      @endif
        <div class="columns dashboxes profileback">
            <div class="column has-text-centered selecticon" onclick="location.href='/tambahproperti'">
              <span class="icon has-text-centered is-large">
                <i class="fas fa-home fa-4x"></i>
              </span>
              <h6 class="is-uppercase has-text-weight-bold">Jual Properti</h6>
            </div>
            <div class="column has-text-centered selecticon" onclick="location.href='/profil/favoritsaya'">
              <span class="icon has-text-centered is-large">
                <i class="fas fa-heart fa-4x"></i>
              </span>
              <h6 class="is-uppercase has-text-weight-bold">Favorit Anda</h6>
            </div>
            <div class="column has-text-centered selecticon" onclick="location.href='/profil/pesan'">
              <span class="icon has-text-centered is-large">
                <i class="fas fa-comments fa-4x"></i>
              </span>
              <h6 class="is-uppercase has-text-weight-bold">Pesan Masuk</h6>
            </div>
            <div class="column has-text-centered selecticon" onclick="location.href='/profil/editprofil'">
              <span class="icon has-text-centered is-large">
                <i class="fas fa-edit fa-4x"></i>
              </span>
              <h6 class="is-uppercase has-text-weight-bold">Edit Profil</h6>
            </div>
            <div class="column has-text-centered selecticon" onclick="location.href='/profil/terjual'">
              <span class="iicon has-text-centered is-large">
                <i class="far fa-check-circle fa-4x"></i>
              </span>
              <h6 class="is-uppercase has-text-weight-bold">Properti Terjual</h6>
            </div>
            <div class="column has-text-centered selecticon" onclick="location.href='/'">
              <span class="icon has-text-centered is-large">
                <i class="fas fa-search fa-4x"></i>
              </span>
              <h6 class="is-uppercase has-text-weight-bold">Cari</h6>
            </div>
        </div>
        <div class="column profileback tableshow">
          <div class="title is-5 has-text-success">Transaksi Terkini</div>
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
                <th>Id Pembeli</th>
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
                <th>Harga</th>
                <th>Id Pembeli</th>
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
                  <td><a href="" class="button is-success disabled nounnounderlinebtn" disabled>Kontak</a></td>
                </tr>
              @endif
            </tbody>
          </table>
          </div>
          <a href="/profil/semuatransaksi" class="button is-link nounnounderlinebtn is-pulled-right">Lihat Semua Penawaran</a>
        </div>
    </div>
