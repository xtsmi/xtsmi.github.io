<!doctype html>
<html lang="{{ app()->getLocale() }}" data-controller="html-load">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Твоё СМИ - Новостной агрегатор. Самые последний и свежие новости в России, в сети, в мире. Узнавайте новости первыми.')</title>
    <meta name="description"
          content="@yield('description','Самые горячие новости в России, в США, в мире. Последние события в мире новостей.')">
    <meta name="keywords"
          content="@yield('keywords','Новости, вести, события, последние, горячее, в мире, в России, в США.')">
    <link rel="stylesheet" type="text/css" href="{{mix('/css/app.css')}}">

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


    @include('feed::links')

    <meta name="turbolinks-root" content="/">
    <meta http-equiv="X-DNS-Prefetch-Control" content="on"/>
    <link rel="dns-prefetch" href="{{ config('app.url') }}"/>
    <script src="{{ mix('/js/app.js')}}" type="text/javascript"></script>
</head>
<body>


<nav class="site-header">
    <div class="px-5 bg-dark" style="background: #333333;">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-start align-items-center">
                <a href="{{url('/')}}" class="mr-auto">
                    <img src="/img/logo.svg" height="50px" alt="TSMI">
                </a>

                <div class="my-2 my-md-0 d-none d-md-block">
                    <span class="p-2 text-white">
                        <span class="text-muted">USD:</span>
                        63,05
                        <span class="text-success">&#8593; 0,45</span>
                    </span>
                    <span class="p-2 text-white">
                        <span class="text-muted">EUR:</span>
                        73,26
                        <span class="text-danger">&#8595; 0,30</span>
                    </span>
                    <span class="p-2 text-white">
                        11 июля, <strong>суббота</strong>, 15<span class="blinker">:</span>47
                    </span>
                </div>

            </div>
        </div>
    </div>
</nav>

<div class="container">

    <main id="app" class="py-md-4">
        @yield('content')
    </main>

    <footer class="footer mt-auto py-3">

        <div class="row">
            <div class="col-12 col-md-6">
                <img class="mb-2" height="50px" src="/img/logo2.svg" alt="TSMI">
                <p class="text-muted">
                    Актуальные новости из различных источников.
                </p>
                <small class="d-block mb-3 text-muted">&copy; 2017-{{ date('Y') }}</small>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                    <li><a class="text-muted" href="#">Locations</a></li>
                    <li><a class="text-muted" href="#">Privacy</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                    <li><a class="text-muted" href="#">Resource name</a></li>
                    <li><a class="text-muted" href="#">Another resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <p class="text-right">
                    <small class="border p-2 rounded"> 18+ </small>
                </p>
            </div>
        </div>


    </footer>
</div>


@include('particles.analytics')

</body>
</html>
