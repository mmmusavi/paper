@include('layouts.header')

<div class="container">
    @if(Session::has('buy_message'))
        <div class="alert alert-success">
            <ul>
                <li>{{Session::get('buy_message')}}</li>
            </ul>
        </div>
    @endif
    @if(!empty($breadcumb))
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="/">صفحه اصلی</a> <i class="fa fa-chevron-left"></i> <a href="{{$breadcumb_link}}">{{$breadcumb}}</a> @if(!empty($breadcumb2)) <i class="fa fa-chevron-left"></i> <a href="{{$breadcumb2_link}}">{{$breadcumb2}}</a> @endif
            </div>
        </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            @if(0)
            <div class="panel panel-default">
                <div style="background: url(http://eot.ir/images/back1.jpg);width: 100%;height: 310px;"></div>
            </div>
            @endif
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
        @if(!\Request::is('paper*'))
            <div class="col-md-3">
                @if(0)
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
                @endif
                @if(!Auth::guest())
                    <div class="panel panel-default">
                        <div class="panel-heading">سبد خرید</div>
                        <div class="panel-body">
                            @php($carts=Auth::user()->cart()->get())
                            @php($PriceSum=0)
                            @foreach($carts as $cart)
                                @php($thispaper=$cart->paper()->first())
                                <p><a href="/deleteCart/{{$cart->id}}" title="حذف از سبد خرید"><i style="color:#da0000;" class="fa fa-remove"></i></a> <a href="/paper/{{$thispaper->id}}">{{$thispaper->title}} ({{ta_persian_num($thispaper->price)}} تومان)</a></p>
                                @php($PriceSum=$PriceSum+$thispaper->price)
                            @endforeach
                            @if(count($carts)>0)
                                <hr />
                                <p>مجموع: <span class="pull-left bold">{{ta_persian_num($PriceSum)}} تومان</span></p>
                                <a href="/checkout" class="btn btn-warning">تکمیل خرید</a>
                            @else
                                <p>سبد خرید شما خالی است.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">دانلود این مقاله</div>
                    <div class="panel-body">
                        <p style="text-align: center; font-size: 16px;">قیمت این مقاله: {{ta_persian_num($papers->price)}} تومان</p>
                        <a href="/addtocart/{{$papers->id}}" class="btn btn-success" style="width: 100%;">خرید</a>
                        <hr />
                        <ul class="about-ul">
                            <li>تعداد دانلود این مقاله<span class="pull-left">{{ta_persian_num('16')}}</span></li>
                        </ul>
                    </div>
                </div>
                @if(!Auth::guest())
                    <div class="panel panel-default">
                        <div class="panel-heading">سبد خرید</div>
                        <div class="panel-body">
                            @php($carts=Auth::user()->cart()->get())
                            @php($PriceSum=0)
                            @foreach($carts as $cart)
                                @php($thispaper=$cart->paper()->first())
                                <p><a href="/deleteCart/{{$cart->id}}" title="حذف از سبد خرید"><i style="color:#da0000;" class="fa fa-remove"></i></a> <a href="/paper/{{$thispaper->id}}">{{$thispaper->title}} ({{ta_persian_num($thispaper->price)}} تومان)</a></p>
                                @php($PriceSum=$PriceSum+$thispaper->price)
                            @endforeach
                            @if(count($carts)>0)
                                <hr />
                                <p>مجموع: <span class="pull-left bold">{{ta_persian_num($PriceSum)}} تومان</span></p>
                                <a href="/checkout" class="btn btn-warning">تکمیل خرید</a>
                            @else
                                <p>سبد خرید شما خالی است.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>



@include('layouts.footer')
