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
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#83c600">
    <meta name="msapplication-TileColor" content="#83c600">
    <meta name="theme-color" content="#ffffff">
    {{-- /favicon --}}

    <meta name="turbolinks-root" content="/">
    <meta http-equiv="X-DNS-Prefetch-Control" content="on"/>
    <link rel="dns-prefetch" href="{{ config('app.url') }}"/>
    <script src="{{ mix('/js/app.js')}}" type="text/javascript"></script>
</head>
<body>


<nav class="site-header bg-white">
    <div class="px-5 bg-dark" style="background: #333333;">
        <div class="container">
            <div class="px-5 d-flex flex-column flex-md-row justify-content-start" style="align-items: center;">
                <a href="{{url('/')}}" class="mr-auto ml-auto">
                    <img src="/img/logo.svg" height="50px" alt="Responsive image">
                </a>

                {{--
                <div class="my-2 my-md-0">
                <span class="p-2 text-white">
                    <span class="text-muted">USD:</span>
                    63,05
                    <span class="text-success">&#8593; 0,45</span>
                </span>
                    <span class="p-2 text-white">
                    <span class="text-muted">EUR:</span>
                    73,26
                    <span class="text-success">&#8593; 0,30</span>
                </span>
                    <span class="p-2 text-white">
                    <span class="text-muted">Brent:</span>
                    71,74
                    <span class="text-danger">&#8595; 0,01</span>
                </span>
                </div>
                   --}}
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <main id="app" class="p-md-5">

{{--
        <div class="pb-3 border-bottom">
            <h1 class="h5 text-muted font-weight-light">Последние темы</h1>
        </div>
--}}
                <div class="col-md-12">

                    @foreach($news as $key => $group)
                        <div class="row">
                            <div class="py-3 mr-auto ml-auto">
                                <h2 class="text-dark font-weight-bolder text-center">{{ $key }}</h2>
                            </div>
                        </div>

                        <div class="row row-cols-xl-3 row-cols-sm-2 row-cols-sm-1 read bg-white pt-5 px-4 mb-4 rounded"
                             style="
            z-index: 5000;
            border-radius: 8px;
            background: #fff;
            box-shadow: inset 0 0 0 1px rgba(0,0,0,.1);
">
                            @foreach($group as $new)
                                <div class="col mb-5" data-topic="{{ \Illuminate\Support\Str::slug($key) }}">

                                    <div class="media v-center mb-2">
                                        <img src="{{ $new->favicon() }}" class="mr-2">
                                        <div class="media-body">{{ $new->domain() }}</div>
                                    </div>
                                    <h5>
                                        <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                                           class="text-dark">{{ $new->title }}</a>
                                    </h5>

                                    <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                                        {{ $new->pubDate }}
                                    </time>
                                </div>
                            @endforeach
                        </div>

                    @endforeach

                </div>

                {{--
                <div class="col-md-7">
                    <div class="read bg-white pt-5 px-4 rounded"
                         style="
                z-index: 5000;
                border-radius: 8px;
                background: #fff;
                box-shadow: inset 0 0 0 1px rgba(0,0,0,.1);
    ">
                        <div class="row row-cols-3">
                            @foreach($news as $key => $group)
                                @foreach($group as $new)
                                    <div class="col mb-5" data-topic="{{ \Illuminate\Support\Str::slug($key) }}">
                                        <div class="media v-center mb-2">
                                            <img src="https://meduza.io/favicon-16.png" class="mr-2">
                                            <div class="media-body">Meduza</div>
                                        </div>
                                        <h5>
                                            <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                                               class="text-dark">{{ $new->title }}</a>
                                        </h5>
                                        <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                                            {{ $new->pubDate }}
                                        </time>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                    </div>
                </div>
    --}}



    </main>


    <footer class="footer mt-auto py-3">
        <div class="px-5">
            <img class="mb-2" height="50px" src="/img/logo2.svg">
            <p class="text-muted">
                Актуальные новости из различных источников.
            </p>
            <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
        </div>
    </footer>
</div>


</body>
</html>
