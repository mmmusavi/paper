@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                @foreach($papers as $paper)
                    <div class="panel-heading">{{$paper->title}}</div>
                @endforeach
                <div class="panel-body">
                    <h5>نویسندگان</h5>
                    @foreach($papers as $paper)
                        <p>&nbsp;{{$paper->authors_order}}</p>
                    @endforeach
                    <h5>خلاصه مقاله</h5>
                    @foreach($papers as $paper)
                        <p>&nbsp;{{$paper->abstract}}</p>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
