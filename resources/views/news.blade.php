@extends('app')

@section('title', $story->get('main')->title)
@section('description', $story->get('main')->description)
@section('image', $story->get('main')->image)
@section('redirect', $story->get('main')->link)

@section('content')

    <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm">
        <x-story :story="$story" single="true"/>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            @foreach($story->get('items') as $news)
                <x-news :news="$news"/>
            @endforeach
        </div>
    </article>

    @foreach($stories as $story)
        <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm">
            <x-story :story="$story"/>
        </article>
    @endforeach


@endsection
