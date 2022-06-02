<!DOCTYPE html>
<html lang="en">

@if(Auth::guard('admin')->check())
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$building->name}} - E-Commerce Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/flickity.css"> {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
        rel="stylesheet">

    <style>
        #map {
            height: 300px;
        }
    </style>

</head>

<body>
    @include('hasil.navhasil')

    <div class="viewsection">

        <div class="column profileback">
            <div class="containerx">
                <div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
                    @foreach (json_decode($building->images) as $image)
                    <div class="carousel-cell"><img src="/uploads/property/{{strtolower($building->type)}}/{{$image}}" /></div>
                    @endforeach

                </div>

                <div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                    @foreach (json_decode($building->images) as $image)
                    <div class="carousel-cell"><img src="/uploads/property/{{strtolower($building->type)}}/{{$image}}" /></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="containerx detailssection">
            <div class="columns is-flex-mobile">
                <div class="column is-two-thirds is-flex-mobile">
                    <div class="containerx">
                        <a href="/gedung/{{$building->id}}/favorit" class="button is-danger is-pulled-right"><span><i class="far fa-heart"></i></span></a>
                        <div class="is-pulled-left">
                            <div class="title">
                                {{$building->name}}
                            </div>
                            <div class="subtitle">
                                {{$building->city}}, {{$building->postalCode}}
                            </div>
                            <hr class="hrline">
                            <div class="subtitle has-text-weight-semibold">
                                Detail Properti
                            </div>
                            <div class="columns">
                                <div class="column detailscolumn">
                                    <p>Jenis Properti: <span class="has-text-weight-semibold">{{$building->type}}</span></p>
                                    <p>Jenis Penawaran : <span class="has-text-weight-semibold">{{$building->agreement}}</span></p>
                                    <p>Lift: <span class="has-text-weight-semibold">{{$building->lift}}</span></p>
                                    <p>Parkir Mobil: <span class="has-text-weight-semibold">{{$building->carPark}}</span></p>
                                    <p>Jumlah Lantai: <span class="has-text-weight-semibold">{{$building->noOfFloors}}</span></p>
                                    <p>Ukuran Lantai(meter persegi): <span class="has-text-weight-semibold">{{$building->floorSize}}</span></p>
                                </div>
                                <div class="column">
                                    <p>Dekat Sekolah: <span class="has-text-weight-semibold">{{$building->nearestSchool}}</span></p>
                                    <p>Dekat Halte Bus: <span class="has-text-weight-semibold">{{$building->nearestRailway}}</span></p>
                                    <p>Dekat Pusat Kota: <span class="has-text-weight-semibold">{{$building->nearestBusStop}}</span></p>
                                    <p>Ketersediaan: @if(strcmp($building->availability,"YES") == 0)
                                        <span class="has-text-weight-semibold has-text-success">
                                            {{$building->availability}}
                                        </span> @else
                                        <span class="has-text-weight-semibold has-text-danger">
                                                {{$building->availability}}
                                        </span> @endif
                                    </p>
                                </div>

                                {{-- Mobile/Tablet Section --}}
                                <div class="column is-hidden-desktop">
                                    <div class='is-flex is-horizontal-center'>
                                        <figure class="image is-128x128">
                                            <img class="is-rounded is-horizontal-center" src="/uploads/avatars/{{$building->user->avatar}}">
                                        </figure>
                                    </div>
                                    <div class="subtitle has-text-centered"><span>@</span>{{$building->user->name}}</div>
                                    <div class="has-text-centered">
                                        <button class="button is-success" onclick="showPnox()">Tampilkan Kontak Number</button>
                                        <p class="has-text-dark customerpno" id="pnox"><a href="tel:{{$building->contactNo}}" class="nounnounderlinelink">{{$building->contactNo}}</a></p>
                                        <hr>
                                        <p class="owneramount">Estimasi Harga: <span class="has-text-success has-text-weight-bold">{{number_format($building->amount,2)}}</span>                                            </p>
                                        <p class="bidamount">Penawaran Tertinggi Saat ini: <span class="has-text-danger has-text-weight-bold">   
                                                @if ($building->offer > 0)
                                                    {{number_format($building->offer->sortBy('offerAmount')->last()->offerAmount,2)}}
                                                @else
                                                    0.00
                                                @endif
                                            </span> </p>
                                        <div id="myBtnM"><button class="button is-link">Buat Kesepakatan</button></div>
                                        <br>
                                        @include('hasil.peringatan_transaksi')
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-hidden-touch">
                    <div class='is-flex is-horizontal-center'>
                        <figure class="image is-128x128">
                            <img class="is-rounded is-horizontal-center" src="/uploads/avatars/{{$building->user->avatar}}">
                        </figure>
                    </div>
                    <div class="subtitle has-text-centered"><span>@</span>{{$building->user->name}}</div>
                    <div class="has-text-centered">
                        <button class="button is-dark" onclick="location.href='#contactbox'">Email Pemilik</button>
                        <button class="button is-success" onclick="showPnox()">Hubungi Pemilik</button>
                        <p class="has-text-dark customerpno" id="pno"><a href="tel:{{$building->contactNo}}" class="nounnounderlinelink">{{$building->contactNo}}</a></p>
                        <hr>
                        <p class="owneramount">Estimasi Harga: <span class="has-text-success has-text-weight-bold">{{number_format($building->amount,2)}}</span>                            </p>
                        <p class="bidamount">Penawaran Tertinggi Saat ini: <span class="has-text-danger has-text-weight-bold">   
                                @if ($building->offer > 0)
                                    {{number_format($building->offer->sortBy('offerAmount')->last()->offerAmount,2)}}
                                @else
                                    0.00
                                @endif
                            </span> </p>
                            <div id="myBtn"><button class="button is-link">Buat Kesepakatan</button></div>
                            <br>
                            @include('hasil.peringatan_transaksi')
                        </div>
                    </div>
                </div>
                <hr>
            <div class="subtitle has-text-weight-semibold">
                Google Map
            </div> {{-- Google Map Here --}} {{--
            <div class=" is-flex-mobile"> --}}
                <div class="column maps is-flex-mobile">

                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <div id="map"></div>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    /* height: 678px; */
                                    width: 790px;
                                }

                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none!important;
                                    /* /* height: 678px; */
                                    width: 790px;
                                }
                            </style>
                        </div>
                        <br>

                    </div>
                </div>
                <a class="button is-info nounnounderlinebtn" href="http://www.google.com/maps/place/{{$building->latitude}},{{$building->longitude}}"
                    target="_blank">Set Lokasi</a> {{-- </div> --}}
            <hr>
            <div class="subtitle has-text-weight-semibold">Deskripsi Properti</div>
            <div class="column is-flex-mobile">
                <p class="content">
                    {!! $building->description !!}
                </p>
            </div>
            {{-- Contact Owner Email Box Start Here --}}
            <hr>
            <div class="subtitle has-text-weight-semibold" id="contactbox">Kontak Pemilik</div>
            <div class="column is-flex-mobile">
                <form action="/gedung/{{$building->id}}/kontakpemilik" method="post">
                    @csrf
                    <div class="field">
                            <div class="control">
                            <input class="input" type="hidden" name="owner" value="{{$building->user->id}}">
                            <input class="input" type="hidden" name="path" value="{{Request::path()}}">
                            
                            @if(Auth::check())
                                <input class="input" type="hidden" name="sender" value="{{auth()->user()->id}}">
                            @else
                                <input class="input" type="hidden" name="sender" value="0" hidden>
                            @endif
                            </div>
                        </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nama</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" placeholder="Masukkan Nama" name="name">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span> 
                                    {!! $errors->first('name', '<p class="help-block has-text-danger">:message</p>') !!}
                                </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="Email" name="email">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                      </span>
                                      {!! $errors->first('email', '<p class="help-block has-text-danger">:message</p>') !!}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">No. HP</label>
                        </div>
                        <div class="field-body">
                            <div class="field is-expanded">
                                <div class="field has-addons">
                                    <p class="control">
                                        <a class="button is-static">
                                          +62
                                        </a>
                                    </p>
                                    <p class="control is-expanded">
                                        <input class="input {{ $errors->has('pno') ? ' is-danger' : '' }}" type="tel" placeholder="Masukkan No. HP Anda" name="pno">
                                    </p>
                                </div>
                                {!! $errors->first('pno', '<p class="help-block has-text-danger">:message</p>') !!}
                                <p class="help has-text-link">Jangan Masukkan awalan 0</p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Subjek Pesan</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input {{ $errors->has('subject') ? ' is-danger' : '' }}" type="text" placeholder="contoh: Perlu Melihat Langsung Properti" name="subject">
                                    {!! $errors->first('subject', '<p class="help-block has-text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Pesan</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea {{ $errors->has('message') ? ' is-danger' : '' }}" placeholder="Jelaskan bagaimana cara kami membantu" name="message"></textarea>
                                    {!! $errors->first('message', '<p class="help-block has-text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label">
                            <!-- Left empty for spacing -->
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <button class="button is-primary" type="submit">
                                        Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <br>

            </div>
            {{-- Contact Owner Emaik --}}
            <div class="notification is-danger">
                <button class="delete"></button>
                <strong>Informasi Penting:</strong> Iklan ini telah diposting di E-Commerce Properti oleh pengiklan yang disebutkan di atas. 
                E-Commerce Properti tidak memiliki hubungan apa pun dengan pengiklan ini, kami juga tidak memeriksa pengiklan, 
                menjamin layanan mereka, bertanggung jawab atas keakuratan konten iklan, 
                atau bertanggung jawab atas layanan yang disediakan oleh pengiklan. 
                E-Commerce Properti tidak menyediakan layanan apa pun selain daftar iklan yang dipasang oleh pengiklan. 
                Anda akan menghubungi pengiklan (pemilik/agen) properti ini secara langsung. 
                Kami menyarankan Anda untuk berhati-hati saat melakukan pembayaran atau menandatangani perjanjian apa pun 
                dan waspada terhadap kemungkinan penipuan. Jika melakukan pembayaran, kami menyarankan Anda memiliki dua metode kontak permanen 
                & terverifikasi dari penerima pembayaran seperti nomor telepon rumah dan alamat rumah/bisnis mereka.
            </div>
            <a class="is-pulled-right link reportad" id="report"><span><i class="far fa-flag"></i></span><span class="has-text-balck"> Report Penawaran ini</span></a>
            <br>

        </div>

    </div>
    </div>
    {{-- Footer --}}
    @include('layouts.footer')
    @include('layouts.transaksigedung')
    @include('layouts.reportgedung')
     {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/flickity.pkgd.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweetalert::alert')
    <script>
        var map;
        var lat = {{$building->latitude}}
        var lng = {{$building->longitude}}
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat, lng: lng},
          zoom: 15
        });

        var marker = new google.maps.Marker({
          position: {lat: lat, lng: lng},
          map: map,
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKNG_uMsCgUvpLc_Adr2n9nwo6BWOImoM&libraries=places&callback=initMap"
        async defer></script>

    <script>
        function showPno() {
            var x = document.getElementById("pno");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function showPnox() {
            var x = document.getElementById("pnox");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
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

</body>

@else
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$building->property->name}} - E-Commerce Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/flickity.css"> {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
        rel="stylesheet">

    <style>
        #map {
            height: 300px;
        }
    </style>

</head>

<body>
    @include('hasil.navhasil')

    <div class="viewsection">

        <div class="column profileback">
            <div class="containerx">
                <div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
                    @foreach (json_decode($building->property->images) as $image)
                    <div class="carousel-cell"><img src="/uploads/property/{{strtolower($building->property->type)}}/{{$image}}" /></div>
                    @endforeach

                </div>

                <div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                    @foreach (json_decode($building->property->images) as $image)
                    <div class="carousel-cell"><img src="/uploads/property/{{strtolower($building->property->type)}}/{{$image}}" /></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="containerx detailssection">
            <div class="columns is-flex-mobile">
                <div class="column is-two-thirds is-flex-mobile">
                    <div class="containerx">
                        <a href="/gedung/{{$building->id}}/favorit" class="button is-danger is-pulled-right"><span><i class="far fa-heart"></i></span></a>
                        <div class="is-pulled-left">
                            <div class="title">
                                {{$building->property->name}}
                            </div>
                            <div class="subtitle">
                                {{$building->property->city}}, {{$building->property->postalCode}}
                            </div>
                            <hr class="hrline">
                            <div class="subtitle has-text-weight-semibold">
                                Detail Properti
                            </div>
                            <div class="columns">
                                <div class="column detailscolumn">
                                    <p>Jenis Properti: <span class="has-text-weight-semibold">{{$building->property->type}}</span></p>
                                    <p>Jenis Penawaran : <span class="has-text-weight-semibold">{{$building->agreement}}</span></p>
                                    <p>Lift: <span class="has-text-weight-semibold">{{$building->lift}}</span></p>
                                    <p>Parkir Mobil: <span class="has-text-weight-semibold">{{$building->carPark}}</span></p>
                                    <p>Jumlah Lantai: <span class="has-text-weight-semibold">{{$building->noOfFloors}}</span></p>
                                    <p>Ukuran Lantai(meter persegi): <span class="has-text-weight-semibold">{{$building->floorSize}}</span></p>
                                </div>
                                <div class="column">
                                    <p>Dekat Sekolah: <span class="has-text-weight-semibold">{{$building->nearestSchool}}</span></p>
                                    <p>Dekat Halte Bus: <span class="has-text-weight-semibold">{{$building->nearestRailway}}</span></p>
                                    <p>Dekat Pusat Kota: <span class="has-text-weight-semibold">{{$building->nearestBusStop}}</span></p>
                                    <p>Ketersediaan: @if(strcmp($building->property->availability,"YES") == 0)
                                        <span class="has-text-weight-semibold has-text-success">
                                            {{$building->property->availability}}
                                        </span> @else
                                        <span class="has-text-weight-semibold has-text-danger">
                                                {{$building->property->availability}}
                                        </span> @endif
                                    </p>
                                </div>

                                {{-- Mobile/Tablet Section --}}
                                <div class="column is-hidden-desktop">
                                    <div class='is-flex is-horizontal-center'>
                                        <figure class="image is-128x128">
                                            <img class="is-rounded is-horizontal-center" src="/uploads/avatars/{{$building->property->user->avatar}}">
                                        </figure>
                                    </div>
                                    <div class="subtitle has-text-centered"><span>@</span>{{$building->property->user->name}}</div>
                                    <div class="has-text-centered">
                                        <button class="button is-success" onclick="showPnox()">Tampilkan Kontak Number</button>
                                        <p class="has-text-dark customerpno" id="pnox"><a href="tel:{{$building->property->contactNo}}" class="nounnounderlinelink">{{$building->property->contactNo}}</a></p>
                                        <hr>
                                        <p class="owneramount">Estimasi Harga: <span class="has-text-success has-text-weight-bold">{{number_format($building->property->amount,2)}}</span>                                            </p>
                                        <p class="bidamount">Penawaran Tertinggi Saat ini: <span class="has-text-danger has-text-weight-bold">   
                                                @if ($building->offer > 0)
                                                    {{number_format($building->offer->sortBy('offerAmount')->last()->offerAmount,2)}}
                                                @else
                                                    0.00
                                                @endif
                                            </span> </p>
                                        <div id="myBtnM"><button class="button is-link">Buat Kesepakatan</button></div>
                                        <br>
                                        @include('hasil.peringatan_transaksi')
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-hidden-touch">
                    <div class='is-flex is-horizontal-center'>
                        <figure class="image is-128x128">
                            <img class="is-rounded is-horizontal-center" src="/uploads/avatars/{{$building->property->user->avatar}}">
                        </figure>
                    </div>
                    <div class="subtitle has-text-centered"><span>@</span>{{$building->property->user->name}}</div>
                    <div class="has-text-centered">
                        <button class="button is-dark" onclick="location.href='#contactbox'">Email Pemilik</button>
                        <button class="button is-success" onclick="showPnox()">Hubungi Pemilik</button>
                        <p class="has-text-dark customerpno" id="pno"><a href="tel:{{$building->property->contactNo}}" class="nounnounderlinelink">{{$building->property->contactNo}}</a></p>
                        <hr>
                        <p class="owneramount">Estimasi Harga: <span class="has-text-success has-text-weight-bold">{{number_format($building->property->amount,2)}}</span>                            </p>
                        <p class="bidamount">Penawaran Tertinggi Saat ini: <span class="has-text-danger has-text-weight-bold">   
                                @if ($building->offer > 0)
                                    {{number_format($building->offer->sortBy('offerAmount')->last()->offerAmount,2)}}
                                @else
                                    0.00
                                @endif
                            </span> </p>
                            <div id="myBtn"><button class="button is-link">Buat Kesepakatan</button></div>
                            <br>
                            @include('hasil.peringatan_transaksi')
                        </div>
                    </div>
                </div>
                <hr>
            <div class="subtitle has-text-weight-semibold">
                Google Map
            </div> {{-- Google Map Here --}} {{--
            <div class=" is-flex-mobile"> --}}
                <div class="column maps is-flex-mobile">

                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <div id="map"></div>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    /* height: 678px; */
                                    width: 790px;
                                }

                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none!important;
                                    /* /* height: 678px; */
                                    width: 790px;
                                }
                            </style>
                        </div>
                        <br>

                    </div>
                </div>
                <a class="button is-info nounnounderlinebtn" href="http://www.google.com/maps/place/{{$building->property->latitude}},{{$building->property->longitude}}"
                    target="_blank">Set Lokasi</a> {{-- </div> --}}
            <hr>
            <div class="subtitle has-text-weight-semibold">Deskripsi Properti</div>
            <div class="column is-flex-mobile">
                <p class="content">
                    {!! $building->property->description !!}
                </p>
            </div>
            {{-- Contact Owner Email Box Start Here --}}
            <hr>
            <div class="subtitle has-text-weight-semibold" id="contactbox">Kontak Pemilik</div>
            <div class="column is-flex-mobile">
                <form action="/gedung/{{$building->id}}/kontakpemilik" method="post">
                    @csrf
                    <div class="field">
                            <div class="control">
                            <input class="input" type="hidden" name="owner" value="{{$building->property->user->id}}">
                            <input class="input" type="hidden" name="path" value="{{Request::path()}}">
                            
                            @if(Auth::check())
                                <input class="input" type="hidden" name="sender" value="{{auth()->user()->id}}">
                            @else
                                <input class="input" type="hidden" name="sender" value="0" hidden>
                            @endif
                            </div>
                        </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nama</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" placeholder="Masukkan Nama" name="name">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span> 
                                    {!! $errors->first('name', '<p class="help-block has-text-danger">:message</p>') !!}
                                </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="Email" name="email">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                      </span>
                                      {!! $errors->first('email', '<p class="help-block has-text-danger">:message</p>') !!}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">No. HP</label>
                        </div>
                        <div class="field-body">
                            <div class="field is-expanded">
                                <div class="field has-addons">
                                    <p class="control">
                                        <a class="button is-static">
                                          +62
                                        </a>
                                    </p>
                                    <p class="control is-expanded">
                                        <input class="input {{ $errors->has('pno') ? ' is-danger' : '' }}" type="tel" placeholder="Masukkan No. HP Anda" name="pno">
                                    </p>
                                </div>
                                {!! $errors->first('pno', '<p class="help-block has-text-danger">:message</p>') !!}
                                <p class="help has-text-link">Jangan Masukkan awalan 0</p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Subjek Pesan</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input {{ $errors->has('subject') ? ' is-danger' : '' }}" type="text" placeholder="contoh: Perlu Melihat Langsung Properti" name="subject">
                                    {!! $errors->first('subject', '<p class="help-block has-text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Pesan</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea {{ $errors->has('message') ? ' is-danger' : '' }}" placeholder="Jelaskan bagaimana cara kami membantu" name="message"></textarea>
                                    {!! $errors->first('message', '<p class="help-block has-text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label">
                            <!-- Left empty for spacing -->
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <button class="button is-primary" type="submit">
                                        Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <br>

            </div>
            {{-- Contact Owner Emaik --}}
            <div class="notification is-danger">
                <button class="delete"></button>
                <strong>Informasi Penting:</strong> Iklan ini telah diposting di E-Commerce Properti oleh pengiklan yang disebutkan di atas. 
                E-Commerce Properti tidak memiliki hubungan apa pun dengan pengiklan ini, kami juga tidak memeriksa pengiklan, 
                menjamin layanan mereka, bertanggung jawab atas keakuratan konten iklan, 
                atau bertanggung jawab atas layanan yang disediakan oleh pengiklan. 
                E-Commerce Properti tidak menyediakan layanan apa pun selain daftar iklan yang dipasang oleh pengiklan. 
                Anda akan menghubungi pengiklan (pemilik/agen) properti ini secara langsung. 
                Kami menyarankan Anda untuk berhati-hati saat melakukan pembayaran atau menandatangani perjanjian apa pun 
                dan waspada terhadap kemungkinan penipuan. Jika melakukan pembayaran, kami menyarankan Anda memiliki dua metode kontak permanen 
                & terverifikasi dari penerima pembayaran seperti nomor telepon rumah dan alamat rumah/bisnis mereka.
            </div>
            <a class="is-pulled-right link reportad" id="report"><span><i class="far fa-flag"></i></span><span class="has-text-balck"> Report Penawaran ini</span></a>
            <br>

        </div>

    </div>
    </div>
    {{-- Footer --}}
    @include('layouts.footer')
    @include('layouts.transaksigedung')
    @include('layouts.reportgedung')
     {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/flickity.pkgd.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweetalert::alert')
    <script>
        var map;
        var lat = {{$building->property->latitude}}
        var lng = {{$building->property->longitude}}
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat, lng: lng},
          zoom: 15
        });

        var marker = new google.maps.Marker({
          position: {lat: lat, lng: lng},
          map: map,
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKNG_uMsCgUvpLc_Adr2n9nwo6BWOImoM&libraries=places&callback=initMap"
        async defer></script>

    <script>
        function showPno() {
            var x = document.getElementById("pno");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function showPnox() {
            var x = document.getElementById("pnox");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
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

</body>
@endif

</html>