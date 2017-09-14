@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت دسته شماره‌ها
    <a title="افزودن دسته شماره جدید" href="/dashboard/volumeCat/new"><i class="fa fa-plus-square"></i></a>
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
        @foreach ($volumes as $volume)
            <tr>
                <td class="text-center">{{ $volume->name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/volumeCat/edit/{{ $volume->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="حذف" href="/dashboard/volumeCat/delete/{{ $volume->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
