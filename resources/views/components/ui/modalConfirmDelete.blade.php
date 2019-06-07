





<div class="modal fade" tabindex="-1" role="dialog" id="{{$modalID}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">رسالة تحذير</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>بعد الضغط على تاكيد سيتم الحذف</p>
            </div>
            <div class="modal-footer justify-content-start">
                <form method="post" action="{{$routeName}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="delete" id="{{$inputHiddenID ?? ''}}"
                           value="{{$inputHiddenValue ?? ''}}">
                    <button type="submit" class="btn btn-danger">تاكيد الحذف</button>
                </form>
            </div>
        </div>
    </div>
</div>