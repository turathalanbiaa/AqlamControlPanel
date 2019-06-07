





@extends('components.layouts.layout')

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

    @component('components.articles.viewArticle', ['article' => $article])
    @endcomponent

    @component('components.comments.viewComments', ['comments' => $article->comment])
    @endcomponent

    @component('components.ui.navbarBottom', ['article' => $article])
    @endcomponent

    @component('components.ui.modalConfirmDelete')

        @slot('modalID')
            {{'deleteArticle'}}
        @endslot
        @slot('routeName')
            {{'/delete-article'}}
        @endslot
        @slot('inputHiddenValue')
            {{$article->id}}
        @endslot

    @endcomponent

    @component('components.ui.modalConfirmDelete')

        @slot('modalID')
            {{'deleteComment'}}
        @endslot
        @slot('routeName')
            {{'/delete-comment'}}
        @endslot
        @slot('inputHiddenID')
            {{'commentID'}}
        @endslot

    @endcomponent

@endsection

@section('script')
    <script>
        $('document').ready(function () {
            $('.close').click(function () {
                let commentID = $(this).attr('data-id');
                $('#commentID').val(commentID);
            })
        })
    </script>
@endsection
{{--@section('script')--}}
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$('.btn-edit-category').click(function () {--}}
                {{--let editID = $(this).attr('data-id');--}}
                {{--let title = $(this).attr('data-title');--}}
                {{--$('#categoryID').val(editID);--}}
                {{--$('#title').val(title);--}}
            {{--});--}}
            {{--$('.btn-delete-category').click(function () {--}}
                {{--let deleteID = $(this).attr('data-id');--}}
                {{--$('#deleteCategory').val(deleteID);--}}
            {{--})--}}
        {{--});--}}
    {{--</script>--}}
{{--@endsection--}}