@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت صفحات

@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/dashboard/pages/post') }}">
        {{ csrf_field() }}

        <div class="form-group">
        <label for="text-1" class="col-md-2 control-label">قوانین :</label>

        <div class="col-md-12">
                <textarea id="text-1" class="form-control tinymce"
                          name="text-1">{{old('text-1',$page['text-1'])}}</textarea>
        </div>
    </div>

        <div class="form-group">
        <label for="text-2" class="col-md-2 control-label">درباره ما :</label>

        <div class="col-md-12">
                <textarea id="text-2" class="form-control tinymce"
                          name="text-2">{{old('text-2',$page['text-2'])}}</textarea>
        </div>
    </div>

        <div class="form-group">
        <label for="text-3" class="col-md-2 control-label">تماس با ما :</label>

        <div class="col-md-12">
                <textarea id="text-3" class="form-control tinymce"
                          name="text-3">{{old('text-3',$page['text-3'])}}</textarea>
        </div>
        </div>

        <div class="form-group">
        <div class="col-md-6 col-md-offset-5">
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>

    </form>
@endsection
@section('other_js')
    <script src="/js/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.tinymce',
            directionality : 'rtl',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
            ],
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code | ltr rtl "
        });
    </script>
@endsection
