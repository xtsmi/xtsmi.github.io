<nav class="site-header">
    <div class="px-md-5 bg-dark" style="background: #36393f!important;">
        <div class="container">
            <div class="d-flex flex-md-row justify-content-start align-items-center">
                <a href="{{url('/')}}" class="text-white" title="Твоё СМИ - Новостной агрегатор.">
                    <x-logo/>
                </a>

                <nav class="my-2 my-md-0 ml-md-3 mr-auto">
                    @foreach(config('smi.tags') as $tag)
                        <a class="p-2 text-white d-none d-md-inline" href="/tags/{{ $tag['slug'] }}">{{ $tag['name'] }}</a>
                    @endforeach
                </nav>


                <div class="form-check form-switch d-sm-none">
                    <input class="form-check-input" type="checkbox" id="toggleMobileView" data-action="change->main#toggleMobileView">
                    <label class="form-check-label text-white" for="toggleMobileView">Последние</label>
                </div>
                <div class="my-2 my-md-0 d-none d-md-inline">
                    <x-exchange/>

                    <div class="p-2 text-white d-none d-md-inline" data-controller="current-time">
                        <span data-target="current-time.day">-</span>
                        <span data-target="current-time.month">-</span>,
                        <strong data-target="current-time.week">-</strong>,
                        <span data-target="current-time.hours">-</span>
                        <span class="blinker">:</span>
                        <span data-target="current-time.minutes">-</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
