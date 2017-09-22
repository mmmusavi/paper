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
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary add-author">افزودن نویسنده</a>
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
            <label for="keywords" class="col-md-2 control-label">کلمه‌های کلیدی<span class="label-desc">با کاراکتر ، جداکنید</span></label>
            <div class="col-md-6">
                <textarea id="keywords" class="form-control" placeholder="مثال: روانشناسی، روانپزشکی، کودکان"
                          name="keywords">{{old('keywords',substr($keywords,0,strlen($keywords)-2))}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="text" class="col-md-2 control-label">متن مقاله</label>

            <div class="col-md-10">
                <textarea id="text" class="form-control"
                          name="text">{{old('text',$paper->text)}}</textarea>
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
                <input id="page" type="text" class="form-control" name="page" value="{{old('page',$paper->page)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="price" class="col-md-2 control-label">قیمت به تومان<span class="label-desc">برای مقالات رایگان صفر وارد شود</span></label>

            <div class="col-md-6">
                <input id="price" type="text" class="form-control" name="price" value="{{old('price',$paper->price)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="year" class="col-md-2 control-label">سال</label>

            <div class="col-md-6">
                <input id="year" type="text" class="form-control" name="year" value="{{old('year',$paper->year)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="month" class="col-md-2 control-label">ماه</label>

            <div class="col-md-6">
                <input id="month" type="text" class="form-control" name="month" value="{{old('month',$paper->month)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="day" class="col-md-2 control-label">روز</label>

            <div class="col-md-6">
                <input id="day" type="text" class="form-control" name="day" value="{{old('day',$paper->day)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">فایل فعلی</label>

            <div class="col-md-6">
                <a target="_blank" href="{{asset('storage/PaperFiles/'.$id.'.pdf')}}" class="btn btn-warning">مشاهده</a>
            </div>
        </div>

        <div class="form-group">
            <label for="pdf" class="col-md-2 control-label">فایل جدید pdf<span class="label-desc">حداکثر 8 مگابایت</span></label>

            <div class="col-md-6">
                <input id="pdf" type="file" class="form-control" name="pdf">
            </div>
        </div>

        <div class="form-group">
            <h4 class="col-md-8 col-md-offset-2" style="margin-bottom:5px; padding-bottom: 5px; border-bottom: 1px solid #ccc;">شکل ها و جداول</h4>
        </div>

        @if(count($figures)==0)
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
                <label for="caption_figure" class="col-md-2 control-label">شرح</label>

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
        @endif


        @php($j=1)
        @foreach($figures as $figure)
        <div class="form-group figures-div" data-number="{{$j}}">
            <label for="name_figure" class="col-md-2 control-label">نام جدول یا شکل<span class="label-desc">مثال: جدول 1</span></label>

            <div class="col-md-6">
                <input id="name_figure" type="text" data-number="{{$j}}" class="form-control" name="name_figure[]" value="{{$figure['name']}}">
            </div>

            <div class="col-md-2 noselect">
                <span class="fig-find">[figure-</span><span class="fig-find fig-number">{{$j}}</span><span class="fig-find">]</span>
            </div>

            @if($j>1)
                <div class="col-md-2" style="padding: 0">
                    <a href="#" data-number="{{$j}}" class="btn btn-danger remove-figure"><i class="fa fa-remove"></i> حذف</a>
                </div>
            @endif
        </div>

        <div class="form-group figures-div" data-number="{{$j}}">
            <label for="caption_figure" class="col-md-2 control-label">شرح</label>

            <div class="col-md-6">
                <input id="caption_figure" type="text" data-number="{{$j}}" class="form-control" name="caption_figure[]" value="{{$figure['caption']}}">
            </div>
        </div>

        <div class="form-group figures-div" data-number="{{$j}}">
            <label for="url_figure1" class="col-md-2 control-label">تصویر</label>

            <div class="col-md-6">
                <input id="url_figure{{$j}}" type="text" data-number="{{$j}}" class="form-control" name="url_figure[]" value="{{$figure['url']}}">
            </div>
            <a class="btn btn-default iframe-btn" type="button" href="/filemanager/dialog.php?type=1&subfolder=&editor=mce_0&lang=eng&fldr=&field_id=url_figure{{$j}}">
                انتخاب
            </a>
        </div>

        <div class="form-group figures-div" data-number="{{$j}}">
            <label for="desc_figure" class="col-md-2 control-label">توضیح بیشتر</label>

            <div class="col-md-6">
                <input id="desc_figure" type="text" data-number="{{$j}}" class="form-control" name="desc_figure[]" value="{{$figure['desc']}}">
            </div>
        </div>
        @php($j++)
        @endforeach

        <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6">
                <a href="#" class="btn btn-primary add-figure">افزودن شکل یا جدول</a>
            </div>
        </div>

        <div class="form-group">
            <h4 class="col-md-8 col-md-offset-2" style="margin-bottom:5px; padding-bottom: 5px; border-bottom: 1px solid #ccc;">منابع</h4>
        </div>

        <div class="form-group">
            <label for="references" class="col-md-2 control-label">منابع</label>

            <div class="col-md-5">
                <textarea id="references" class="form-control references_new"
                          name="references"
                          style="height: 500px;">{{old('references',$references)}}</textarea>
            </div>

            <div class="col-md-5 reference_place">{!! $references_show !!}</div>
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