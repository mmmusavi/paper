@php($Vol=App\Volume::find($papers->volume_id))
@php($VolCat=$Vol->cat()->first())
@php($breadcumb=$VolCat->name.'، '.$Vol->name)
@php($breadcumb_link='/volume/'.$Vol->id)
@php($breadcumb2=$papers->title)
@php($breadcumb2_link=url()->current())
@extends('layouts.app')
@section('content')
    <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="paper-title">{{$papers->title}}</h1>
                    <p>{{ $VolCat->name }}، {{ $Vol->name }}، {{ $Vol->desc }}</p>
                    <h4>نویسندگان</h4>
                    @for($i=0;$i<count($arr_name);$i++)
                        <p>{{$arr_name[$i]}}، {{$arr_affiliation[$i]}}، {{$arr_email[$i]}}</p>
                    @endfor
                    <h4>چکیده</h4>
                    <p style="text-align: justify;">{{$papers->abstract}}</p>
                    <h4>کلیدواژه‌ها</h4>
                    <p>@foreach($arr_keyword as $arr)
                            {{$arr}} @if(!$loop->last); @endif
                        @endforeach</p>
                    <h4>مراجع</h4>
                    @foreach($references as $reference)
                        <p>[{{ta_persian_num($reference->find_id)}}] {{$reference->text}}</p>
                    @endforeach
                    <h4>آمار</h4>
                    <p>تعداد بازدید: {{ta_persian_num($views)}}</p>
            </div>
            </div>
    </div>
@endsection
@php($papers->views=$views+1)
@php($papers->save())
