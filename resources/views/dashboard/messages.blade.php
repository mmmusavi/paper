@extends('layouts.dashboard_app')

@section('content_title')
  مشاهده پیام ها

@endsection

@section('content')
    <table class="table text-center">
        <thead>
        <tr>
            <th class="text-center">نام</th>
            <th class="text-center">پست الکترونیک</th>
            <th class="text-center">شماره نلفن</th>
            <th class="text-center">متن پیام</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contact as $contacts)
            <tr>
                <td>{{$contacts->name}}</td>
                <td>{{$contacts->email}}</td>
                <td>{{$contacts->num}}</td>
                <td>{{$contacts->txt}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
