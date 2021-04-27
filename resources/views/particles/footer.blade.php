<footer class="footer mt-auto py-3">

    <div class="row">
        <div class="col-12 col-md-3">
            <div class="text-dark mb-2">
                <x-logo/>
            </div>
            <p class="text-muted mb-2">
                Актуальные новости из различных источников.
            </p>
            <p>
                <small class="border p-2 rounded"> 18+ </small>
                <small class="m-2 mb-2 text-muted">&copy; 2017-{{ date('Y') }}</small>
            </p>
        </div>

        <div class="col-6 col-md-2">
            <h5>Каналы</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="https://vk.com/xtsmi" target="_blank">Вконтакте</a></li>
                <li><a class="text-muted" href="https://twitter.com/xtsmi">Twitter</a></li>
            </ul>
        </div>

        @foreach(collect(config('smi.tags'))->chunk(4) as $tags)

            <div class="col-6 col-md-auto">

                <h5>@if($loop->first)Теги @else &nbsp @endif</h5>

                <ul class="list-unstyled text-small">
                    @foreach($tags as $tag)
                        <li><a class="text-muted" href="/tags/{{ $tag['slug'] }}"> {{ $tag['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>

        @endforeach

    </div>


</footer>
