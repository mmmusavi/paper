@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul>
                    <li>چکیده مقالات این نشریه در موسسه نمایه سازی علمی کمبریج (CSA) نمایه می گردد. </li>
                    <li>این نشریه در پایگاه اطلاعات علمی جهاد دانشگاهی (SID) و نیز در کتابخانه منطقه ای علوم و تکنولوژی شیراز (ISC) نمایه می شود. </li>
                    <li>نشریه مهندسی صنایع مقالات علمی – پژوهشی را در کلیه زمینه های مرتبط چاپ می کند. </li>
                    <li>برای آگاهی از نحوه ارائه و نگارش مقالات به " ضوابط صفحه آرایی" مندرج در ابتدای نشریه مراجعه گردد. </li>
                    <li>نشریه مهندسی صنایع بر اساس مصوبه کمیسیون نشریات علمی کشور دارای درجه علمی – پژوهشی است. </li>
                    <li>مقالات ارسالی نباید قبلاً در هیچ نشریه داخلی یا خارجی چاپ شده باشند. </li>
                    <li>برای آگاهی از نحوه ارائه و نگارش مقالات به فرم مربوطه در ابتدای نشریه مراجعه گردد. </li>
                </ul>
            </div>
        </div>
        @php($lastVolCat=App\VolumeCat::orderBy('place','desc')->first())
        @php($lastVol=$lastVolCat->volumes()->orderBy('place','desc')->first())
        @php($lastPapers=$lastVol->papers()->orderBy('place','desc')->get())
        <div class="panel panel-default">
            <div class="panel-heading">شماره جاری: <span class="bold">{{ $lastVolCat->name }}، {{ $lastVol->name }}، {{ $lastVol->desc }}</span></div>
            <div class="panel-body">
                @foreach($lastPapers as $lastPaper)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>{{ta_persian_num($loop->index+1)}}- <span class="bold">{{$lastPaper->title}}</span></p>
                            <p>{{ta_persian_num($lastPaper->page)}}</p>
                            @php
                                $authors=$lastPaper->authors_order;
                                $authors=substr($authors,0,strlen($authors)-1);
                                $authors=explode(';',$authors);
                            @endphp
                            <p>
                            @foreach($authors as $author_number)
                                @if(!empty($author_number))
                                    @php
                                        $author=App\User::find($author_number);
                                    @endphp
                                    {{$author->last_name}}@if(!$loop->last) ; @endif
                                @endif
                            @endforeach
                            </p>
                            <p>
                                <a class="btn btn-default" href="/paper/{{$lastPaper->id}}"><i class="fa fa-link"></i> مشاهده مقاله</a>
                                <a class="btn btn-success" href="/addtocart/{{$lastPaper->id}}"><i class="fa fa-shopping-cart"></i> خرید مقاله</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
