@extends('app')

@section('content')


    <div class="bg-white p-3 mb-4 rounded shadow-sm">
            <div class="row">
                <div class="col-sm-8">
                    <!-- post -->

                    @foreach($stories->slice(0, 1) as $story)
                        <div class="mb-3">
                            <div class="thumb rounded mb-2">
                                <a href="{{ $story['main']->internalLink }}">
                                    <div class="inner">
                                        <img src="{{ $story['main']->image }}"
                                             class="img-full rounded border bg-secondary bg-gradient-secondary"
                                             alt="post-title">
                                    </div>
                                </a>
                            </div>
                            <div class="">
                                <div class="v-center mb-1">
                                    <img src="{{ $story['main']->favicon }}" class="mr-2"
                                         alt="{{ $story['main']->domain }}" loading="lazy">
                                    <div>{{ $story['main']->domain }}</div>
                                </div>


                                <h1 class="mb-1"><a href="{{ $story['main']->internalLink }}">
                                        {{ $story['main']->title }}
                                    </a>
                                </h1>

                                <time class="mr-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
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
                    <div class="row row-cols-1">
                    @foreach($stories->slice(1, 3) as $story)
                        <!-- post -->
                            <div class="col square mb-4">
                                <div class="details clearfix">
                                    <div class="v-center mb-1">
                                        <img src="{{ $story['main']->favicon }}" class="mr-2"
                                             alt="{{ $story['main']->domain }}" loading="lazy">
                                        <div>{{ $story['main']->domain }}</div>
                                    </div>


                                    <h5 class="mb-1"><a href="{{ $story['main']->internalLink }}">
                                            {{ $story['main']->title }}
                                        </a>
                                    </h5>

                                    <time class="mr-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
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


    <div class="row row-cols-1">
        @foreach($stories->slice(4, 2) as $story)
            <div class="col mb-4">
                <div
                    class="row g-0 bg-white rounded overflow-hidden flex-md-row mb-4 shadow-sm h-100 position-relative">
                    <div class="col-auto d-none d-lg-block">
                        <img src="{{ $story['main']->image }}"
                             class="img-full rounded border bg-secondary bg-gradient-secondary"
                             alt="post-title" style="width: 300px!important;
        height: 100%;
        object-fit: cover;
        max-height: 100%;">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="mr-2"
                                 alt="{{ $story['main']->domain }}"
                                 loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>

                        <h3 class="mb-2">{{ $story['main']->title }}</h3>
                        <time class="mr-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>

                        <p class="card-text mb-auto">
                            {!! nl2br(\Illuminate\Support\Str::words(strip_tags(htmlspecialchars_decode($story['main']->description)), 30)) !!}
                        </p>

                        <a href="{{ $story['main']->internalLink }}" class="stretched-link">Читать дальше</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="bg-white p-2 mb-4 rounded shadow-sm">
        <div class="rounded bordered bg-light p-3">
            <div class="row">
            @foreach($stories->slice(6, 9) as $story)
                <!-- post -->
                    <div class="col-md-4 square mb-4 h-100">

                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="mr-2"
                                 alt="{{ $story['main']->domain }}" loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>


                        <h5 class="mb-1"><a href="{{ $story['main']->internalLink }}">
                                {{ $story['main']->title }}
                            </a>
                        </h5>

                        <time class="mr-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row row-cols-md-2">
        @foreach($stories->slice(15, 2) as $story)
            <div class="col mb-4">
                <div
                    class="row g-0 bg-white rounded overflow-hidden flex-md-row mb-4 shadow-sm h-100 position-relative">
                    <div class="col-12 d-none d-lg-block">
                        <img src="{{ $story['main']->image }}"
                             class="img-full rounded border bg-secondary bg-gradient-secondary"
                             alt="post-title">
                    </div>
                    <div class="col px-4 pb-2 d-flex flex-column position-static">
                        <div class="v-center mb-1">
                            <img src="{{ $story['main']->favicon }}" class="mr-2"
                                 alt="{{ $story['main']->domain }}"
                                 loading="lazy">
                            <div>{{ $story['main']->domain }}</div>
                        </div>

                        <h3 class="mb-2">{{ $story['main']->title }}</h3>
                        <time class="mr-1 text-muted small" datetime="{{ $story['main']->pubDate }}"
                              data-controller="news-time">
                            {{ $story['main']->pubDate }}
                        </time>

                        <p class="card-text mb-auto">
                            {!! nl2br(\Illuminate\Support\Str::words($story['main']->description, 30)) !!}
                        </p>

                        <a href="{{ $story['main']->internalLink }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection

