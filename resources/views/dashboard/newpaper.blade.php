@extends('layouts.dashboard_app')

@section('content_title')
    @if (!empty($paper))ویرایش  <span style="font-weight: 400;">{{$paper->title}}</span>@else افزودن مقاله جدید @endif
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
    @if(Session::has('message') and !empty($paper))
        <div class="alert alert-success">
            <ul>
                <li>{{Session::get('message')}}</li>
            </ul>
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST"
          action="@if (!empty($interest)){{ url('/dashboard/papers/edit/'.$id) }} @else {{ url('/dashboard/papers/new') }} @endif"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title" class="col-md-2 control-label">عنوان</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title"
                       value="@if(!empty($paper)){{$paper->title}}@else{{old('title')}}@endif">
            </div>
        </div>

        <div class="form-group authors-div">
            <label for="author" class="col-md-2 control-label">نام نویسنده 1</label>

            <div class="col-md-6">
                <input id="author" data-number="1" type="text" placeholder="تایپ کنید" class="form-control get_profile">
                <div class="instant_box profile_target"></div>
                <input name="author[]" data-number="1" type="hidden" class="author">
            </div>
        </div>

        <div class="form-group authors-div">
            <label for="email" class="col-md-2 control-label">ایمیل نویسنده 1</label>

            <div class="col-md-6">
                <input id="email" data-number="1" type="text" class="form-control email" name="email[]">
            </div>
        </div>

        <div class="form-group authors-div">
            <label for="affiliation" class="col-md-2 control-label">وابستگی نویسنده 1</label>

            <div class="col-md-6">
                <textarea id="affiliation" data-number="1" placeholder="تایپ کنید" class="form-control get_affiliation"></textarea>
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
                          name="keywords">@if(!empty($paper)){{$paper->keywords}}@else{{old('keywords')}}@endif</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="abstract" class="col-md-2 control-label">چکیده</label>

            <div class="col-md-6">
                <textarea id="abstract" class="form-control"
                          name="abstract">@if(!empty($paper)){{$paper->abstract}}@else{{old('abstract')}}@endif</textarea>
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
            <label for="pdf" class="col-md-2 control-label">فایل pdf</label>

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