@extends('app')

@section('title', $news->title)
@section('description', $news->description)
@section('image', $news->image)

@section('left-column')

    <x-news :news="$news"/>
    {{-- Какой то редирект на страницу новости и на открытие главной?  --}}

@endsection
