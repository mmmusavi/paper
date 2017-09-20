@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>{{$text['text-3']}}</p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
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
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ url('/dashboard/message/post') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">نام :</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">ایمیل :</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="num" class="col-md-3 control-label">شماره تماس :</label>

                        <div class="col-md-6">
                            <input id="num" type="text" class="form-control" name="num" value="{{ old('num') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt" class="col-md-3 control-label">متن :</label>

                        <div class="col-md-6">
                <textarea id="txt" class="form-control"
                          name="txt">{{old('txt')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
