





<div class="row justify-content-md-center">
    <div class="col-md-4" style="padding: 0">
        <div class="login-card">
            <div class="jumbotron" style="background-color: transparent">
                @if (session('message'))
                    <div class="alert alert-danger">
                        <p>{{session('message')}}</p>
                    </div>
                @endif
                <form action="{{route('login')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input  type="email" class="form-control" name="email" placeholder="المعرف">
                    </div>
                    <div class="form-group">
                        <input  type="password" class="form-control" name="password" placeholder="الرقم السري">
                    </div>
                    <div class="row" style="margin-top: 10%">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block login-btn">دخول</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>