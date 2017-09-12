@extends('layouts.dashboard_app')

@section('content_title')
    مدیریت کاربران
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">نام</th>
            <th width="10%" class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ $user->last_name }}</td>
                <td class="text-center">
                    <a title="ویرایش" href="/dashboard/users/edit/{{ $user->id }}"><i class="fa fa-pencil-square"></i></a>
                    <a title="حذف" href="/dashboard/users/delete/{{ $user->id }}"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
