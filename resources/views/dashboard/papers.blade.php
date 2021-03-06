@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت مقالات
    <a title="افزودن مقاله جدید" href="/dashboard/papers/new"><i class="fa fa-plus-square"></i></a>
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center" width="10%">ترتیب</th>
            <th class="text-center">عنوان</th>
            <th class="text-center">مجله</th>
            <th class="text-center">دسته</th>
            <th class="text-center">شماره</th>
            <th width="10%" class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($papers as $paper)
            <tr>
                <td class="text-center">{{ $loop->index+1 }}</td>
                <td class="text-center">{{ $paper->title }}</td>
                <td class="text-center">{{ $paper->volume()->first()->cat()->first()->magazine->name }}</td>
                <td class="text-center">{{ $paper->volume()->first()->cat()->first()->name }}</td>
                <td class="text-center">{{ $paper->volume()->first()->name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/papers/edit/{{ $paper->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="بالا ببر" href="/dashboard/papers/up/{{ $paper->id }}"><i class="fa fa-chevron-up"></i></a>
                    <a title="پایین بیار" href="/dashboard/papers/down/{{ $paper->id }}"><i class="fa fa-chevron-down"></i></a>
                    <a title="حذف" href="/dashboard/papers/delete/{{ $paper->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
