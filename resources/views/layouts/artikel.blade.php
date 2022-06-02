<div class="box">
    <article class="media">
      <div class="media-left">
        <figure class="image is-128x128">
          <img src="/uploads/avatars/{{ $article->admin->avatar }}" alt="Image">
        </figure>
      </div>
      <div class="media-content">
        <div class="content">
          <p>
            <strong class="topic">{{$article->title}}</strong> <small>oleh</small> <small class="has-text-link">@<span class="has-text-link">{{$article->admin->name}}</small> <small>{{$article->created_at->diffForHumans()}}</small>
            <br>
            {{Str::limit(str_replace("&nbsp;",'',strip_tags($article->content)),300)}}
          </p>
        </div>
        <div class="is-pulled-right">
            <p class="control has-text-centered">
            <a class="button is-link is-rounded" href="/blog/{{$article->id}}/tampil" target="_blank">
                  <span>Baca Selengkapnya</span>
                </a>
            </p>
        </div>
      </div>
    </article>
  </div>