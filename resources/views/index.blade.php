@extends('app')

@section('content')
    @foreach($stories as $story)
        <article class="bg-white pt-3 px-3 mb-4 rounded shadow-sm">
            <x-story :story="$story"/>

            <div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach($story->get('items')->take(3) as $news)
                        <x-news :news="$news"/>
                    @endforeach

                    @foreach($story->get('items')->skip(3) as $news)
                        <x-news :news="$news" class="d-none"/>
                    @endforeach
                </div>

                @if($story->get('items')->count() > 3)
                    <div class="text-center pb-3">
                        <a href="#" title="Больше источников">
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-down-short"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd"
                                      d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

        </article>
    @endforeach
@endsection

