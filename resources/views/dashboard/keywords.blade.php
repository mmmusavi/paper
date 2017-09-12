@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت کلمات کلیدی
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">عنوان</th>
            <th width="10%" class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($keywords as $keyword)
            <tr>
                <td class="text-center">{{ $keyword->name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/keywords/edit/{{ $keyword->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="حذف" href="/dashboard/keywords/delete/{{ $keyword->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
