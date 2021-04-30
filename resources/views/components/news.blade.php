<div class="col my-2 pb-3 border-bottom {{ $class }}" data-target="news.item">
    <div class="v-center mb-1">
        <img src="{{ $favicon }}" class="me-2" alt="{{ $domain }}" loading="lazy">
        <div>{{ $domain }}</div>
    </div>
    <h5 class="mb-1">
        <a href="{{ $link }}" rel="noopener">{{ $title }}</a>
    </h5>
    <time class="me-1 text-muted small" datetime="{{ $pubDate }}" data-controller="news-time">
        {{ $pubDate }}
    </time>
</div>
