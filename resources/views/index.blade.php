@extends('app')


@section('content')



        {{--
                <div class="pb-3 border-bottom">
                    <h1 class="h5 text-muted font-weight-light">Последние темы</h1>
                </div>
        --}}
        <div class="col-md-12">

            @foreach($news as $key => $group)
                <div class="row">
                    <div class="py-3 px-md-5 mr-auto ml-auto">
                        <h2 class="text-dark font-weight-bolder text-center">{{ $key }}</h2>
                    </div>
                </div>

                <div class="row row-cols-xl-3 row-cols-sm-2 row-cols-sm-1 read bg-white pt-5 px-4 mb-4 rounded"
                     style="
            z-index: 5000;
            border-radius: 8px;
            background: #fff;
            box-shadow: inset 0 0 0 1px rgba(0,0,0,.1);
">
                    @foreach($group as $new)
                        <div class="col mb-5" data-topic="{{ \Illuminate\Support\Str::slug($key) }}">

                            <div class="media v-center mb-2">
                                <img src="{{ $new->favicon() }}" class="mr-2">
                                <div class="media-body">{{ $new->domain() }}</div>
                            </div>
                            <h5>
                                <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                                   class="text-dark">{{ $new->title }}</a>
                            </h5>

                            <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                                {{ $new->pubDate }}
                            </time>
                        </div>
                    @endforeach
                </div>

            @endforeach

        </div>

        {{--
        <div class="col-md-7">
            <div class="read bg-white pt-5 px-4 rounded"
                 style="
        z-index: 5000;
        border-radius: 8px;
        background: #fff;
        box-shadow: inset 0 0 0 1px rgba(0,0,0,.1);
">
                <div class="row row-cols-3">
                    @foreach($news as $key => $group)
                        @foreach($group as $new)
                            <div class="col mb-5" data-topic="{{ \Illuminate\Support\Str::slug($key) }}">
                                <div class="media v-center mb-2">
                                    <img src="https://meduza.io/favicon-16.png" class="mr-2">
                                    <div class="media-body">Meduza</div>
                                </div>
                                <h5>
                                    <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                                       class="text-dark">{{ $new->title }}</a>
                                </h5>
                                <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                                    {{ $new->pubDate }}
                                </time>
                            </div>
                        @endforeach
                    @endforeach
                </div>

            </div>
        </div>
--}}




@endsection
