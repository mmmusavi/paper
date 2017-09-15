@php($lastVol=App\Volume::find($id))
@php($lastVolCat=$lastVol->cat()->first())
@php($breadcumb=$lastVolCat->name.'، '.$lastVol->name)
@php($breadcumb_link=url()->current())
@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        @include('layouts.paperlist',['lastVolCat'=>$lastVolCat,'lastVol'=>$lastVol])
    </div>
@endsection
