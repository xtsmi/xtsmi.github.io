@extends('app')

@section('left-column')
    <div class="col-md-9 col-sm-12" data-target="main.groups">
        {{-- ->take(6) --}}
        @foreach($stories as $story)
            <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm" data-target="main.groupsItem">
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
    <div class="col" data-target="main.lastNews">

        <div class="mb-3 mt-2">
            <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
        </div>

        <div class="row row-cols-1">
            {{-- ->take(12) --}}
            @foreach($lastNews->take(12) as $news)
                <x-news :news="$news"/>
            @endforeach
        </div>
    </div>
@endsection


