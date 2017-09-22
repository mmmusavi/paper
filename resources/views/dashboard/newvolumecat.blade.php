@extends('layouts.dashboard_app')

@section('content_title')
    @if (!empty($volume))ویرایش  <span style="font-weight: 400;">{{$volume->name}}</span>@else افزودن دسته شماره جدید @endif
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
    @if(Session::has('message') and !empty($volume))
        <div class="alert alert-success">
            <ul>
                    <li>{{Session::get('message')}}</li>
            </ul>
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="@if (!empty($volume))
    {{ url('/dashboard/volumeCat/edit/'.$id) }} @else {{ url('/dashboard/volumeCat/new') }} @endif">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-md-2 control-label">عنوان</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name"
                       value="@if(!empty($volume)){{$volume->name}}@else{{old('name')}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label for="magazine_id" class="col-md-2 control-label">مجله</label>

            <div class="col-md-6">
                <select id="magazine_id" class="form-control" name="magazine_id">
                    @foreach($magazines as $cat)
                        <option value="{{$cat->id}}"
                                @if(!empty($volume))
                                @if($volume->magazine_id==$cat->id)selected="selected"@endif
                                @else
                                @if(old('magazine_id')==$cat->id)selected="selected"@endif
                                @endif>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">تایید</button>
            </div>
        </div>
    </form>
@endsection
