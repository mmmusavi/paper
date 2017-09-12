@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت وابستگی‌ها
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
        @foreach ($affiliations as $affiliation)
            <tr>
                <td class="text-center">{{ $affiliation->name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/affiliations/edit/{{ $affiliation->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="حذف" href="/dashboard/affiliations/delete/{{ $affiliation->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
