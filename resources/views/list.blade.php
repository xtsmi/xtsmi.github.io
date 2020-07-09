@extends('app')

@section('content')
    <div data-controller="list">
        @foreach($news->take(10) as $new)
            @include('particles.list_item', [
                'new' => $new
            ])
        @endforeach
    </div>
    <template id='newsListItemTemplate'>
        @include('particles.list_item', ['new' => []])
    </template>


@endsection
