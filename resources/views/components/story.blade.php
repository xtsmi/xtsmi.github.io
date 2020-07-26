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
                <div class="media v-center mb-1">
                    <img src="{{ $favicon }}" class="mr-2" alt="{{ $domain }}" loading="lazy">
                    <div class="media-body">{{ $domain }}</div>
                </div>
                <h2 class="text-dark font-weight-bolder">{{$title}}</h2>
                @if($single)
                    <time class="mr-1 text-muted small" datetime="{{ $pubDate }}" data-controller="news-time">
                        {{ $pubDate }}
                    </time>
                @endif

            </div>
        </div>

        <div class="d-flex mt-auto">
            @if($single)
                <div class="text-right">
                    <button type="button" class="btn btn-secondary">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M11.724 3.947l-7 3.5-.448-.894 7-3.5.448.894zm-.448 9l-7-3.5.448-.894 7 3.5-.448.894z"/>
                            <path fill-rule="evenodd"
                                  d="M13.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-11-6.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                    </button>


                    <a href="{{ $internalLink }}" target="_blank" class="btn btn-secondary ml-2">Читать далее</a>
                </div>
            @else

                <div class="media v-center mb-1 mr-auto">
                    @foreach($sources->take(5) as $domain => $favicon)
                        <img src="{{ $favicon }}" class="mr-1" alt="{{ $domain }}" loading="lazy">
                    @endforeach

                    <small class="text-muted">И ещё {{ $sources->count() - 5 }} источников написали об этом</small>
                </div>

                <button type="button" class="btn btn-secondary">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M11.724 3.947l-7 3.5-.448-.894 7-3.5.448.894zm-.448 9l-7-3.5.448-.894 7 3.5-.448.894z"/>
                        <path fill-rule="evenodd"
                              d="M13.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-11-6.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                </button>

            @endif
        </div>
    </div>
</div>

@if($single)
    <div>
        <p>
            {!! nl2br($description) !!}
        </p>
    </div>
@endif

@if($items->isNotEmpty())
    <hr>
@endif
