@extends('app')

@section('title', $story->get('main')->title)
@section('description', $story->get('main')->description)
@section('image', $story->get('main')->image)
@section('redirect', $story->get('main')->link)

@section('content')

    <x-story :story="$story" single="true"/>

    @foreach($stories as $story)
            <x-story :story="$story"/>
    @endforeach

@endsection
