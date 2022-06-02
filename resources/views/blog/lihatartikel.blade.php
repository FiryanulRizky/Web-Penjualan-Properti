@include('blog.blognav')
<section class="hero is-info is-medium is-bold">
  <div class="hero-body" style='background-image: url("/img/home.jpeg");   filter: blur(8px);'>
  </div>
  <span class="container has-text-centered textbox">
            <h1 class="title is-1">{{$article->title}}</h1>
        </span>
</section>


<div class="container">

  <section class="articles">
    <div class="column is-8 is-offset-2">
      <div class="card article">
        <div class="card-content">
          <div class="media">
            <div class="media-center">
              <img src="/uploads/avatars/{{$article->admin->avatar}}" class="author-image" alt="Placeholder image">
            </div>
            <div class="media-content has-text-centered">
              <p class="title article-title">{{$article->title}}
                <p/>
                <div class="tags has-addons level-item">
                  <span class="tag is-rounded is-info">@<span>{{$article->admin->name}}</span></span>
                  <span class="tag is-rounded">{{$article->created_at->isoFormat('LLL')}}</span>
                </div>
            </div>
          </div>
          <div class="content article-body">
            {!! $article->content !!}
          </div>
        </div>
      </div>
    </div>
    <div class="column is-8 is-offset-2">
      @foreach ($article->comments as $comment)
      <article class="media">      
        <figure class="media-left">
          <p class="image is-64x64">
            @if ($comment->user_id == 0)
              <img class="is-rounded" src="/uploads/avatars/{{$article->admin->avatar}}">
            @else
              <img class="is-rounded" src="/uploads/avatars/{{$comment->user->avatar}}">
            @endif
            
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <p>
              @if ($comment->user_id == 0)
                <strong>{{$article->admin->name}}</strong>
              @else
                <strong>{{$comment->user->name}}</strong>
              @endif
              <br> {{$comment->comment}}
              <br>
              @if (Auth::guard('admin')->check())
                <a href="/blog/komen/{{$comment->id}}/hapus"><small class="media-right is-pulled-right has-text-link">Hapus Komentar</small></a>
              @endif
              @if (auth()->user() && $comment->user_id)
                <a href="/blog/komen/{{$comment->id}}/hapus/user"><small class="media-right is-pulled-right has-text-link">Hapus Komentar</small></a>
              @endif
              <small class="media-right is-pulled-right has-text-link">{{$comment->created_at->diffForHumans()}}</small>
            </p>
            
          </div>
      </article>
      @endforeach
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
              
              @if (Auth::check() || Auth::guard('admin')->check())
                @auth
                 <img class="is-rounded"  src="/uploads/avatars/{{auth()->user()->avatar}}">    
                @endauth
                @auth('admin')
                  <img class="is-rounded"  src="/uploads/avatars/{{$article->admin->avatar}}">  
                @endauth
              @else 
              @guest
              <img class="is-rounded"  src="/uploads/avatars/user.jpg"> 
              @endguest

              @endif         
            </p>
        </figure>
        <div class="media-content">

          <form action="/blog/komen" method="post">
            @csrf
            <div class="field">
              <p class="control">
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <textarea class="textarea" placeholder="Tambahkan Komentar..." name="comment" required></textarea>
              </p>
            </div>
            <div class="field">
              <p class="control">
                <button class="button is-primary">Kirim Komentar</button>
              </p>
            </div>
          </form>
        </div>
      </article>
      </div>
  </section>
  </div>


  {{-- JavaScript Files --}}
  <script src="/js/jquery-3.3.1.min.js"></script>
  <script src="/js/fontawesome.js"></script>
  <script src="/js/bootstrap.js"></script>
  {{-- Sweet Alert JS--}}
  <script src="/js/sweetalert.min.js"></script>
  @include('sweetalert::alert')
  </body>

  </html>