<nav class="row mb-3">
    <div class="col-12">
        @foreach(config('smi.tags') as $tag)
            <a href="/tags/{{ $tag['slug'] }}"
               class="badge {{ \Illuminate\Support\Str::endsWith(url()->current(), $tag['slug'])  ? 'bg-success' : 'bg-secondary' }} border">
                {{ $tag['name'] }}
            </a>
        @endforeach
    </div>
</nav>
