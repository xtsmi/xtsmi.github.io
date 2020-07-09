@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-9">
            @foreach($story as $key => $group)

                {{--
                <div class="row">
                    <div class="py-3 px-md-5 mr-auto ml-auto">
                        <h2 class="text-dark font-weight-bolder text-center">{{ $key }}</h2>
                    </div>
                </div>
                --}}

                <div class="read bg-white pt-3 px-4 mb-4 rounded shadow-sm">


                    <div class="card border-0 mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">

                                {{-- Вынести --}}
                                @php $find = false @endphp
                                @foreach($group as $new)
                                    @if(!empty($new->image()) && $find === false)
                                        <img
                                            src="{{ $new->image() }}"
                                            class="card-img"
                                            alt="..."
                                            style="object-fit: cover; height: 100%; width: 100%"
                                        >
                                        @php $find = true @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-8">
                                <div class="py-3 px-md-5 mr-auto ml-auto">
                                    <h2 class="text-dark font-weight-bolder text-center">{{ $key }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-md-4 row-cols-xl-3 row-cols-sm-2 row-cols-sm-1">


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
                                    {{ $new->pubDate->diffForHumans() }}
                                </time>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col">

            <div class="pb-3 mb-3 border-bottom">
                <h1 class="h5 text-muted font-weight-light">Последние темы</h1>
            </div>

            @foreach($lastNews->take(50) as $new)
                <div class="row mb-5">
                    <div class="col">

                        @empty(!$new->image())
                            <img src="{{ $new->image() }}" class="img-fluid">
                        @endempty

                        <div class="media v-center mb-2">
                            <img src="{{ $new->favicon() }}" class="mr-2">
                            <div class="media-body">{{ $new->domain() }}</div>
                        </div>
                        <h5>
                            <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                               class="text-dark">{{ $new->title }}</a>
                        </h5>

                        <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                            {{ $new->pubDate->diffForHumans() }}
                        </time>

                    </div>
                </div>
            @endforeach


        </div>
    </div>

@endsection
