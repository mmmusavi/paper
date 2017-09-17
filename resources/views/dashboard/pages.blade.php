@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت صفحات

@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/dashboard/pages/post') }}">
        {{ csrf_field() }}

        <div class="form-group">
        <label for="text-1" class="col-md-2 control-label">داوران :</label>

        <div class="col-md-12">
                <textarea id="text-1" class="form-control"
                          name="text-1">{{old('text-1',$page['text-1'])}}</textarea>
        </div>
    </div>
        <div class="form-group">
        <label for="text-2" class="col-md-2 control-label">درباره نشریه :</label>

        <div class="col-md-12">
                <textarea id="text-2" class="form-control"
                          name="text-2">{{old('text-2',$page['text-2'])}}</textarea>
        </div>
    </div>
        <div class="form-group">
        <div class="col-md-6 col-md-offset-5">
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>

    </form>
@endsection
