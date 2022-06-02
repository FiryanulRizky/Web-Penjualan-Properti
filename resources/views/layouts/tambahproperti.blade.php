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
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
        rel="stylesheet">

</head>

<body>
    @include('hasil.navhasil')
    <br>
    <div class="title has-text-centered">Pilih Jenis Properti</div>
    <br>
    <div class="container downmargin">
        <div class="columns is-variable is-1-mobile is-0-tablet is-3-desktop is-8-widescreen is-2-fullhd">
            <a href="/tambah/rumah" class="column gapme has-text-centered selectboxx">
                <div>
                    <i class="fas fa-home fa-5x"></i>
                    <br>
                    <div class="subtitle">Rumah</div>
                </div>
            </a>
            <a href="/tambah/lahan" class="column gapme has-text-centered selectboxx">
                <div>
                    <i class="fas fa-map-marker-alt fa-5x"></i>
                    <br>
                    <div class="subtitle">Lahan</div>
                </div>
            </a>
            <a href="tambah/gedung" class="column gapme has-text-centered selectboxx">
                <div>
                    <i class="far fa-building fa-5x"></i>
                    <br>
                    <div class="subtitle">Gedung</div>
                </div>
            </a>
        </div>
        <br>
        <div class="columns is-variable is-1-mobile is-0-tablet is-3-desktop is-8-widescreen is-2-fullhd is-centered">
            <a href="tambah/apartemen" class="column gapme has-text-centered selectboxx is-one-third">
                <div>
                    <i class="fas fa-bed fa-5x"></i>
                    <br>
                    <div class="subtitle">Apartemen</div>
                </div>
            </a>
            <a href="tambah/gudang" class="column gapme has-text-centered selectboxx is-one-third">
                <div>
                    <i class="fas fa-warehouse fa-5x"></i>
                    <br>
                    <div class="subtitle">Gudang</div>
                </div>
            </a>

        </div>
    </div>
    {{-- Footer --}}
    @include('layouts.footer') {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
    <script src="/js/bootstrap.js"></script>

</body>

</html>