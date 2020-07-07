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
    <script type="text/javascript">
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('sw.js')
            .then(function(registration) {
                console.log('sw activated!');
            })
            .catch(function(error) {
                console.error('sw failed:', error);
            });
        }
    </script>
</head>
<body>


<nav class="site-header">
    <div class="px-5 bg-dark" style="background: #333333;">
        <div class="container">
            <div class="px-5 d-flex flex-column flex-md-row justify-content-start" style="align-items: center;">
                <a href="{{url('/')}}" class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg"  height="50px" alt="TSMI" viewBox="0 0 88.91 50"><defs><style>.cls-1{fill:#82c502;}.cls-2{fill:#fff;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect class="cls-1" width="36.23" height="50"/><path class="cls-2" d="M57.32,18.83A6.09,6.09,0,0,0,55.1,17.3a8.06,8.06,0,0,0-3.16-.58,6,6,0,0,0-3.8,1A3.28,3.28,0,0,0,47,20.38a3,3,0,0,0,.31,1.46,2.82,2.82,0,0,0,1,1,6.63,6.63,0,0,0,1.7.72c.7.21,1.52.41,2.46.61s2,.48,2.84.75a8.44,8.44,0,0,1,2.15,1,4.34,4.34,0,0,1,1.36,1.51,4.67,4.67,0,0,1,.47,2.22A5,5,0,0,1,58.71,32a4.81,4.81,0,0,1-1.47,1.67,6.59,6.59,0,0,1-2.25,1,12.15,12.15,0,0,1-2.86.32,11.71,11.71,0,0,1-7.9-2.86l1-1.58a8,8,0,0,0,1.26,1.06,9.42,9.42,0,0,0,1.64.87,10.46,10.46,0,0,0,1.92.58,10.87,10.87,0,0,0,2.17.21,6.71,6.71,0,0,0,3.67-.85,2.83,2.83,0,0,0,1.32-2.56,2.93,2.93,0,0,0-.37-1.54,3.18,3.18,0,0,0-1.13-1.08,7.7,7.7,0,0,0-1.86-.79c-.74-.23-1.6-.45-2.58-.67S49.3,25.3,48.53,25a7.1,7.1,0,0,1-2-1,3.75,3.75,0,0,1-1.21-1.4,4.53,4.53,0,0,1-.4-2,5.56,5.56,0,0,1,.51-2.43,4.73,4.73,0,0,1,1.46-1.77,7,7,0,0,1,2.22-1.09A10.37,10.37,0,0,1,52,15a9.55,9.55,0,0,1,3.5.6,9.21,9.21,0,0,1,2.79,1.67Z"/><path class="cls-2" d="M80.09,34.83V18.66L72.91,31.17H71.77L64.59,18.66V34.83H62.65V15.14h2l7.69,13.48,7.74-13.48h2V34.83Z"/><path class="cls-2" d="M87,34.83V15.14h1.94V34.83Z"/><path class="cls-2" d="M26.23,16.74H19.1V35h-2V16.74H10V15H26.23Z"/></g></g></svg>
                </a>

                <nav class="my-2 my-md-0 mr-auto">
                    <a class="p-2 text-white" href="{{ route('index') }}">Главные новости</a>
                    <a class="p-2 text-white" href="{{ route('list') }}">Лента</a>
                </nav>


                <div class="my-2 my-md-0 d-none d-md-block">
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

            </div>
        </div>
    </div>
</nav>

<div class="container">

    <main id="app" class="p-md-5">
        @yield('content')
    </main>

    <footer class="footer mt-auto py-3 px-5">

        <div class="row">
            <div class="col-12 col-md-6">
                <img class="mb-2" height="50px" src="/img/logo2.svg" alt="TSMI">
                <p class="text-muted">
                    Актуальные новости из различных источников.
                </p>

                <ul class="list-unstyled list-group list-group-horizontal mb-3">
                    <li class="mr-2">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1.5em" viewBox="0 0 24 24" width="1.5em"><circle cx="12" cy="12" fill="#039be5" r="12"/><path d="m5.491 11.74 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z" fill="#fff"/></svg>
                        </a>
                    </li>

                    <li class="mr-2">
                        <a href="#">
                            <svg width="1.5em" height="1.5em" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
<g>
    <g>
        <circle id="XMLID_11_" style="fill:#4D76A1;" cx="56.098" cy="56.098" r="56.098"/>
    </g>
    <path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF;" d="M53.979,80.702h4.403c0,0,1.33-0.146,2.009-0.878   c0.625-0.672,0.605-1.934,0.605-1.934s-0.086-5.908,2.656-6.778c2.703-0.857,6.174,5.71,9.853,8.235   c2.782,1.911,4.896,1.492,4.896,1.492l9.837-0.137c0,0,5.146-0.317,2.706-4.363c-0.2-0.331-1.421-2.993-7.314-8.463   c-6.168-5.725-5.342-4.799,2.088-14.702c4.525-6.031,6.334-9.713,5.769-11.29c-0.539-1.502-3.867-1.105-3.867-1.105l-11.076,0.069   c0,0-0.821-0.112-1.43,0.252c-0.595,0.357-0.978,1.189-0.978,1.189s-1.753,4.667-4.091,8.636c-4.932,8.375-6.904,8.817-7.71,8.297   c-1.875-1.212-1.407-4.869-1.407-7.467c0-8.116,1.231-11.5-2.397-12.376c-1.204-0.291-2.09-0.483-5.169-0.514   c-3.952-0.041-7.297,0.012-9.191,0.94c-1.26,0.617-2.232,1.992-1.64,2.071c0.732,0.098,2.39,0.447,3.269,1.644   c1.135,1.544,1.095,5.012,1.095,5.012s0.652,9.554-1.523,10.741c-1.493,0.814-3.541-0.848-7.938-8.446   c-2.253-3.892-3.954-8.194-3.954-8.194s-0.328-0.804-0.913-1.234c-0.71-0.521-1.702-0.687-1.702-0.687l-10.525,0.069   c0,0-1.58,0.044-2.16,0.731c-0.516,0.611-0.041,1.875-0.041,1.875s8.24,19.278,17.57,28.993   C44.264,81.287,53.979,80.702,53.979,80.702L53.979,80.702z"/>
</g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
</svg>
                        </a>
                    </li>
                </ul>

                <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                    <li><a class="text-muted" href="#">Locations</a></li>
                    <li><a class="text-muted" href="#">Privacy</a></li>
                    <li><a class="text-muted" href="#">Terms</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                    <li><a class="text-muted" href="#">Resource name</a></li>
                    <li><a class="text-muted" href="#">Another resource</a></li>
                    <li><a class="text-muted" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <img src="/img/google-play.png" class="img-fluid">
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
