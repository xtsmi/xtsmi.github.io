<div class="row mb-3 pb-3 border-bottom" data-target="main.lastNewsItem">
    <div class="col">
        <div class="media v-center mb-2">
            <img src="{{ $favicon }}" class="mr-2">
            <div class="media-body">{{ $domain }}</div>
        </div>
        <h5>
            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
               class="text-dark">{{ $title }}</a>
        </h5>
        <time class="mr-1 text-muted small" datetime=" {{ $pubDate }}">
            {{ $pubDate }}
        </time>
    </div>
</div>
