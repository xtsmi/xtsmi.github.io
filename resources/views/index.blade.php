@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-9">
            @foreach($story as $key => $group)


                <div class="read bg-white pt-3 px-3 mb-4 rounded shadow-sm">

                    <div class="card border-0 mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-5">

                                {{-- Вынести --}}
                                @php $find = false @endphp
                                @foreach($group as $new)
                                    @if(!empty($new->image) && $find === false)
                                        <img
                                            src="{{ $new->image }}"
                                            class="img-full border"
                                            alt="{{$new->title}}"
                                        >
                                        @php $find = true @endphp
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-7 d-flex">
                                <div class="px-md-4 m-auto">
                                    <h2 class="text-dark font-weight-bolder">{{ $key }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row py-md-3 row-cols-xl-3 row-cols-sm-2 row-cols-sm-1">


                        @foreach($group as $new)
                            <div class="col mb-3">

                                <div class="media v-center mb-1">
                                    <img src="{{ $new->favicon }}" class="mr-1">
                                    <div class="media-body">{{ $new->domain }}</div>
                                </div>
                                <h5 class="mb-0">
                                    <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                                       class="text-dark">{{ $new->title }}</a>
                                </h5>

                                <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                                    {{ $new->pubDate }}
                                </time>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col">

            <div class="mb-3 mt-2">
                <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
            </div>

            @foreach($lastNews->take(50) as $new)
                <div class="row mb-3 pb-3 border-bottom">
                    <div class="col">
                        <div class="media v-center mb-1">
                            <img src="{{ $new->favicon }}" class="mr-1">
                            <div class="media-body">{{ $new->domain }}</div>
                        </div>
                        <h5 class="mb-0">
                            <a href="{{ $new->link }}" target="_blank" rel="noopener noreferrer"
                               class="text-dark">{{ $new->title }}</a>
                        </h5>
                        <time class="mr-1 text-muted small" datetime=" {{ $new->pubDate }}">
                            {{ $new->pubDate }}
                        </time>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

@endsection
