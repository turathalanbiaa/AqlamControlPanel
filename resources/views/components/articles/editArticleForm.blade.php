





<form method="post" action="{{route('updateArticle')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleFormControlInput1">العنوان</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title"
               value="{{$article->title}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">النص</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="contentText"
                  rows="15">{{$article->content}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">الصنف</label>
        <select class="form-control" id="exampleFormControlSelect1" name="categoryID">
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if($article->category_id === $category->id) {{'selected'}} @endif>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="articleID" value="{{$article->id}}">
    <div class="form-group">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">تعديل</button>
        </div>
    </div>
</form>