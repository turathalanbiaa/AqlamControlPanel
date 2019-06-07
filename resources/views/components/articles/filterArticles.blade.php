





<form method="post" action="/test" style="margin-bottom: 4%; direction: rtl" id="tableFilter">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="createdAt">تاريخ رفع التدوينة</label>
            <input type="date" class="form-control" id="createdAt" value="2019-22-4" name="created_at">
        </div>
        <div class="form-group col-md-3">
            <label for="inputState">حالة التدوينة</label>
            <select id="inputState" class="form-control" name="status">
                <option value="4" selected>اختار حالة التدوينة</option>
                <option value="{{App\Enum\ArticleStatus::ACCEPT}}">مقبولة</option>
                <option value="{{App\Enum\ArticleStatus::REJECT}}">مرفوضة</option>
                <option value="{{App\Enum\ArticleStatus::OUTSTANDING}}">معلقة</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">الصنف</label>
            <select id="inputState" class="form-control" name="category">
                <option selected>اختار الصنف</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">اضافة فلتر</button>
</form>