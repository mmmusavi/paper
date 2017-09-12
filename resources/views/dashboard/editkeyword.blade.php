@extends('layouts.dashboard_app')

@section('content_title')
   ویرایش <span style="font-weight: 400;">{{$keyword->name}}</span>
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
            <label for="name" class="col-md-2 control-label">عنوان</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name"
                       value="{{old('name',$keyword->name)}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">تایید</button>
            </div>
        </div>
    </form>
@endsection
