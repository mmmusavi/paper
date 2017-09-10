@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">مقالات</div>

                <div class="panel-body">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th class="text-center">نام</th>
                        </tr>
                        </thead>
                        <tbody>
                         @foreach($papers as $paper)
                             <tr>
                                 <td>{{$paper->title}}</td>
                             </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
