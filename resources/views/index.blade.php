@extends('app')

@section('content')


    <div class="bg-white p-4 mb-4 rounded shadow-sm">
        <div class="row g-md-5 d-flex justify-content-center align-items-center h-100">
            <div class="col-sm-8">
                <!-- post -->

                @foreach($stories->slice(0, 1) as $story)
                    <div class="mb-3">
                        <a href="{{ $story['main']->internalLink }}" target="_blank" class="d-block rounded mb-2">
                            <img src="{{ $story['main']->image }}"
                                 class="img-full rounded border bg-secondary bg-gradient-secondary"
                                 alt="post-title">
                        </a>
                        <div class="">
                            <div class="v-center mb-1">
                                <img src="{{ $story['main']->favicon }}" class="me-2"
                                     alt="{{ $story['main']->domain }}" loading="lazy">
                                <div>{{ $story['main']->domain }}</div>
                            </div>

                            <h1 class="mb-1 lh-1">
                                <a href="{{ $story['main']->internalLink }}">
                                    {{ $story['main']->title }}
                                </a>
                            </h1>

                            <time class="me-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                                  data-controller="news-time">
                                {{ $story['main']->pubDate }}
                            </time>


                            <p class="mb-2 mt-3">
                                {!! nl2br(\Illuminate\Support\Str::words(strip_tags(htmlspecialchars_decode($story['main']->description)), 30)) !!}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-sm-4">
                <div class="row px-md-3 rounded bg-light row-cols-1  d-flex flex-column justify-content-start align-items-start h-100">
                @foreach($stories->slice(2, 4) as $story)
                    <!-- post -->
                        <div class="col my-auto mb-md-0">
                            <div class="details clearfix mt-2">
                                <div class="v-center mb-1">
                                    <img src="{{ $story['main']->favicon }}" class="me-2"
                                         alt="{{ $story['main']->domain }}" loading="lazy">
                                    <div>{{ $story['main']->domain }}</div>
                                </div>


                                <h5 class="mb-1"><a href="{{ $story['main']->internalLink }}">
                                        {{ $story['main']->title }}
                                    </a>
                                </h5>

                                <time class="me-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                                      data-controller="news-time">
                                    {{ $story['main']->pubDate }}
                                </time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white p-2 mb-4 rounded shadow-sm">
        <div class="rounded bordered bg-light p-3">
            <div class="row row-cols-1 row-cols-md-3 g-5">
                @foreach($stories->slice(6, 3) as $story)
                    <div class="col d-flex flex-column justify-content-start align-items-start">

                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="me-2"
                                 alt="{{ $story['main']->domain }}" loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>


                        <h5 class="mb-auto"><a href="{{ $story['main']->internalLink }}">
                                {{ $story['main']->title }}
                            </a>
                        </h5>

                        <time class="mt-2 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2">
        @foreach($stories->slice(9, 2) as $story)
            <div class="col mb-4">
                <div
                    class="row g-0 bg-white rounded mb-4 shadow-sm h-100 position-relative">

                    @if($story['main']->image !== null)
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ $story['main']->image }}"
                                 class="img-full rounded border bg-secondary bg-gradient-secondary"
                                 alt="post-title" style="width: 250px!important;
            height: 100%;
            object-fit: cover;
            max-height: 100%;">
                        </div>
                    @endif
                    <div class="col p-4 d-flex flex-column justify-content-start align-items-start position-relative">
                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="me-2"
                                 alt="{{ $story['main']->domain }}"
                                 loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>

                        <h3 class="mb-auto">{{ $story['main']->title }}</h3>
                        <time class="me-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>

                        @if($story['main']->image === null)
                            <p class="card-text mb-auto">
                                {!! nl2br(\Illuminate\Support\Str::words(strip_tags(htmlspecialchars_decode($story['main']->description)), 30)) !!}
                            </p>
                        @endif

                        <a href="{{ $story['main']->internalLink }}" class="stretched-link">Читать дальше</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <!-- dublicate -->

    <div class="bg-white p-4 mb-4 rounded shadow-sm">
        <div class="row row g-md-5">
            <div class="col-sm-8">
                <!-- post -->
                @foreach($stories->slice(11, 1) as $story)
                    <div class="mb-3">
                        <a href="{{ $story['main']->internalLink }}" target="_blank" class="d-block rounded mb-2">
                            <img src="{{ $story['main']->image }}"
                                 class="img-full rounded border bg-secondary bg-gradient-secondary"
                                 alt="post-title">
                        </a>
                        <div class="">
                            <div class="v-center mb-1">
                                <img src="{{ $story['main']->favicon }}" class="me-2"
                                     alt="{{ $story['main']->domain }}" loading="lazy">
                                <div>{{ $story['main']->domain }}</div>
                            </div>


                            <h2 class="mb-1 lh-1 h1">
                                <a href="{{ $story['main']->internalLink }}">
                                    {{ $story['main']->title }}
                                </a>
                            </h2>

                            <time class="me-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                                  data-controller="news-time">
                                {{ $story['main']->pubDate }}
                            </time>


                            <p class="mb-2 mt-3">
                                {!! nl2br(\Illuminate\Support\Str::words(strip_tags(htmlspecialchars_decode($story['main']->description)), 30)) !!}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-sm-4">
                <div class="row px-md-3 rounded bg-light row-cols-1  d-flex flex-column justify-content-start align-items-start h-100">
                @foreach($stories->slice(12, 4) as $story)
                    <!-- post -->
                        <div class="col my-auto mb-3 mb-md-0">
                            <div class="details clearfix">
                                <div class="v-center mb-1">
                                    <img src="{{ $story['main']->favicon }}" class="me-2"
                                         alt="{{ $story['main']->domain }}" loading="lazy">
                                    <div>{{ $story['main']->domain }}</div>
                                </div>


                                <h5 class="mb-1"><a href="{{ $story['main']->internalLink }}">
                                        {{ $story['main']->title }}
                                    </a>
                                </h5>

                                <time class="me-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                                      data-controller="news-time">
                                    {{ $story['main']->pubDate }}
                                </time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white p-2 mb-4 rounded shadow-sm">
        <div class="rounded bordered bg-light p-3">
            <div class="row row-cols-1 row-cols-md-3 g-5">
                @foreach($stories->slice(16, 3) as $story)
                    <div class="col d-flex flex-column justify-content-start align-items-start">

                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="me-2"
                                 alt="{{ $story['main']->domain }}" loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>


                        <h5 class="mb-auto"><a href="{{ $story['main']->internalLink }}">
                                {{ $story['main']->title }}
                            </a>
                        </h5>

                        <time class="mt-2 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2">
        @foreach($stories->slice(19, 2) as $story)
            <div class="col mb-4">
                <div
                    class="row g-0 bg-white rounded mb-4 shadow-sm h-100">

                    @if($story['main']->image !== null)
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ $story['main']->image }}"
                                 class="img-full rounded border bg-secondary bg-gradient-secondary"
                                 alt="post-title" style="width: 250px!important;
            height: 100%;
            object-fit: cover;
            max-height: 100%;">
                        </div>
                    @endif
                    <div class="col p-4 d-flex flex-column justify-content-start align-items-start  position-relative">
                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="me-2"
                                 alt="{{ $story['main']->domain }}"
                                 loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>

                        <h3 class="mb-auto">{{ $story['main']->title }}</h3>
                        <time class="me-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>

                        @if($story['main']->image === null)
                            <p class="card-text mb-auto">
                                {!! nl2br(\Illuminate\Support\Str::words(strip_tags(htmlspecialchars_decode($story['main']->description)), 30)) !!}
                            </p>
                        @endif

                        <a href="{{ $story['main']->internalLink }}" class="stretched-link">Читать дальше</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-2 mb-4 rounded shadow-sm">
        <div class="rounded bordered bg-light p-3">
            <div class="row row-cols-1 row-cols-md-3 g-5">
                @foreach($stories->slice(21, 3) as $story)
                    <div class="col d-flex flex-column justify-content-start align-items-start">

                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="me-2"
                                 alt="{{ $story['main']->domain }}" loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>


                        <h5 class="mb-auto"><a href="{{ $story['main']->internalLink }}">
                                {{ $story['main']->title }}
                            </a>
                        </h5>

                        <time class="mt-2 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- dublicate -->


    <div class="row row-cols-1 row-cols-md-4">
        @foreach($stories->slice(24, 4) as $story)
            <div class="col mb-4">
                <div
                    class="row g-0 bg-white rounded overflow-hidden flex-md-row mb-4 shadow-sm h-100 position-relative">

                    {{--
                    <div class="col-12 d-none d-lg-block">
                        <img src="{{ $story['main']->image }}"
                             class="img-full rounded border bg-secondary bg-gradient-secondary"
                             alt="post-title">
                    </div>
                    --}}

                    <div class="col p-3 d-flex flex-column justify-content-start align-items-start position-relative">
                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="me-2"
                                 alt="{{ $story['main']->domain }}"
                                 loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>

                        <h3 class="mb-2">{{ $story['main']->title }}</h3>
                        <time class="me-1 text-muted small mt-auto" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>


                        <a href="{{ $story['main']->internalLink }}" class="stretched-link d-block"></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection

