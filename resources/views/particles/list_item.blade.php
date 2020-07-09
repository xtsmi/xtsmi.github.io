<div data-target="list-news-item" class="col mb-5">
    <div class="media v-center mb-2">
        <img data-target="news-image" src="@if($new) {{ $new->favicon() }} @else @{{favicon}} @endif" class="mr-2">
        <div data-target="news-domain" class="media-body">
            @if($new) {{ $new->domain()}} @else @{{domain}} @endif
        </div>
    </div>
    <h5>
        <a href="@if($new) {{ $new->link}} @else @{{link}}" @endif" target="_blank" data-target="news-link" rel="noopener noreferrer"
            class="text-dark">@if($new) {{ $new->title}} @else @{{title}} @endif</a>
    </h5>

    <time class="mr-1 text-muted small" datetime="@if($new) {{ $new->pubDate }} @else @{{ pubDate }}" @endif"" data-target="news-pub-date">
        @if($new) {{ $new->pubDate }} @else @{{ pubDate }} @endif
    </time>
</div>