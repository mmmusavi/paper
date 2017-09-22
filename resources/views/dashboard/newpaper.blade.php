@extends('layouts.dashboard_app')

@section('content_title')
    افزودن مقاله جدید
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
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/dashboard/papers/new') }}"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title" class="col-md-2 control-label">عنوان</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}">
            </div>
        </div>

        <div class="form-group authors-div" data-number="1">
            <label for="author" class="col-md-2 control-label">نام نویسنده</label>

            <div class="col-md-6">
                <input autocomplete="off" id="author" data-number="1" type="text" placeholder="نام و یا نام خانوادگی را تایپ کنید" class="form-control get_profile" name="authornew[]">
                <div class="instant_box profile_target"></div>
                <input name="author[]" data-number="1" type="hidden" class="author">
            </div>
        </div>

        <div class="form-group authors-div" data-number="1">
            <label for="email" class="col-md-2 control-label">ایمیل نویسنده</label>

            <div class="col-md-6">
                <input id="email" data-number="1" type="text" class="form-control email" name="email[]">
            </div>
        </div>

        <div class="form-group authors-div" data-number="1">
            <label for="affiliation" class="col-md-2 control-label">وابستگی نویسنده</label>

            <div class="col-md-6">
                <textarea autocomplete="off" id="affiliation" data-number="1" placeholder="تایپ کنید" class="form-control get_affiliation" name="affiliationnew[]"></textarea>
                <div class="instant_box affiliation_target"></div>
                <input name="affiliation[]" data-number="1" type="hidden" class="affiliation">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary add-author">افزودن نویسنده</a>
            </div>
        </div>

        <div class="form-group">
            <label for="abstract" class="col-md-2 control-label">چکیده</label>

            <div class="col-md-6">
                <textarea id="abstract" class="form-control"
                          name="abstract">{{old('abstract')}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="keywords" class="col-md-2 control-label">کلمه‌های کلیدی<span class="label-desc">با کاراکتر ; جداکنید</span></label>

            <div class="col-md-6">
                <textarea id="keywords" class="form-control" placeholder="مثال: روانشناسی; روانپزشکی; کودکان"
                          name="keywords">{{old('keywords')}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="text" class="col-md-2 control-label">متن مقاله</label>

            <div class="col-md-10">
                <textarea id="text" class="form-control"
                          name="text">{{old('text')}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="volume_id" class="col-md-2 control-label">مربوط به مجله و شماره</label>

            <div class="col-md-6">
                <select id="volume_id" name="volume_id" class="form-control">
                    <option disabled="disabled" selected>انتخاب کنید</option>
                    @foreach($volumes as $volume)
                        <option value="{{$volume->id}}" @if(!empty($paper)){{ ($paper->volume_id == $volume->id ? "selected":"") }}
                                @else{{ (old("volume_id") == $volume->id ? "selected":"") }}@endif>
                            {{$volume->cat()->first()->magazine->name}} - {{$volume->cat()->first()->name}} - {{$volume->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="page" class="col-md-2 control-label">صفحه</label>

            <div class="col-md-6">
                <input id="page" type="text" class="form-control" name="page" value="{{old('page')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="price" class="col-md-2 control-label">قیمت به تومان</label>

            <div class="col-md-6">
                <input id="price" type="text" class="form-control" name="price" value="{{old('price')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="year" class="col-md-2 control-label">سال</label>

            <div class="col-md-6">
                <input id="year" type="text" class="form-control" name="year" value="{{old('year')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="month" class="col-md-2 control-label">ماه</label>

            <div class="col-md-6">
                <input id="month" type="text" class="form-control" name="month" value="{{old('month')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="pdf" class="col-md-2 control-label">فایل pdf<span class="label-desc">حداکثر 8 مگابایت</span></label>

            <div class="col-md-6">
                <input id="pdf" type="file" class="form-control" name="pdf">
            </div>
        </div>

        <div class="form-group">
            <h4 class="col-md-8 col-md-offset-2" style="margin-bottom:5px; padding-bottom: 5px; border-bottom: 1px solid #ccc;">شکل ها و جداول</h4>
        </div>
        <div class="form-group figures-div" data-number="1">
            <label for="name_figure" class="col-md-2 control-label">نام جدول یا شکل<span class="label-desc">مثال: جدول 1</span></label>

            <div class="col-md-6">
                <input id="name_figure" type="text" data-number="1" class="form-control" name="name_figure[]">
            </div>
            <div class="col-md-2 noselect">
                <span class="fig-find">[figure-</span><span class="fig-find fig-number" data-number="1">1</span><span class="fig-find">]</span>
            </div>
        </div>

        <div class="form-group figures-div" data-number="1">
            <label for="caption_figure" class="col-md-2 control-label">کپشن</label>

            <div class="col-md-6">
                <input id="caption_figure" type="text" data-number="1" class="form-control" name="caption_figure[]">
            </div>
        </div>

        <div class="form-group figures-div" data-number="1">
            <label for="url_figure1" class="col-md-2 control-label">تصویر</label>

            <div class="col-md-6">
                <input id="url_figure1" type="text" data-number="1" class="form-control" name="url_figure[]">
            </div>
            <a class="btn btn-default iframe-btn" type="button" href="/filemanager/dialog.php?type=1&subfolder=&editor=mce_0&lang=eng&fldr=&field_id=url_figure1">
                انتخاب
            </a>
        </div>

        <div class="form-group figures-div" data-number="1">
            <label for="desc_figure" class="col-md-2 control-label">توضیح بیشتر</label>

            <div class="col-md-6">
                <input id="desc_figure" type="text" data-number="1" class="form-control" name="desc_figure[]">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary add-figure">افزودن شکل یا جدول</a>
            </div>
        </div>

        <div class="form-group">
            <h4 class="col-md-8 col-md-offset-2" style="margin-bottom:5px; padding-bottom: 5px; border-bottom: 1px solid #ccc;">مراجع</h4>
        </div>
        <div class="form-group">
            <label for="references" class="col-md-2 control-label">مراجع</label>

            <div class="col-md-5">
                <textarea id="references" class="form-control references_new"
                          name="references"
                          style="height: 500px;">{{old('references')}}</textarea>
            </div>

            <div class="col-md-5 reference_place"></div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">ثبت</button>
            </div>
        </div>
    </form>


@endsection
@section('other_js')
    <script src="/js/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#text',
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