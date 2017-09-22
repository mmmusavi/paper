@php($lastVol=App\Volume::find($id))
@php($lastVolCat=$lastVol->cat()->first())
@php($breadcumb=$lastVolCat->magazine->name.'، '.$lastVolCat->name.'، '.$lastVol->name)
@php($breadcumb_link=url()->current())
@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        @include('layouts.paperlist',['lastVolCat'=>$lastVolCat,'lastVol'=>$lastVol])
    </div>
@endsection
