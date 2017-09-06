@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">خوش آمدید</div>

                <div class="panel-body">
                    @if (Auth::guest())
                    برای ورود روی لینک کلیک کنید.  <a href="{{ url('/login') }}">ورود</a>
                    @else
                        {{Auth::user()->name}} عزیز، خوش آمدید! <a href="{{ url('/dashboard') }}">ورود به داشبورد</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
