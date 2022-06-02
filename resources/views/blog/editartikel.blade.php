@include('blog.blognav')
<section class="hero is-info is-medium is-bold">
    <div class="hero-body" style='background-image: url("/img/home.jpeg");   filter: blur(8px);'>
    </div>
    <span class="container has-text-centered textbox">
            <h1 class="title is-1">Edit Artikel</h1>
        </span>
</section>


<div class="container">

    <section class="articles">
        <div class="column is-12">
            <div class="card article">
                <div class="card-content">
                    <div class="column is-8 is-offset-2" style="margin-top: 5%;">
                            <div class="columns is-mobile is-centered">
                                    <div class="column is-8">
                            @include('layouts.errors') @if(session()->has('message'))
                                        <div class="notification is-success">
                                            <button class="delete"></button>
                                            <h1 class="is-size-5"><b> {{ session()->get('message') }}</b></h1>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                        <form action="" method="post">
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <label for="">Judul</label>
                                <input type="hidden" value="{{$article->id}}" name="id">
                                <input class="input is-primary" type="text" value="{{$article->title}}" placeholder="Judul Artikel" name="title">
                                </div>

                            </div>
                            <div class="filed">
                                <div class="control">
                                    <label for="">Konten</label>
                                    <textarea class="textarea is-primary" placeholder="Article Content" rows="20" name="content">{!! $article->content !!}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="field">
                                <div class="control">
                                    <label for="">Kategori</label>
                                    <br>
                                    <div class="select is-primary">
                                        <select name="category">
                                          <option>{{$article->category}}</option>
                                          <option>Gaya Hidup</option>
                                          <option>Tips</option>
                                          <option>Penawaran</option>
                                          <option>Pinjaman</option>
                                          <option>Kabar Berita</option>
                                          <option>Pemberitahuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="filed">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">Simpan Artikel</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


{{-- JavaScript Files --}}
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/fontawesome.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>s
<script>
    tinymce.init({ selector:'textarea' });

</script>
{{-- Sweet Alert JS--}}
<script src="/js/sweetalert.min.js"></script>
@include('sweetalert::alert')
</body>

</html>