@include('layouts.header')
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">امکانات</div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li @if(\Request::is('dashboard'))class="active"@endif><a href="/dashboard"><i class="fa fa-dashboard"></i> داشبورد اصلی</a></li>
                            <li @if(\Request::is('dashboard/papers*'))class="active"@endif><a href="/dashboard/papers"><i class="fa fa-folder-open"></i> مدیریت مقالات</a></li>
                            <li @if(\Request::is('dashboard/volumes*'))class="active"@endif><a href="/dashboard/volumes"><i class="fa fa-reorder"></i> مدیریت شماره‌های مجله</a></li>
                            <li @if(\Request::is('dashboard/affiliations*'))class="active"@endif><a href="/dashboard/affiliations"><i class="fa fa-university"></i> مدیریت وابستگی‌ها</a></li>
                            <li @if(\Request::is('dashboard/keywords*'))class="active"@endif><a href="/dashboard/keywords"><i class="fa fa-key"></i> مدیریت واژه‌های کلیدی</a></li>
                            <li @if(\Request::is('dashboard/users*'))class="active"@endif><a href="/dashboard/users"><i class="fa fa-users"></i> مدیریت کاربران</a></li>
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