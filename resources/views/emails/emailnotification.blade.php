@component('mail::message')
<h1>{{$message->subject}}</h1>

<hr>
<p>Halo! {{$message->receiver_name}}</p>
<p>Dengan ini kami informasikan kepada Anda bahwa iklan properti berikut yang Anda pasang di situs telah <b>{{$message->status}}</b> oleh Administrator</p>
<p>Jika Anda membutuhkan klarifikasi lebih lanjut, silakan hubungi kami!</p>
<hr>


<p><b>Informasi Properti</b></p>
<p>Nama: {{$message->property_name}}</p>
<p>Lokasi: {{$message->property_location}}</p>
<p>Diposting Pada: {{$message->property_createdOn}}</p>
<hr>

@component('mail::button', ['url' => 'mailto:firyan2903@gmail.com'])
Balas Pesan
@endcomponent

Terimaksih<br>
{{ config('app.name') }}
@endcomponent
