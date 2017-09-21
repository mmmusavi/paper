@extends('layouts.app')

@section('searchbar')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/search') }}">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-size: 20px;line-height: 40px;" for="search" class="col-md-2 control-label">جستجو:</label>

                            <div class="col-md-9">
                                <input style="height: 55px;font-size: 20px;" id="search" type="text" class="form-control" name="search" placeholder="عبارت مورد نظر را وارد کنید و کلید اینتر را فشار دهید.">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-md-9">
        @if(0)
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
        @endif
        @php($lastVolCat=App\VolumeCat::orderBy('place','desc')->first())
        @php($lastVol2=$lastVolCat->volumes()->orderBy('place','desc')->first())
        @include('layouts.paperlist',['lastVolCat'=>$lastVolCat,'lastVol2'=>$lastVol2,'title'=>'آخرین مقالات‌ '])
    </div>
@endsection
