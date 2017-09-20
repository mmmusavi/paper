@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="panel panel-default">
            <p>{{$text['text-3']}}</p>
            <div class="panel-body">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ url('/dashboard/message/post') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">نام :</label>

                        <div class="col-md-6">
                <textarea id="name" class="form-control"
                          name="name">{{old('name')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">ایمیل :</label>

                        <div class="col-md-6">
                <textarea id="email" class="form-control"
                          name="email">{{old('email')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="num" class="col-md-2 control-label">شماره تماس :</label>

                        <div class="col-md-6">
                <textarea id="num" class="form-control"
                          name="num">{{old('num')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt" class="col-md-2 control-label">متن :</label>

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
