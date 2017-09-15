@include('layouts.header')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div style="background: url(http://eot.ir/images/back1.jpg);width: 100%;height: 310px;"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">شماره‌های نشریه</div>
                <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            @foreach(\App\VolumeCat::orderBy('place','desc')->get() as $volume)
                                <div class="panel panel-default vol-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle vol-panel-a @if(!$loop->first) collapsed @endif" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$volume->id}}">
                                                {{$volume->name}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$volume->id}}" class="panel-collapse collapse @if($loop->first) in @endif">
                                        <div class="panel-body">
                                            @foreach($volume->volumes()->orderBy('place','desc')->get() as $vol)
                                                <a href="/volume/{{$vol->id}}"><i class="fa fa-sticky-note"></i> {{$vol->name}}</a>
                                                <span class="vol-panel-desc" @if($loop->last) style="margin: 0; @endif">{{$vol->desc}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                </div>
            </div>
        </div>
        @yield('content')
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">شناسنامه نشریه</div>
                <div class="panel-body">
                    <ul class="about-ul">
                        <li>صاحب امتیاز<br><span class="about-span">ایران اندیش</span></li>
                        <li>سردبیر<br><span class="about-span">کاظمی حقیقی</span></li>
                        <li>مدیر داخلی<br><span class="about-span">کاظمی حقیقی</span></li>
                        <li>مدیر اجرایی<br><span class="about-span">کاظمی حقیقی</span></li>
                    </ul>
                    <hr />
                    <ul class="about-ul">
                        <li>شاپا چاپی<span class="pull-left">2423-2526</span></li>
                        <li>شاپا الکترونیکی<span class="pull-left">2423-2555</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.footer')
