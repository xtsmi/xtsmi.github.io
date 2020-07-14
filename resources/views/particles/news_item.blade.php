<div class="row mb-3 pb-3 border-bottom" data-target="main.lastNewsItem">
    <div class="col">
        @empty(!$new->image)
            <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ $new->image }}" class="img-fluid mb-2">
            </a>
        @endempty

        <div class="media v-center mb-2">
            <img src="{{ $new->favicon }}" class="mr-2">
            <div class="media-body">{{ $new->domain }}</div>
        </div>
        <h5>
            <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
            class="text-dark">{{ $new->title }}</a>
        </h5>
        <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
            {{ $new->pubDate }}
        </time>
    </div>
</div>