@extends('app')


@section('content')



        {{--
                <div class="pb-3 border-bottom">
                    <h1 class="h5 text-muted font-weight-light">Последние темы</h1>
                </div>
        --}}
        <div class="col-md-12">

            @foreach($news->take(3) as $key => $group)
                <div class="row">
                    <div class="py-3 px-md-5 mr-auto ml-auto">
                        <h2 class="text-dark font-weight-bolder text-center">{{ $key }}</h2>
                    </div>
                </div>

                <div class="row row-cols-xl-3 row-cols-sm-2 row-cols-sm-1 read bg-white pt-5 px-4 mb-4 rounded shadow-sm">
                    @foreach($group as $new)
                        <div class="col mb-5">

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


@endsection
