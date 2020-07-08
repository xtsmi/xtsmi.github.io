@extends('app')

@section('content')

    @foreach($news as $new)
        <div class="col mb-5">

            @empty(!$new->image())
                <img src="{{ $new->image() }}">
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
                {{ $new->pubDate }}
            </time>
        </div>
    @endforeach


@endsection
