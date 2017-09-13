@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">{{$papers->title}}</div>
                <div class="panel-body">
                    <h5>نویسندگان</h5>
                        <p>&nbsp;{{$papers->authors_order}}</p>
                    <h5>خلاصه مقاله</h5>
                        <p>&nbsp;{{$papers->abstract}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
