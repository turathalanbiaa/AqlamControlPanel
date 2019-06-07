





<div class="modal fade" tabindex="-1" role="dialog" id="editCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل صنف</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" id="editForm" method="POST" action="{{route('updateCategory')}}">
                    {{ csrf_field() }}
                    <label for="categoryName" class="mr-sm-2">عنوان الصنف :</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="categoryName" id="categoryName" value="">
                    <input type="hidden" class="form-control mb-2 mr-sm-2" name="categoryID" id="categoryID" value="">
                    <button type="submit" class="btn btn-primary mb-2">تعديل</button>
                </form>
            </div>
        </div>
    </div>
</div>