<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - E-Commerce Properti - Platform Transaksi Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/blogcustom.css">



</head>

<body>
    <nav class="navbar is-primary">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <img src="/img/logo.png" width="112" height="28">
                </a>
                <span class="navbar-burger burger" data-target="navbarMenu">
                        <span></span>
                <span></span>
                <span></span>
                </span>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item" href="/blog">
                            Beranda
                        </a>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                    Kategori
                                </a>
                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="/blog/?category=Gaya Hidup">
                                        Gaya Hidup
                                    </a>
                                <a class="navbar-item" href="/blog/?category=Tips"> 
                                        Tips
                                    </a>
                                <a class="navbar-item" href="/blog/?category=Pinjaman">
                                        Pinjaman
                                    </a>
                                <a class="navbar-item" href="/blog/?category=Kabar Berita">
                                    Kabar Berita
                                </a>
                                <a class="navbar-item" href="/blog/?category=Pemberitahuan">
                                    Pemberitahuan
                                </a>
                            </div>
                        </div>
                        <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link">
                                        Arsip
                                    </a>
                                <div class="navbar-dropdown">
                                @if ($archives->count() > 0)
                                @foreach ($archives as $archive)
                                    <a class="navbar-item" href="/blog/?month={{ $archive->month}}&year={{$archive->year}}">{{ $archive->month .' '. $archive->year .' ('.$archive->article_count. ')' }}</a>
                                @endforeach
                                @endif    
                                </div>
                            </div>
                    <a class="navbar-item" href="/tentangkami">
                            Tentang Kami
                        </a>
                    <a class="navbar-item" href="/kontak_kami">
                            Kontak Kami
                        </a>
                </div>
            </div>
        </div>
    </nav>
