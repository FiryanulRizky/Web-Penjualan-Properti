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
    <link rel="stylesheet" href="/css/bootstrap.css"> {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
        rel="stylesheet">

</head>

<body>
    @include('hasil.navhasil')

    <div class="container">
        {{-- Search Box --}}
        <form method="POST" action="/gedung/cari/">
            @csrf
              <div class="field has-addons searchagain">
                  <p class="control has-icons-left is-expanded">
                    <input class="input is-medium inputsearchbox" type="text" placeholder="Cari berdasarkan Kota, Kode Pos" id="search" name="searchquery">
                    <span class="icon is-small is-left">
                      <i class="fas fa-search"></i>
                    </span>
                  </p>
                  <div class="control">
                      <button class="button inputsearchbox is-primary is-medium"><span class="subtitle is-6 has-text-white">Cari</span></button>
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
                  <div class="control has-icons-left">
                        <div class="select selectbox is-small">
                          <select name="nooffloors">
                                    <option value="0">Jumlah Lantai</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">More</option>
                                    </select>
                        </div>
                        <span class="icon is-small is-left">
                                  <i class="fas fa-walking"></i>
                                </span>
                      </div>
                      <label class="checkbox checktext has-text-primary">
                              <input type="checkbox" name="lift">
                                  Lift
                              </label>
                      <label class="checkbox checktext has-text-primary">
                              <input type="checkbox" name="carpark">
                                  Parkir Mobil
                              </label>
                    </div>
                    <br>
                  </div>
                </form>
    </div>

    {{--
    <div class="columns">
        <div class="column is-3">

        </div>
        <div class="column is-6 is-centered">
    @include('hasil.thread')
    @include('hasil.thread')
    @include('hasil.thread')
    @include('hasil.thread')
    @include('hasil.thread')
        </div>
        <div class="column is-3">

        </div>
    </div> --}}

    <div class="grayme">
        <div class="row printarea">
            @if($buildings->count() > 0)
            @foreach ($buildings as $building)
                @include('hasil.datagedung') 
            @endforeach
            @else
                @include('hasil.datakosong')
            @endif
        </div>
    </div>
    {{-- Footer --}}
    @include('layouts.footer') {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
    <script src="/js/bootstrap.js"></script>

</body>

</html>