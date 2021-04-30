@extends('app')

@section('title', $story->get('main')->title)
@section('description', $story->get('main')->description)
@section('image', $story->get('main')->image)
@section('redirect', $story->get('main')->link)

@section('content')


    <div class="row">
        <div class="col-md-9 col-sm-12 news-ended">
            <x-story :story="$story" single="true"/>

            @foreach($stories as $story)
                <x-story :story="$story"/>
            @endforeach
        </div>

        <div class="col"
             data-controller="news"
             data-news-render="{{ config('smi.news.renderCount') }}"
        >

            <div class="mb-3 mt-2">
                <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
            </div>

            <div class="row row-cols-1" data-target="news.news">
                @isset($lastNews)
                    @foreach($lastNews as $news)
                        <x-news :news="$news"/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
