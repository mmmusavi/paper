<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>مجله هیجان اندیشه</title>

    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" type="text/css">
    @if(\Request::is('paper*'))
        <link rel="stylesheet" href="{{ URL::asset('css/balloon.css') }}" type="text/css">
    @endif
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>
<body id="app-layout">
<div class="container">
    <header id="Intro">
        <h1>مجله هیجان اندیشه</h1>
    </header>
</div>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header pull-right">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <!--<a class="navbar-brand" href="{{ url('/') }}">
                عنوان
            </a>-->
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/') }}">صفحه اصلی</a></li>
                <li><a href="{{ url('/referees') }}">داوران</a></li>
                <li><a href="{{ url('/AboutUs') }}">درباره نشریه</a></li>
                <li><a href="{{ url('/ContactUs') }}">تماس با ما</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">ورود</a></li>
                    <li><a href="{{ url('/register') }}">ثبت نام</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->isadmin())
                                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> داشبورد ادمین</a></li>
                            @endif
                            <li><a href="{{ url('/profile') }}"><i class="fa fa-user-circle"></i> پروفایل من</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> خروج</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>