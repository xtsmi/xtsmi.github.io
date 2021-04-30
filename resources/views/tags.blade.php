@extends('app')


@section('content')


    <div class="row">
        <div class="col-md-9 col-sm-12 news-ended">

            <div class="row">
                <div class="card-columns">
                    @foreach($news as $new)
                        <div class="card mb-4 rounded shadow-sm">
                            @if($new->image)
                                <a href="{{ $new->link }}" target="_blank" rel="noopener">
                                    <img src="{{ $new->image }}" class="card-img-top img-full">
                                </a>
                            @endif

                            <div class="card-body">
                                <div class="v-center mb-1">
                                    <img src="{{ $new->favicon }}" class="me-2" alt="{{ $new->domain }}" loading="lazy">
                                    <div>{{ $new->domain }}</div>
                                </div>

                                <h4 class="card-title">
                                    <a href="{{ $new->link }}" target="_blank" rel="noopener">
                                        {{ $new->title }}
                                    </a>
                                </h4>

                                <p class="card-text">{{ Str::words(strip_tags(html_entity_decode($new->description)), 20) }}</p>

                                <time class="me-1 text-muted small" datetime="{{ $new->pubDate }}"
                                      data-controller="news-time">
                                    {{ $new->pubDate }}
                                </time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

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

@endsection
