





@extends('components.layouts.dataTableLayout')


@section('style')
    <style>
        table.dataTable thead th {
            text-align: right;
        }
        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc,
        table.dataTable thead .sorting_desc {
            background-position:left!important; ;
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

    @component('components.articles.filterArticles', ['categories' => $categories])
    @endcomponent

    @component('components.articles.viewAllArticles')
    @endcomponent

    @component('components.ui.navigationBar')
    @endcomponent


@endsection



@section('script')
    <script>
        $(document).ready(function () {

            console.log($('input[name=created_at]').val());
            $('#articles-table').DataTable({
                'language': {
                    'search': 'بحث :'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route("dataTableFilter") !!}',
                    type: 'POST',
                    data:  function (d) {
                            d.created_at = $('input[name=created_at]').val();
                            d._token = $('input[name=_token]').val();
                            d.category = $('select[name=category]').val();
                            d.inputStatus = $('#inputState').val();
                        }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'titleLink', name: 'title' },
                    { data: 'categoryName', name: 'category_id', orderable: false, searchable: false },
                    { data: 'views', name: 'views'},
                    { data: 'statusColumn', name: 'status'},
                    { data: 'created_at', name: 'created_at'},

                ]
        });

        $('#tableFilter').on('submit', function (e) {
            $('#articles-table').DataTable().draw();
            e.preventDefault();
            console.log($('select[name=status]').val())
        });
        })


    </script>
@endsection
