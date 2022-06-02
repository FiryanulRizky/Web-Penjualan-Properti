@include('blog.blognav')
    <section class="hero is-info is-medium is-bold">
        <div class="hero-body"style='background-image: url("/img/home.jpeg");   filter: blur(8px);'>
        </div>
        <span class="container has-text-centered textbox">
            <h1 class="title is-1">BLOG</h1>
            <div class="title">E-Commerce Properti - Platform Transaksi Properti</div>
        </span>
    </section>
    <div class="container">
        <section class="articles">
            <div class="column is-8 is-offset-2">
                @foreach ($articles as $article)
                    @include('blog.data_artikel')
                @endforeach
              </div>
              <div class="column container is-8 is-offset-2">
                    {{ $articles->links() }}
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