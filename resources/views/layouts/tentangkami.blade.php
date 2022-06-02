<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tentang Kami - E-Commerce Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css"> {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600" rel="stylesheet">
</head>

<body>

    <div class="column is-full is-mobile backgroundimg">
        <div class="container">
            <div class="column is-mobile is-centered">
                @include('layouts.navtentangkami');
            </div>
        </div>
        <div class="container">
            <div class="has-text-centered centertext">
                <span class="icon has-text-white is-large">
                    <i class="far fa-building fa-5x"></i>
                </span>
                <h1 class="has-text-white centertextword">Tentang Kami</h1>
            </div>
        </div>
    </div>

    {{-- Deatils Section --}}
    <div class="columns is-mobile is-centered has-background-white">
        <div class="container has-text-centered aboutus has-text-dark">
            {{-- <img class="image face" src="/img/girl1.jpeg"> --}}
            <div class='equal-height'>
                <div class='is-flex is-horizontal-center'>
                    <figure class=''><img class="image face" src='/img/firyanul.png'></figure>
                </div>
            </div>
            <br>
            <p>Selamat datang di E-Commerce Properti, sumber nomor satu Anda untuk semua hal transaksi Properti. Kami berdedikasi untuk memberikan yang terbaik dari transaksi Properti, dengan fokus pada kecepatan, kepercayaan, dan efisien.
                <br>
                <br>
                <p>Didirikan pada tahun 2022 oleh Firyanul Rizky, Portal E-Commerce Properti ini telah dikembangkan ketika Firyanul Rizky pertama kali memulai hasratnya untuk cepat mendapatkan pekerjaan dan dapat dipercaya serta mendorong banyak orang untuk melakukan pencarian terkait transaksi properti sehingga Platform ini dapat menawarkan mesin pencari properti tercanggih di dunia. Kami sekarang melayani pelanggan di wilayah bali, dan sangat senang bahwa kami dapat mengubah hasrat kami menjadi situs web kami sendiri.</p>
                <br>
                <p>Kami harap Anda menikmati layanan kami sama seperti kami menikmati menawarkannya kepada Anda. Jika Anda memiliki pertanyaan atau komentar, jangan ragu untuk menghubungi kami.</p>
                <br>
                <p><i><b>Firyanul Rizky</b></i></p>
        </div>
    </div>

    {{-- Footer --}} @include('layouts.footer') {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
</body>

</html>