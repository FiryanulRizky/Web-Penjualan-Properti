<div class="column displaybox">
        @include('profil.navprofil')
        <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
            <ul>
                <li><a href="/profil">Profil</a></li>
                <li class="is-active"><a href="/profil">Edit Lahan</a></li>
            </ul>
        </nav>
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
        @include('layouts.errors') @if(session()->has('message'))
                <div class="notification is-success">
                    <button class="delete"></button>
                    <h1 class="is-size-7"><b> {{ session()->get('message') }}</b></h1>
                </div>
                @endif
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
        <div class="card cardmargin">
            <div class="containerx">
                <style>
                    #map {
                        height: 300px;
                    }
                </style>
                <h1 class="title has-text-centered">Edit Lahan</h1>
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <div class="control">
                                    <label for="name">Nama Properti</label>
                                <input class="input is-primary" type="text" name="name" value="{{$land->property->name}}">
                                <input name="propertyid" value="{{$land->property->id}}" hidden>
                                <input name="landid" value="{{$land->id}}" hidden>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Jenis Properti</label>
                                    <br>
                                    <div class="select is-primary is-full">
                                        <select name="type">
                                        <option value="Lahan">Lahan</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Harga Properti <strong>((Rupiah) Rp.)</strong></label>
                                    <input class="input is-primary" type="text" name="amount" value="{{$land->property->amount}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Kota</label>
                                    <br>
                                    <div class="select is-primary is-full">
                                        <select name="city">
                                        <option selected>{{$land->property->city}}</option>
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
                                    <input class="input is-primary" type="text" name="postalcode" value="{{$land->property->postalCode}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Kabupaten</label>
                                    <br>
                                    <div class="select is-primary is-full">
                                        <select name="province">
                                            <option value="{{$land->property->province}}" selected>{{$land->property->province}}</option>
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
                                    <textarea name="description" class="textarea is-primary"> {{$land->property->description}}</textarea>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">No. HP</label>
                                    <input class="input is-primary" type="text" name="contactno" value="{{$land->property->contactNo}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Email</label>
                                    <input class="input is-primary" type="text" name="contactemail" value="{{$land->property->contatctEmail}}">
                                </div>
                            </div>
                            {{-- Image Upload Section --}}
                            <div class="field">
                                <div class="control">
                                    <label for="img">Foto <strong class="is-small">(Tips: Upload Lebih dari satu Foto [Maks
                                        Ukuran: 4MB])</strong></label>
                                    <div class="contetnt">
                                        <div class="row columns">
                                                @foreach (json_decode($land->property->images) as $image)
                                                <div class="column"><img src="/uploads/property/{{ strtolower($land->property->type) }}/{{$image}}" /></div>
                                                @endforeach
                                        </div>
                                    </div>
                                    <br>
                                    <div class="input-group control-group increment">
                                        <input type="file" name="filename[]" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="button is-success addmore" type="button"><i class="glyphicon glyphicon-plus"></i>Lebih Banyak</button>
                                        </div>
                                    </div>
    
                                    <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="filename[]" class="form-control">
                                            <div class="input-group-btn">
                                                <button class="button is-danger removepic" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <input class="input is-primary" type="text" name="lat" id="lat" value="{{$land->property->latitude}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Longitude</label>
                                    <input class="input is-primary" type="text" name="lng" id="lng" value="{{$land->property->longitude}}">
                                </div>
                            </div>
                        </div>
                        {{-- next column start here --}}
                        <div class="column">
                                <div class="field">
                                    <div class="control">
                                        <label for="electricity">Kelistrikan</label>
                                        <br>
                                        <div class="select is-primary">
                                            <select name="electricity">
                                                <option selected>{{$land->electricity}}</option>
                                                <option>Tidak Tersedia</option>
                                                <option>2 Phase</option>
                                                <option>3 Phase</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label for="name">Ukuran(Perch)</label>
                                        <input class="input is-primary" type="number" name="size" value="{{$land->size}}">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label for="name">Keran Air</label>
                                        <br>
                                        <div class="select is-primary">
                                            <select name="tapwater">
                                                <option selected>{{$land->tapwater}}</option>
                                                <option value="Tersedia">Tersedia</option>
                                                <option value="Tidak Tersedia" selected>Tidak Tersedia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Dekat Sekolah</label>
                                    <input class="input is-primary" type="text" name="nschool" value="{{$land->nearestSchool}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Dekat Pusat Kota</label>
                                    <input class="input is-primary" type="text" name="nrailway" value="{{$land->nearestRailway}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label for="name">Dekat Halte Bus</label>
                                    <input class="input is-primary" type="text" name="nbus" value="{{$land->nearestBusStop}}">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control is-pulled-right">
                                    <button type="submit" class="button is-success">
                                        Simpan Perubahan
                                </button>
                                    <button type="reset" class="button is-danger">
                                        Batal
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </form>
            </div>
        </div>
        <br>
        <br>
    </div>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script>
        tinymce.init({ selector:'textarea' });
    </script>
    <script>
        var map;
                function initAutocomplete() {
                    map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: {{$land->property->latitude}}, lng: {{$land->property->longitude}} },
                    zoom: 15
                    });
    
                    var marker = new google.maps.Marker({
                    position: {lat: {{$land->property->latitude}}, lng: {{$land->property->longitude}} },
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKNG_uMsCgUvpLc_Adr2n9nwo6BWOImoM&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript">
        $(document).ready(function() {
        
              $(".addmore").click(function(){ 
                  var html = $(".clone").html();
                  $(".increment").after(html);
              });
        
              $("body").on("click",".removepic",function(){ 
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
    </div>
    </div>
    </div>
    </div>