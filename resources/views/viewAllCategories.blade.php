





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

    @component('components.categories.viewAllCategories', ['categories' => $categories])
    @endcomponent

    @component('components.categories.editCategoryModal')
    @endcomponent

    @component('components.categories.addCategoryModal')
    @endcomponent

    @component('components.categories.deleteCategoryModal', ['categories' => $categories])
    @endcomponent

    @component('components.ui.backToMainPage')
    @endcomponent

@endsection


@section('script')
    <script>
        function getDeleteType() {
            let categoryID = $("#deleteCategoryID").val();
            console.log(categoryID);
            if ($('#deleteWithTransfer').is(':checked')) {
                $('#categoriesList').attr('disabled', false)
            }
            else {
                $('#categoriesList').attr('disabled', true);

            }

            $("select option[value="+categoryID+"]").attr('disabled', true)

        }
        $(document).ready(function() {
            $('.btn-edit-category').click(function () {
                let editID = $(this).attr('data-id');
                let title = $(this).attr('data-title');
                $('#categoryID').val(editID);
                $('#categoryName').val(title);
            });
            $('.btn-delete-category').click(function () {
                $("#deleteOnly").prop('checked', true);
                $('#categoriesList').attr('disabled', true);
                let categoryID = $(this).attr('data-id');
                $('#deleteCategoryID').val(categoryID);
                $(".category").each(function () {
                   $(this).attr('disabled', false);
                });
                $("select option[value="+categoryID+"]").attr('disabled', true)
            })
        });
    </script>
@endsection