<?php use App\User; ?>

<div class="box">
    <article class="media">
      <div class="media-left">
        <figure class="image is-64x64 ">
          <?php 
              $conn = mysqli_connect("localhost","root","","db_properti");
              $img = mysqli_query($conn,"SELECT avatar FROM users WHERE id=$message->sender_id");
              $gb=mysqli_fetch_array($img);
          ?>
          @if($message->sender_id == 0)
            <img src="/uploads/avatars/user.jpg" alt="Image" class="is-rounded">
          @elseif(strcmp($message->senderName,"Administrator") == 0)
            <img src="/img/admin.png" alt="Image" class="is-rounded"> 
          @else
            <img src="/uploads/avatars/{{ $gb['avatar'] }}" alt="Image" class="is-rounded">
          @endif
        </figure>
      </div>
      <div class="media-content">
        <div class="content">
          <p>
            <strong>{{$message->subject}}</strong> <br><small>Dari @<span class="has-text-link">{{$message->senderName}}</span></small> &nbsp;<small>{{$message->created_at->diffForHumans()}}</small>
            <br>
            <br>
            {{\Illuminate\Support\Str::limit($message->message),30}}
          </p>
        </div>
        <div class="is-pulled-right">
            <p class="control has-text-centered">
            <a class="button is-danger is-rounded nounnounderlinebtn" href="/profil/pesan/{{$message->id}}/hapus">
                  Hapus
                </a>
                <a class="button is-success is-rounded nounnounderlinebtn" href="/profil/pesan/{{$message->id}}/tampil">                
                  Baca
                </a>
            </p>
        </div>
      </div>
    </article>
  </div>