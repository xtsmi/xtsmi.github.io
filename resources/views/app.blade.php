<!doctype html>
<html lang="{{ app()->getLocale() }}" data-controller="html-load">
<head>
    <base href="{{ config('app.url') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Твоё СМИ - Новостной агрегатор.')</title>
    <meta name="description"
          content="@yield('description','Самые горячие новости в России, в США, в мире. Последние события в мире новостей.')">
    <meta name="keywords"
          content="@yield('keywords','Новости, вести, события, последние, горячее, в мире, в России, в США.')">
    <link rel="stylesheet" type="text/css" href="{{mix('/css/app.css')}}">

    {{-- Open Graph --}}
    <meta property="og:title"
          content="@yield('title','Твоё СМИ - Новостной агрегатор. Самые последний и свежие новости в России, в сети, в мире. Узнавайте новости первыми.')"/>
    <meta property="og:description"
          content="@yield('description','Самые горячие новости в России, в США, в мире. Последние события в мире новостей.')"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="@yield('image',asset('/img/cover.jpg'))"/>
    <meta property="og:url" content="{{ url()->current() }}">
    {{-- /Open Graph --}}

    {{-- favicon --}}
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#83c600">
    <meta name="msapplication-TileColor" content="#83c600">
    <meta name="theme-color" content="#ffffff">
    {{-- /favicon --}}

    <meta name="yandex-verification" content="0e693be926f4cc9c" />

    @include('feed::links')

    <meta name="generated" content="{{ config('smi.generated') }}">
    <meta name="turbolinks-root" content="/">
    <meta http-equiv="X-DNS-Prefetch-Control" content="on"/>
    <link rel="dns-prefetch" href="{{ config('app.url') }}"/>
    <script src="{{ mix('/js/app.js')}}" type="text/javascript"></script>

    @env('production')
        @include('particles.analytics')
        @include('particles.adsense')
    @endenv
</head>
<body data-controller="main">

@include('particles.navigation')

<div class="container" data-controller="redirect" data-redirect-url="@yield('redirect')">

    <main id="app" class="py-md-4 py-3">
        <div class="d-md-none py-1">
            <x-exchange/>
        </div>
        
        <div class="row" data-target="main.content">
            <div class="col-md-9 col-sm-12 news-ended">
                @yield('content')
            </div>
            <div class="col"
                 data-controller="news"
                 data-news-render="{{ config('smi.news.renderCount') }}"
            >

                <div class="mb-3 mt-2">
                    <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
                </div>

                <div class="row row-cols-1" data-target="news.news">
                    @isset($lastNews)
                        @foreach($lastNews as $news)
                            <x-news :news="$news"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('particles.footer')
</div>



<script id="news-template" type="text/template">
    @includeVerbatim('components.news')
</script>


</body>
</html>
