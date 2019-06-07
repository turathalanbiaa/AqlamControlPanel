





@extends('components.layouts.layout')

@section('style')
    <style>
        .table thead th{
            border-bottom: none;
            color: white;
        }
    </style>
@endsection


@section('content')

    @if(session('message'))
        @component('components.ui.alertMessage')
            @slot('type')
                {{session('type')}}
            @endslot
            @slot('message')
                {{session('message')}}
            @endslot
        @endcomponent
    @endif

    @component('components.articles.tempTrashArticles', ['articles' => $articles])
    @endcomponent

    @component('components.ui.backToMainPage')
    @endcomponent

@endsection
