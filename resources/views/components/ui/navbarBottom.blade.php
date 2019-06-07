





<nav class="navbar fixed-bottom navbar-light bg-light justify-content-center">
    <div class="col-lg-8">
        <button class="btn btn-outline-danger" role="button" data-toggle="modal"
                data-target="#deleteArticle">حذف التدوينة</button>
        <a href="{{route('editArticle', $article->id)}}" class="btn btn-outline-secondary" type="button">تعديل التدوينة</a>

        @if($article->status === 0)
            <a href="{{route('acceptArticle', $article->id)}}" class="btn btn-outline-success"
               role="button">قبول التدوينة</a>
            <button class="btn btn-outline-primary" type="button">رفض التدوينة</button>

        @elseif($article->status === 1)
            <a href="{{route('rejectArticle', $article->id)}}" class="btn btn-outline-primary"
               role="button">رفض التدوينة</a>

        @elseif($article->status === 2)
            <a href="{{route('acceptArticle', $article->id)}}" class="btn btn-outline-success"
               role="button">قبول التدوينة</a>
        @endif

        <a href="{{route('main')}}" class="btn btn-info"
           role="button">الرجوع للصفحة الرئيسية</a>

    </div>
</nav>