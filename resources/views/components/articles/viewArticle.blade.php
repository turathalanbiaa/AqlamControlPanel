





<div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4">{{$article->title}}</h1>

    <!-- Author -->
    <p class="lead">
        <span>بواسطة</span>
        <a href="#">{{$article->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>{{$article->created_at}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="https://alkafeelblog.edu.turathalanbiaa.com/aqlam/image/{{$article->image}}" alt="">


    <!-- Post Content -->
    <p class="mt-5" style="line-height: 2.5; font-size: 16px">{{$article->content}}</p>



</div>