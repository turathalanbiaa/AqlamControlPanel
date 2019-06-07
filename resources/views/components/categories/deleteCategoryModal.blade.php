





<div class="modal fade" tabindex="-1" role="dialog" id="deleteCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">رسالة تحذير</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{route('deleteCategory')}}">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="deleteCategory"
                            id="deleteOnly" value="{{App\Enum\CategoryDeleteType::DELETE_WITH_ARTICLES}}">
                        <label class="form-check-label mr-lg-3" for="deleteOnly">
                            حذف الصنف مع التدوينات
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="deleteCategory"
                            id="deleteWithTransfer"
                            value="{{App\Enum\CategoryDeleteType::DELETE_WITH_TRANSFER_ARTICLES}}"
                            onchange="getDeleteType()">
                        <label class="form-check-label mr-lg-3" for="deleteWithTransfer">
                            حذف الصنف مع نقل التدوينات الى صنف اخر
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="categoriesList">الصنف</label>
                        <select class="form-control" id="categoriesList"  name="categoryID" disabled required>
                            <option value="" selected>الرجاء اختيار صنف</option>
                            @foreach($categories as $category)
                                <option class="category" value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="delete" id="deleteCategoryID" value="">
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="submit" class="btn btn-danger">تاكيد الحذف</button>
                </div>
            </form>

        </div>
    </div>
</div>
