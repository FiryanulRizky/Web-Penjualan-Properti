<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/bootstrap.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600" rel="stylesheet">
</head>
<body>

    <div class="column is-full is-mobile backgroundimg">
        <div class="container">
            <div class="column is-mobile is-centered">
                @include('layouts.navgudang');
            </div>
        </div>
        <div class="container">
            <div class="columns is-mobile is-centered">
               <div class="column is-8 searchbox">
                   <h1 class="subtitle is-4 has-text-white searchboxtitletext">Cari Properti</h1>
                   <div class="tabs">
                    <ul>
                      <li class="deadtabitem">
                        <a href="/rumah">
                          <span class="has-text-white">Rumah</span>
                        </a>
                      </li>
                      <li  class="deadtabitem">
                        <a href="/lahan">
                          <span class="has-text-white">Lahan</span>
                        </a>
                      </li>
                      <li class="deadtabitem">
                        <a href="/apartemen">
                          <span class="has-text-white">Apartemen</span>
                        </a>
                      </li>
                      <li class="deadtabitem">
                        <a href="/gedung">
                          <span class="has-text-white">Gedung</span>
                        </a>
                      </li>
                      <li class="is-active has-background-primary tabitem">
                        <a href="/gudang">
                          <span class="has-text-white">Gudang</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  
                  {{-- Search Box --}}
                <form method="POST" action="/gudang/cari">
                  @csrf
                    <div class="field has-addons searchinput">
                        <p class="control has-icons-left is-expanded">
                          <input class="input is-large inputsearchbox" type="text" placeholder="Cari berdasarkan Kota,Kode Pos,dll." id="search" name="searchquery">
                          <span class="icon is-small is-left">
                            <i class="fas fa-search"></i>
                          </span>
                        </p>
                        <div class="control">
                            <button class="button inputsearchbox is-primary is-large"><p class="subtitle is-6 has-text-white">Cari</p></button>
                        </div>
                    </div>
                    <div class="is-hidden-touch">
                    <div class="field has-addons">
                        <div class="control has-icons-left">
                            <div class="select selectbox is-small">
                                <select name="minprice">
                                    <option value="0">Harga(Min)</option>
                                    <option value="1000000">1 Juta</option>
                                    <option value="2000000">2 Juta</option>
                                    <option value="3000000">3 Juta</option>
                                    <option value="4000000">4 Juta</option>
                                    <option value="5000000">5 Juta</option>
                                    <option value="6000000">6 Juta</option>
                                    <option value="7000000">7 Juta</option>
                                    <option value="8000000">8 Juta</option>
                                    <option value="9000000">9 Juta</option>
                                    <option value="10000000">10 Juta</option>
                                    <option value="50000000">50 Juta</option>
                                    <option value="100000000">100 Juta</option>
                                    <option value="200000000">200 Juta</option>
                                    <option value="1000000000">1 Miliar</option>
                                    <option value="50000000000">50 Miliar</option>
                                    <option value="100000000000">100 Miliar</option>
                                    </select>
                            </div>
                            <span class="icon is-small is-left">
                              <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                        <div class="control has-icons-left">
                          <div class="select selectbox is-small">
                              <select name="maxprice">
                                  <option value="9999999999999999999999999999999">Harga(Maks)</option>
                                  <option value="1000000">1 Juta</option>
                                  <option value="2000000">2 Juta</option>
                                  <option value="3000000">3 Juta</option>
                                  <option value="4000000">4 Juta</option>
                                  <option value="5000000">5 Juta</option>
                                  <option value="6000000">6 Juta</option>
                                  <option value="7000000">7 Juta</option>
                                  <option value="8000000">8 Juta</option>
                                  <option value="9000000">9 Juta</option>
                                  <option value="10000000">10 Juta</option>
                                  <option value="50000000">50 Juta</option>
                                  <option value="100000000">100 Juta</option>
                                  <option value="200000000">200 Juta</option>
                                  <option value="1000000000">1 Miliar</option>
                                  <option value="50000000000">50 Miliar</option>
                                  <option value="100000000000">100 Miliar</option>
                                </select>
                          </div>
                          <span class="icon is-small is-left">
                            <i class="fas fa-dollar-sign"></i>
                          </span>
                        </div>
                        <label class="checkbox checktext has-text-white">
                            <input type="checkbox" name="electricity">
                            Listrik 3 Phase
                        </label>
                        <label class="checkbox checktext has-text-white">
                            <input type="checkbox" name="parkingarea">
                            Area Parkir
                        </label>
                    </div>
                    <br>
                    </div>
                </form>
               </div>
               <div class="column is-2 adbox">
                 <p class="has-text-white is-5">
                  Butuh Bantuan?
                 </p>
                 <br>
                 <p class="has-text-white">
                  Jika Anda belum mengetahui tentang cara kerja platform ini, Anda cukup mengunjungi blog kami untuk mendapatkan informasi tentang cara kerjanya.
                 </p>
                 <br>
                 <p class="control">
                    <a class="button is-primary is-inverted is-outlined loginbutton" href="/blog">
                      <span>Baca</span>
                    </a>
                  </p>
               </div>
            </div>
            <div class="has-text-centered indexicon">
                <span class="icon has-text-white is-large">
                  <i class="fas fa-home fa-5x"></i>
                </span>
                <h1 class="has-text-white">JOIN SEKARANG!</h1>
                <h4 class="has-text-white">Temukan Rumah Impian Anda</h4>
            </div>
        </div>
    </div>

    {{-- Deatils Section  --}}
    <div class="columns is-mobile is-centered details">
      <div class="column"></div>
      <div class="column has-text-centered">
        <span class="is-centered has-text-primary">
          <i class="fas fa-home fa-5x"></i>
        </span>
        <br>
        <div class="subtitle has-text-dark marginten">
          Apa yang Anda Cari?
        </div>
        Algoritme pencarian cepat kami memilih yang terbaik untuk Anda
          <div class="marginten">
            <a href="/" class="has-text-info">Cari Sekarang</a>
          </div>
      </div>
      <div class="column has-text-centered">
        <span class="is-centered has-text-primary">
            <i class="far fa-thumbs-up fa-5x"></i>
        </span>
        <br>
        <div class="subtitle has-text-dark marginten">
          Tips Rumah Idaman!
        </div>
        Berlangganan blog kami untuk mendapatkan tips rumah idaman
          <div class="marginten">
            <a href="/blog" class="has-text-info marginten">Kunjungi Blog</a>
          </div>
      </div>
      <div class="column has-text-centered">
        <span class="is-centered has-text-primary">
            <i class="fas fa-hand-holding-usd fa-5x"></i>
        </span>
        <br>
        <div class="subtitle has-text-dark marginten">
          Jual Propertimu?
        </div>
        Daftar sekarang, jual rumah, tanah atau apartemen Anda dengan mudah dan gratis
        <div class="marginten">
            <a href="register" class="has-text-info marginten">Register Sekarang</a>
        </div>
      </div>
      <div class="column"></div>
    </div>


    {{-- List Lahan Section  --}}
    <div class="column is-full is-mobile backgroundimg">
      <div class="container">
        <div class="column displaybox">
          <div class="containerx">
            <div class="grayme">
                <div class="row">
                  @foreach ($gudangs as $gudang)
                  <div class="col-sm-4 col-sm-3 center-responsive">
                    <div class="column is-gaps is-12">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="/uploads/property/{{ strtolower($gudang->property->type) }}/{{json_decode($gudang->property->images)[0]}}" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                    </div>
                                    <div class="media-content">
                                        <p class="is-6">
                                            <span class="has-text-dark">Nama :</span> {{$gudang->property->name}} <br>
                                            <span class="has-text-dark">Jenis :</span> {{$gudang->property->type}} <br>
                                            <span class="has-text-dark">Lokasi :</span> {{$gudang->property->city}} <br>
                                            <span class="has-text-dark">Harga :</span> Rp. {{number_format($gudang->property->amount,2)}}</p>
                                    </div>
                                </div>
                                <div class="content">
                                    <small class media-left>{{$gudang->property->created_at->diffForHumans()}}</small>
                                    <div class="buttons is-pulled-right">
                                        <button class="button is-success is-pulled-right" onclick="window.open('/gudang/{{$gudang->id}}','_blank');">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- Photo Frame Section --}}
    <div class="columns">
      <div class="column image is-2by1 childrenimg">
        
      </div>
      <div class="column colorred">
        <h1 class="title is-1 has-text-white has-text-centered maketheir">Buat mereka</h1>
        <h2 class="title is-2 has-text-white has-text-centered futurebetter">Bermasa Depan Cerah!</h2>
        <p class="control has-text-centered">
          <a class="button is-primary is-inverted has-text-centered is-outlined signbuttonbelow" href="register">
              <span>Join Sekarang</span>
            </a>
          </p>
      </div>
    </div>

    {{-- Article Section --}}
    <div class="column">
        <h3 class="title is-3 has-text-grey-darker has-text-centered">Artikel Blog Terbaru</h3>
      <div class="container">
          @foreach ($articles as $article)
            @include('layouts.artikel')
          @endforeach
      </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')


      {{-- JavaScript Files --}}
      <script src="/js/jquery-3.3.1.min.js"></script>
      <script src="/js/fontawesome.js"></script>
</body>
</html>