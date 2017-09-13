@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="panel panel-default">
                    <div class="panel-heading">{{$papers->title}}</div>
                <div class="panel-body">
                    <div class="row">
                   <div class="col-md-4">
                       <h5>نویسندگان</h5>
                    @for($i=0;$i<count($arr_name);++$i)
                        <p>&nbsp;{{$arr_name[$i]}}&nbsp;&nbsp;({{$arr_affiliation[$i]}})&nbsp;&nbsp;&nbsp;&nbsp;{{$arr_email[$i]}}</p>
                    @endfor
                   </div>
                    <div class="col-md-2">
                    <h5>کلمات کلیدی</h5>
                    @foreach($arr_keyword as $arr)
                        <t>{{$arr}}&nbsp;&nbsp;,</t>
                    @endforeach
                    </div>
                    <div class="col-md-1">
                        <h5>تعداد بازدید</h5>
                        <p>{{$views}}</p>
                    </div>
                </div>
                    <div class="row container">
                    <h5>خلاصه مقاله</h5>
                        <p>&nbsp;{{$papers->abstract}}</p>
                    </div>
            </div>
    </div>
@endsection
