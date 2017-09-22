@include('layouts.header')
        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">امکانات</div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li @if(\Request::is('profile'))class="active"@endif><a href="/profile"><i class="fa fa-user-circle"></i> پروفایل من</a></li>
                            <li @if(\Request::is('profile/account*'))class="active"@endif><a href="/profile/account"><i class="fa fa-dollar"></i> حساب من</a></li>
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
@include('layouts.footer')