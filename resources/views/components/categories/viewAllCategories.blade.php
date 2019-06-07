





<div class="row">
    <div class="col">
        <button class="btn btn-outline-success" type="button" data-toggle="modal"
                data-target="#addCategoryModal">اضافة صنف</button>
        <table class="table justify-content-center">
            <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th scope="col">الصنف</th>
                <th>تعديل</th>
                <th>حذف</th>

            </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <th class="text-center" scope="row">{{++$key}}</th>
                        <td>{{$category->name}}</td>
                        <td><a href="#" class="btn-edit-category" data-toggle="modal"
                               data-target="#editCategoryModal" data-id="{{$category->id}}"
                               data-title="{{$category->name}}"><i class="far fa-edit"></i></a></td>
                        <td><a href="#" class="btn-delete-category" data-toggle="modal" data-id="{{$category->id}}"
                               data-target="#deleteCategoryModal"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>