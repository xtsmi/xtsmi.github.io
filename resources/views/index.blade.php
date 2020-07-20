@extends('app')

@section('left-column')
    <div class="col-md-9 col-sm-12 news-ended">
        @foreach($stories as $story)
            <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm">
                <x-story :story="$story"/>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach($story->get('items')->take(3) as $news)
                        <x-news :news="$news"/>
                    @endforeach
                </div>
            </article>
        @endforeach
    </div>
@endsection

@section('right-column')
    <div class="col" data-controller="news">

        <div class="mb-3 mt-2">
            <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
        </div>

        <div class="row row-cols-1" data-target="news.news">
            @foreach($lastNews->take(12) as $news)
                <x-news :news="$news"/>
            @endforeach
        </div>
    </div>

@endsection


