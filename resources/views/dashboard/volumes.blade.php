@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت شماره‌ها
    <a title="افزودن شماره جدید" href="/dashboard/volumes/new"><i class="fa fa-plus-square"></i></a>
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>

            <th class="text-center" width="10%">ترتیب</th>
            <th class="text-center">عنوان</th>
            <th class="text-center">والد</th>
            <th class="text-center">مجله</th>
            <th width="10%" class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($volumes as $volume)
            <tr>
                <td class="text-center">{{ $loop->index+1 }}</td>
                <td class="text-center">{{ $volume->name }}</td>
                <td class="text-center">{{ $volume->cat()->first()->name }}</td>
                <td class="text-center">{{ $volume->cat()->first()->magazine->name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/volumes/edit/{{ $volume->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="بالا ببر" href="/dashboard/volumes/up/{{ $volume->id }}"><i class="fa fa-chevron-up"></i></a>
                    <a title="پایین بیار" href="/dashboard/volumes/down/{{ $volume->id }}"><i class="fa fa-chevron-down"></i></a>
                    <a title="حذف" href="/dashboard/volumes/delete/{{ $volume->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
