@extends('layouts.dashboard_app')

@section('content_title')
   ویرایش <span style="font-weight: 400;">{{$user->last_name}}</span>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(Session::has('message'))
        <div class="alert alert-success">
            <ul>
                    <li>{{Session::get('message')}}</li>
            </ul>
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url()->current() }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="last_name" class="col-md-2 control-label">نام</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control" name="last_name"
                       value="{{old('last_name',$user->last_name)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-2 control-label">ایمیل</label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email"
                       value="{{old('email',$user->email)}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">تایید</button>
            </div>
        </div>
    </form>
@endsection
