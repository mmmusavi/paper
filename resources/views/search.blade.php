@extends('layouts.app')
@section('searchbar')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/search') }}">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-size: 20px;line-height: 40px;" for="search" class="col-md-2 control-label">جستجو:</label>

                            <div class="col-md-9">
                                <input style="height: 55px;font-size: 20px;"
                                       id="search" type="text"
                                       class="form-control"
                                       name="search"
                                       placeholder="عبارت مورد نظر را وارد کنید و کلید اینتر را فشار دهید."
                                       @if(!empty($req))value="{{$req}}"@endif>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-md-9">
    @include('layouts.paperlist',['lastPapers'=>$lastPapers,'title'=>'جستجوی عبارت: <span class="bold">'.$req.'</span>'])
</div>
@endsection
