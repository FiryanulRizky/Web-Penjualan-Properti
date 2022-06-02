<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Email - E-Commerce Properti</title>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/custom.css"> {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Exo+2:300i,400,400i,500,500i,600|Kanit:300,300i,400,400i,500,500i,600"
        rel="stylesheet">

</head>

<body class="grayme">

    <div class="column is-full colorbar">
        {{-- top color bar goes here --}}
    </div>
    <br>
    <div class="columns fulllogin is-centered">
        <div class="column is-two-thirds leftsideeffect">
            <a href="/">
                <figure class="image is-blacklogo">
                    <img src="/img/logoblack.png" width="112" height="28">
                </figure>
            </a>
            <div class="is-mobile textboxlogin">
                <p class="subtitle has-text-dark is-6 has-text-centered">{{ ('Hai! ')}}{{ Auth::user()->name }}</p>
                <p class="title has-text-primary is-4 has-text-centered">{{ __('Verifikasi Email Anda') }}</p>
                <p class="subtitle  has-text-centered is-size-7 tinytextlogin"> {{ __('Sebelum melanjutkan, harap periksa email Anda untuk tautan verifikasi.') }}</p>
            </div>
            <br>
            <div class="columns is-mobile is-centered">
                <div class="column is-half">
                    @if (session('resent'))
                    <div class="notification is-success is-size-7">
                        <button class="delete"></button> {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.')
                        }} </div>
                    @endif
                </div>
            </div>
            <div class="loginform">
                <div class="field ">
                        <form method="POST" action="{{ route('verification.resend') }}" class="control has-text-centered is-centered loginbutton">
                            @csrf<input type="submit" class="button is-primary is full is-uppercase" value="{{ __('klik di sini untuk verifikasi ulang') }}">
                            </input>
                        </form>
                </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Footer --}}
    @include('layouts.footer') {{-- JavaScript Files --}}
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/fontawesome.js"></script>
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