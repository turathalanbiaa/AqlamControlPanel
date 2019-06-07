





<div class="row">
    <div class="col">
        <table class="table justify-content-center">
            <thead>
            <tr style="background-color: #9561e2">
                <th class="text-center" scope="col">#</th>
                <th scope="col">عنوان التدوينة</th>
                <th>اسم المدون</th>
                <th> تاريخ رفع التدوينة</th>
                <th>عدد المشاهدات</th>
                <th>الصنف</th>
                <th>ارجاع التدوينة</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $key => $article)
                <tr>
                    <th class="text-center" scope="row">{{++$key}}</th>
                    <td><a href="{{route('viewArticle', $article->id)}}">{{$article->title}}</a> </td>
                    <td><a href="#">{{$article->user->name}}</a></td>
                    <td>{{$article->creaded_at}}</td>
                    <td>{{$article->views}}</td>
                    <td>{{$article->category->name}}</td>
                    <td style="color:{{\App\Enum\ArticleStatus::getColorOfStatus($article->status)}} ">
                        <form method="post" action="{{route('returnTrashArticle')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="articleID" value="{{$article->id}}">
                            <button type="submit" class="btn btn-link p-0">ارجاع</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="w-100">{{$articles->links("pagination::bootstrap-4")}}</div>
    </div>
</div>