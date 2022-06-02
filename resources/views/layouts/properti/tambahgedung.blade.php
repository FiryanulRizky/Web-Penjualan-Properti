<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Properti - E-Commerce Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/bootstrap.css"> {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
        rel="stylesheet">
    <style>
        #map {
            height: 300px;
        }
    </style>
</head>

<body>
    @include('hasil.navhasil')
    <br>
    <div class="title has-text-centered">Tambah Gedung</div>
    <br>
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-8">
                {{-- @include('layouts.errors') --}}
                @if(session()->has('message'))
                <div class="notification is-success">
                    <button class="delete"></button>
                    <h1 class="is-size-5"><b> {{ session()->get('message') }}</b></h1>
                </div>
                @endif
            </div>
        </div>

        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <div class="control">
                            <label for="name">Nama Properti</label>
                            <input class="input is-primary {{ $errors->has('name') ? ' is-danger' : '' }}" type="text"
                                name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('name') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Jenis Properti</label>
                            <br>
                            <div class="select is-primary is-full {{ $errors->has('type') ? ' is-danger' : '' }}">
                                <select name="type">
                                    <option value="Gedung">Gedung</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Harga Properti <strong>((Rupiah) Rp.)</strong></label>
                            <input class="input is-primary {{ $errors->has('amount') ? ' is-danger' : '' }}" type="text"
                                name="amount" value="{{ old('amount') }}">
                            @if ($errors->has('amount'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('amount') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Kota</label>
                            <br>
                            <div class="select is-primary is-full {{ $errors->has('city') ? ' is-danger' : '' }}">
                                <select name="city">
                                    <option>Denpasar Selatan</option>
                                    <option>Denpasar Timur</option>
                                    <option>Denpasar Barat</option>
                                    <option>Denpasar Selatan</option>
                                    <option>Nusa Dua</option>
                                    <option>Padang Galak</option>
                                    <option>Guwang</option>
                                    <option>Sanur</option>
                                    <option>Kuta Utara</option>
                                    <option>Kuta Selatan</option>
                                    <option>Jimbaran</option>
                                    <option>Ubud</option>
                                    <option>Gianyar</option>
                                    <option>Tegalalang</option>
                                    <option>Sukawati</option>
                                    <option>Celuk</option>
                                    <option>Payangan</option>
                                    <option>Singakerta</option>
                                    <option>Mas-Ubud</option>
                                    <option>Singapadu</option>
                                    <option>Batur</option>
                                    <option>Besakih</option>
                                    <option>Rendang</option>
                                    <option>Melaya</option>
                                    <option>Pekutatan</option>
                                    <option>Abiansemal</option>
                                    <option>Nusa Penida</option>
                                    <option>Susut</option>
                                    <option>Abang</option>
                                    <option>Rendang</option>
                                    <option>Gerokgak</option>
                                    <option>Sukasada</option>
                                    <option>Tejakula</option>
                                    <option>Mendoyo</option>
                                    <option>Kerambitan</option>
                                    <option>Baturiti</option>
                                    <option>Mengwi</option>
                                    <option>Dawan</option>
                                    <option>Kubu</option>
                                    <option>Kubutambahan</option>
                                    <option>Tembuku</option>
                                    <option>Busungbiu</option>
                                    <option>Manggis</option>
                                    <option>Selat</option>
                                    <option>Kediri</option>
                                    <option>Pupuan</option>
                                    <option>Marga</option>
                                    <option>Tampaksiring</option>
                                    <option>Selemadeg Barat</option>
                                    <option>Selemadeg Timur</option>
                                    <option>Negara</option>
                                    <option>Banjarangkan</option>
                                    <option>Sidemen</option>
                                    <option>Bebandem</option>
                                    <option>Petang</option>
                                    <option>Mangupura</option>
                                    <option>Semarapura</option>
                                    <option>Sindu</option>
                                    <option>Trunyan</option>
                                    <option>Gilimanuk</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Kode Pos</label>
                            <input class="input is-primary {{ $errors->has('postalcode') ? ' is-danger' : '' }}" type="text"
                                name="postalcode" value="{{ old('postalcode') }}">
                            @if ($errors->has('postalcode'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('postalcode') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Kabupaten</label>
                            <br>
                            <div class="select is-primary is-full {{ $errors->has('province') ? ' is-danger' : '' }}">
                                <select name="province">
                                    <option value="Denpasar">Denpasar</option>
                                    <option value="Badung">Badung</option>
                                    <option value="Tabanan">Tabanan</option>
                                    <option value="Gianyar">Gianyar</option>
                                    <option value="Jembrana">Jembrana</option>
                                    <option value="Buleleng">Buleleng</option>
                                    <option value="Bangli">Bangli</option>
                                    <option value="Klungkung">Klungkung</option>
                                    <option value="Karangasem">Karangasem</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <label for="name">Deskripsi Properti</label>
                            <textarea name="description"
                                class="textarea is-primary {{ $errors->has('description') ? ' is-danger' : '' }}"
                                value="{{ old('description') }}"></textarea>
                            @if ($errors->has('description'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('description') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">No. HP</label>
                            <input class="input is-primary {{ $errors->has('contactno') ? ' is-danger' : '' }}" type="text"
                                name="contactno" value="{{ old('contactno') }}">
                            @if ($errors->has('contactno'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('contactno') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Email</label>
                            <input class="input is-primary {{ $errors->has('contactemail') ? ' is-danger' : '' }}" type="text"
                                name="contactemail" value="{{Auth::user()->email}}">
                            @if ($errors->has('contactemail'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('contactemail') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    {{-- Image Upload Section --}}
                    <div class="field">
                        <div class="control">
                            <label for="img">Foto <strong class="is-small">(Tips: Upload Lebih dari satu Foto [Maks
                                Ukuran: 4MB])</strong></label>
                            <div class="input-group control-group increment">
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="button is-success addmore" type="button"><i
                                            class="glyphicon glyphicon-plus"></i>Lebih Banyak</button>
                                </div>
                            </div>

                            <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="button is-danger" type="button"><i
                                                class="glyphicon glyphicon-remove"></i> Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('filename'))
                        <span>
                            <strong class="has-text-danger">{{ $errors->first('filename') }}</strong>
                        </span> @endif
                    </div>
                    <div class="field">
                        <div class="control maphere">
                            <label for="name">Set Lokasi: Google Maps</label>
                            <input class="input is-primary" type="text" id="searchmap">
                            <div id="map" class="column"></div>
                            
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Latitude</label>
                            <input class="input is-primary {{ $errors->has('lat') ? ' is-danger' : '' }}" type="text"
                                name="lat" id="lat" value="{{ old('lat') }}">
                            @if ($errors->has('lat'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('lat') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Longitude</label>
                            <input class="input is-primary {{ $errors->has('lng') ? ' is-danger' : '' }}" type="text"
                                name="lng" id="lng" value="{{ old('lng') }}">
                            @if ($errors->has('lng'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('lng') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                {{-- next column start here --}}
                <div class="column">
                    <div class="field">
                        <div class="control">
                            <label for="name">Jenis Penawaran</label>
                            <br>
                            <div class="select is-primary">
                                <select name="agreement">
                                    <option value="Dijual">Dijual</option>
                                    <option value="Disewa" selected>Disewa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Jumlah Lantai</label>
                            <input class="input is-primary {{ $errors->has('floor') ? ' is-danger' : '' }}" type="number"
                                name="floor" value="{{ old('floor') }}">
                            @if ($errors->has('floor'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('floor') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Ukuran Lantai(meter persegi)</label>
                            <input class="input is-primary {{ $errors->has('floorsize') ? ' is-danger' : '' }}" type="number"
                                name="floorsize" value="{{ old('floorsize') }}">
                            @if ($errors->has('floorsize'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('floorsize') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Lift</label>
                            <br>
                            <div class="select is-primary {{ $errors->has('lift') ? ' is-danger' : '' }}">
                                <select name="lift">
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak Tersedia" selected>Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Parkir Mobil</label>
                            <br>
                            <div class="select is-primary {{ $errors->has('carpark') ? ' is-danger' : '' }}">
                                <select name="carpark">
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak Tersedia" selected>Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Dekat Sekolah</label>
                            <input class="input is-primary {{ $errors->has('nschool') ? ' is-danger' : '' }}" type="text"
                                name="nschool" value="{{ old('nschool') }}">
                            @if ($errors->has('nschool'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('nschool') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Dekat Pusat Kota</label>
                            <input class="input is-primary {{ $errors->has('nrailway') ? ' is-danger' : '' }}" type="text" name="nrailway" value="{{ old('nrailway') }}">
                            @if ($errors->has('nrailway'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('nrailway') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label for="name">Dekat Halte Bus</label>
                            <input class="input is-primary {{ $errors->has('nbus') ? ' is-danger' : '' }}" type="text"
                                name="nbus" value="{{ old('nbus') }}">
                            @if ($errors->has('nbus'))
                            <span>
                                <strong class="has-text-danger">{{ $errors->first('nbus') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="field">
                        <div class="control is-pulled-right">
                            <button type="submit" class="button is-primary">
                                Tambah Gedung
                            </button>
                            <button type="reset" class="button is-warning">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <br>
    <br>
    </div>
    {{-- Footer --}}
    @include('layouts.footer') {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>s
    <script>
        tinymce.init({ selector:'textarea' });
    </script>
    <script>
        var map;
            function initAutocomplete() {
                map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.9814435, lng: 81.0741583},
                zoom: 15
                });

                var marker = new google.maps.Marker({
                position: {lat: 6.9814435, lng: 81.0741583},
                map: map,
                draggable: true,
                });

                var input = document.getElementById('searchmap');
                var searchBox = new google.maps.places.SearchBox(input);
                //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                google.maps.event.addListener(searchBox,'places_changed',function(){
                    var places = searchBox.getPlaces();
                    var bounds = new google.maps.LatLngBounds();
                    var i, place;
                    for (i = 0; place=places[i]; i++) {
                        bounds.extend(place.geometry.location);
                        marker.setPosition(place.geometry.location);
                        
                    }

                    map.fitBounds(bounds);
                    map.setZoom(15);
                });

                google.maps.event.addListener(marker,'position_changed',function(){
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();

                    $('#lat').val(lat);
                    $('#lng').val(lng);
                });
            }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKNG_uMsCgUvpLc_Adr2n9nwo6BWOImoM&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript">
        $(document).ready(function() {
    
          $(".addmore").click(function(){ 
              var html = $(".clone").html();
              $(".increment").after(html);
          });
    
          $("body").on("click",".is-danger",function(){ 
              $(this).parents(".control-group").remove();
          });
    
        });
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

</html>