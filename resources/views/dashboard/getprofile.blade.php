@if(!empty($users))
@foreach ($users as $user)
<a href="#" class="user_select" data-userid="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}({{$user->email}})</a><br>
@endforeach
@else  موردی پیدا نشد
@endif