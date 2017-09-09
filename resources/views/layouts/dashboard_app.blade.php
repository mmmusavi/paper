@include('layouts.header')

    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">امکانات</div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li><a href="/dashboard">داشبورد اصلی</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">@yield('content_title')</div>

                    <div class="panel-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('layouts.footer')