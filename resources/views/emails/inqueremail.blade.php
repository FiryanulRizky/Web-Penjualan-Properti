@component('mail::message')
<h1>{{$message->type}}</h1>

<hr>
<h4>Nama Pengirim: {{$message->name}}</h4>
<h4>Email Pengirim: {{$message->email}}</h4>
<h4>Isi Pesan: {{$message->message}}</h4>
<hr>



@component('mail::button', ['url' => 'mailto:{{$message->email}}'])
Balas Pertanyaan
@endcomponent

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
