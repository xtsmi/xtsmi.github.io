<article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm">

    <div class="row mb-3">
        @empty(!$image)
            <div class="col-12 col-md-5">
                <img
                    src="{{ $image }}"
                    class="img-full rounded border bg-secondary bg-gradient-secondary"
                    alt="{{$title}}"
                    loading="lazy"
                >
            </div>
        @endempty
        <div class="col d-flex flex-column">
            <div class="row">
                <div class="pt-3 col d-flex flex-column">
                    <div class="v-center mb-1">
                        <img src="{{ $favicon }}" class="mr-2" alt="{{ $domain }}" loading="lazy">
                        <div>{{ $domain }}</div>
                    </div>
                    <h2 class="text-dark font-weight-bolder">{{$title}}</h2>
                    @if($single)
                        <time class="mb-2 text-muted small" datetime="{{ $pubDate }}" data-controller="news-time">
                            {{ $pubDate }}
                        </time>
                    @endif

                </div>

                <div class="d-flex mt-auto">
                    @if($single)
                        <div class="d-flex ml-auto">
                            @include('particles.share', ['url' => $internalLink])


                            <a href="{{ $internalLink }}" target="_blank" class="btn btn-secondary ml-2">Читать далее</a>
                        </div>
                    @else
                        <div class="v-center mb-1 mr-auto">
                            @if($sources->count() > 10)
                                @foreach($sources->take(5) as $domain => $favicon)
                                    <img src="{{ $favicon }}" class="mr-1" alt="{{ $domain }}" loading="lazy">
                                @endforeach

                                <small class="text-muted">И ещё {{ $sources->count() - 5 }} источников написали об
                                    этом</small>

                            @else

                                @foreach($sources as $domain => $favicon)
                                    <img src="{{ $favicon }}" class="mr-1" alt="{{ $domain }}" loading="lazy">
                                @endforeach

                            @endif
                        </div>

                        @include('particles.share', ['url' => $internalLink])
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($single)
        <p>
            {!! nl2br(\Illuminate\Support\Str::limit($description, 600)) !!}
        </p>
    @endif

    @if($items->isNotEmpty())
        <hr>
    @endif

    <div data-controller="story-items">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            @foreach($items->take(3) as $news)
                <x-news :news="$news"/>
            @endforeach

            @foreach($items->skip(3) as $news)
                <x-news :news="$news" class="d-none"/>
            @endforeach
        </div>

        @if($items->count() > 3)
            <div class="text-center pb-3">
                <button class="btn" data-action="story-items#show" title="Больше источников" data-target="story-items.showMoreBtn">
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-down-short"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                        <path fill-rule="evenodd"
                              d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>

</article>
