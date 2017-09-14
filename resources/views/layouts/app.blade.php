@include('layouts.header')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">شماره‌های نشریه</div>
                <div class="panel-body">
                    @foreach($volumes as $volume)
                        <p><a href="/volume/{{$volume->id}}">{{$volume->name}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</div>



@include('layouts.footer')
