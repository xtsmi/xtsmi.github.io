@extends('app')

@section('content')

    <div class="row" data-controller="main">
        <div class="col-md-9" data-target="main.groups">
            @foreach($story->take(3) as $key => $group)
                <x-group-news :title="$key" :group="$group"/>
            @endforeach
        </div>

        <div class="col" data-target="main.lastNews">

            <div class="mb-3 mt-2">
                <h1 class="h5 text-muted font-weight-bold text-uppercase">Последние новости</h1>
            </div>

            @foreach($lastNews->take(8) as $new)
                <x-last-news :news="$new"/>
            @endforeach
        </div>
    </div>

    <script id="last-news-template" type="text/x-handlebars-template">
        @includeVerbatim('components.last-news')
    </script>

    <script id="group-template" type="text/x-handlebars-template">
        @includeVerbatim('components.last-news')
    </script>
@endsection
