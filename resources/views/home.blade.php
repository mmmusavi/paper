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
        @include('layouts.paperlist',['lastVolCat'=>$lastVolCat,'lastVol'=>$lastVol,'title'=>'شماره جاری:‌ '])
    </div>
@endsection
