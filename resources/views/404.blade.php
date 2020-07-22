@extends('app')

@section('title', '404 - Страница не найдена')
@section('description', 'Страница не найдена')
@section('keywords', '')

@section('content')


    <div class="error-template">
                <h2 class="display-4">
                    404 Страница не найдена</h2>
                <div class="lead">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div>
                    <a href="{{route('index')}}" class="btn btn-link btn-lg">
                        На главную
                    </a>
                </div>
            </div>


@endsection
