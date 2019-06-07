





@if ($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert-danger" style="direction: ltr">
            {{$error}}
        </div>
    @endforeach
@endif