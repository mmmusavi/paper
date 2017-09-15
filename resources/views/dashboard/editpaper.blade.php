@extends('layouts.dashboard_app')

@section('content_title')
    ویرایش مقاله <span style="font-weight: 400;">{{$paper->title}}</span>
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
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/dashboard/papers/edit/'.$id) }}"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title" class="col-md-2 control-label">عنوان</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" value="{{old('title',$paper->title)}}">
            </div>
        </div>
        @php($i=1)
        @foreach($authors as $author)
        <div class="form-group authors-div" data-number="{{$i}}">
            <label for="author" class="col-md-2 control-label">نام نویسنده</label>

            <div class="col-md-6">
                <input autocomplete="off" id="author" value="{{$author->first_name}} {{$author->last_name}}" data-number="{{$i}}" type="text" placeholder="نام و یا نام خانوادگی را تایپ کنید" class="form-control get_profile" name="authornew[]">
                <div class="instant_box profile_target"></div>
                <input name="author[]" data-number="{{$i}}" type="hidden" class="author" value="{{$author->pivot->user_id}}">
            </div>

            @if($i>1)
            <div class="col-md-2" style="padding: 0">
                <a href="#" data-number="{{$i}}" class="btn btn-danger remove-author"><i class="fa fa-remove"></i> حذف نویسنده</a>
            </div>
            @endif
        </div>

        <div class="form-group authors-div" data-number="{{$i}}">
            <label for="email" class="col-md-2 control-label">ایمیل نویسنده</label>

            <div class="col-md-6">
                <input id="email" data-number="{{$i}}" type="text" class="form-control email" name="email[]" value="{{$author->email}}">
            </div>
        </div>

        <div class="form-group authors-div" data-number="{{$i}}">
            <label for="affiliation" class="col-md-2 control-label">وابستگی نویسنده</label>

            <div class="col-md-6">
                <textarea autocomplete="off" id="affiliation" data-number="{{$i}}" placeholder="تایپ کنید" class="form-control get_affiliation" name="affiliationnew[]">{{$author->affiliation}}</textarea>
                <div class="instant_box affiliation_target"></div>
                <input name="affiliation[]" data-number="{{$i}}" type="hidden" class="affiliation" value="{{$author->pivot->affiliation_id}}">
            </div>
        </div>
        @php($i++)
        @endforeach

        <div class="form-group">
            <label for="author1" class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary add-author">افزودن نویسنده</a>
            </div>
        </div>

        <div class="form-group">
            <label for="keywords" class="col-md-2 control-label">کلمه‌های کلیدی<span class="label-desc">با کاراکتر ; جداکنید</span></label>
            @php($keywords2=substr($keywords,0,strlen($keywords)-1))
            <div class="col-md-6">
                <textarea id="keywords" class="form-control" placeholder="مثال: روانشناسی; روانپزشکی; کودکان"
                          name="keywords">{{old('keywords',$keywords2)}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="abstract" class="col-md-2 control-label">چکیده</label>

            <div class="col-md-6">
                <textarea id="abstract" class="form-control"
                          name="abstract">{{old('abstract',$paper->abstract)}}</textarea>
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
                <input id="page" type="text" class="form-control" name="page" value="{{old('page',$paper->page)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">فایل فعلی</label>

            <div class="col-md-6">
                <a target="_blank" href="{{asset('storage/PaperFiles/1.pdf')}}" class="btn btn-warning">مشاهده</a>
            </div>
        </div>

        <div class="form-group">
            <label for="pdf" class="col-md-2 control-label">فایل جدید pdf<span class="label-desc">حداکثر 8 مگابایت</span></label>

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