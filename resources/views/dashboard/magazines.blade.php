@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت مجله‌ها
    <a title="افزودن مجله جدید" href="/dashboard/magazines/new"><i class="fa fa-plus-square"></i></a>
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center" width="10%">ترتیب</th>
            <th class="text-center">عنوان</th>
            <th width="10%" class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($magazines as $volume)
            <tr>
                <td class="text-center">{{ $loop->index+1 }}</td>
                <td class="text-center">{{ $volume->name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/magazines/edit/{{ $volume->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="بالا ببر" href="/dashboard/magazines/up/{{ $volume->id }}"><i class="fa fa-chevron-up"></i></a>
                    <a title="پایین بیار" href="/dashboard/magazines/down/{{ $volume->id }}"><i class="fa fa-chevron-down"></i></a>
                    <a title="حذف" href="/dashboard/magazines/delete/{{ $volume->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
