@include('layouts.header')
        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">امکانات</div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li @if(\Request::is('dashboard'))class="active"@endif><a href="/dashboard"><i class="fa fa-dashboard"></i> داشبورد اصلی</a></li>
                            <li @if(\Request::is('dashboard/papers*'))class="active"@endif><a href="/dashboard/papers"><i class="fa fa-folder-open"></i> مدیریت مقالات</a></li>
                            <li @if(\Request::is('dashboard/magazines*'))class="active"@endif><a href="/dashboard/magazines"><i class="fa fa-image"></i> مدیریت مجله‌ها</a></li>
                            <li @if(\Request::is('dashboard/volumeCat*'))class="active"@endif><a href="/dashboard/volumeCat"><i class="fa fa-reorder"></i> مدیریت دسته شماره‌های مجله</a></li>
                            <li @if(\Request::is('dashboard/volumes*'))class="active"@endif><a href="/dashboard/volumes"><i class="fa fa-sticky-note"></i> مدیریت شماره‌های مجله</a></li>
                            <li @if(\Request::is('dashboard/affiliations*'))class="active"@endif><a href="/dashboard/affiliations"><i class="fa fa-university"></i> مدیریت وابستگی‌ها</a></li>
                            <li @if(\Request::is('dashboard/keywords*'))class="active"@endif><a href="/dashboard/keywords"><i class="fa fa-key"></i> مدیریت واژه‌های کلیدی</a></li>
                            <li @if(\Request::is('dashboard/users*'))class="active"@endif><a href="/dashboard/users"><i class="fa fa-users"></i> مدیریت کاربران</a></li>
                            <li @if(\Request::is('dashboard/pages*'))class="active"@endif><a href="/dashboard/pages"><i class="fa fa-paste"></i> مدیریت صفحات</a></li>
                            <li @if(\Request::is('dashboard/messages*'))class="active"@endif><a href="/dashboard/messages"><i class="fa fa-comment"></i> مشاهده پیام ها</a></li>
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
@yield('other_js')