@extends('app')

@section('content')

    @foreach($stories as $story)
        <x-story :story="$story"/>
    @endforeach

@endsection

