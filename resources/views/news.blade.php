@extends('app')

@section('title', $news->title)
@section('description', $news->description)
@section('image', $news->image)

@section('left-column')

    <div data-controller="one-news"
         data-one-news-url="{{ $news->link }}">
        <x-news :news="$news" direct="true"/>
    </div>

@endsection
