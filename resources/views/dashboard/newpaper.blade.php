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
            <label for="author1" class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary add-author">افزودن نویسنده</a>
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
            <label for="abstract" class="col-md-2 control-label">چکیده</label>

            <div class="col-md-6">
                <textarea id="abstract" class="form-control"
                          name="abstract">{{old('abstract')}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="volume_id" class="col-md-2 control-label">مربوط به شماره</label>

            <div class="col-md-6">
                <select id="volume_id" name="volume_id" class="form-control">
                    <option disabled="disabled" selected>انتخاب کنید</option>
                    @foreach($volumes as $volume)
                        <option value="{{$volume->id}}" @if(!empty($paper)){{ ($paper->volume_id == $volume->id ? "selected":"") }}
                                @else{{ (old("volume_id") == $volume->id ? "selected":"") }}@endif>
                            {{$volume->name}}</option>
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
            <label for="pdf" class="col-md-2 control-label">فایل pdf<span class="label-desc">حداکثر 8 مگابایت</span></label>

            <div class="col-md-6">
                <input id="pdf" type="file" class="form-control" name="pdf">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">ثبت</button>
            </div>
        </div>
    </form>
@endsection