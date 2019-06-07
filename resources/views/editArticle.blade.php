





@extends('components.layouts.layout')

@section('content')

    @component('components.ui.alertErrors')
    @endcomponent

    @component('components.articles.editArticleForm', ['article' => $article, 'categories' => $categories])
    @endcomponent

@endsection