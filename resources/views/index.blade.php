@extends('app')

@section('content')
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
@endsection

