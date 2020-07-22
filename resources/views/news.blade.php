@extends('app')

@section('title', $news->title)
@section('description', $news->description)
@section('image', $news->image)

@section('content')

    <div data-controller="one-news"
          data-one-news-url="{{ $news->link }}">

        @empty($story)
            <x-news :news="$news" direct="true"/>
        @else
            <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm">
                <x-story :story="$story"/>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach($story->get('items') as $news)
                        <x-news :news="$news"/>
                    @endforeach
                </div>
            </article>
        @endempty
    </div>

@endsection
