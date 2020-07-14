@extends('app')

@section('content')

    <div class="row" data-controller="main">
        <div class="col-md-9" data-target="main.groups">
            @foreach($story->take(3) as $key => $group)
                @include('particles/group', (array) $group)
            @endforeach
        </div>

        <div class="col" data-target="main.lastNews">

            <div class="mb-3 mt-2">
                <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
            </div>

            @foreach($lastNews->take(8) as $new)
                @include('particles/news_item', (array) $new)
            @endforeach
        </div>
    </div>

    {{-- <script id="group-template" type="text/x-handlebars-template">
        @verbatim
            @include('particles/group_item', [
                'group' => null,
                'key'  => null
            ])
        @endverbatim
    </script>

    <script id="last-news-template" type="text/x-handlebars-template">
        @verbatim
            @include('particles/news_item')
        @endverbatim
    </script> --}}

@endsection
