@if(empty($lastVol))
    @if(empty($lastPapers))
        @php($lastPapers=\App\Paper::orderBy('place','desc')->take(10)->get())
    @endif
@else
        @php($lastPapers=$lastVol->papers()->orderBy('place','desc')->get())
@endif

<div class="panel panel-default">
    <div class="panel-heading">@if(!empty($title)){!! $title !!}@endif @if(!empty($lastVol))<span class="bold">{{ $lastVolCat->magazine->name }}، {{ $lastVolCat->name }}، {{ $lastVol->name }}، {{ $lastVol->desc }}</span>@endif</div>
    <div class="panel-body">
        @if(count($lastPapers)==0)
            <p>موردی یافت نشد.</p>
        @endif
        @foreach($lastPapers as $lastPaper)
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>@if(0){{ta_persian_num($loop->index+1)}}- @endif<span class="bold">{{$lastPaper->title}}</span></p>
                    <p>{{$lastPaper->volume()->first()->cat()->first()->magazine->name}}، {{$lastPaper->volume()->first()->cat()->first()->name}}، {{$lastPaper->volume()->first()->name}}</p>
                    @if(!empty($lastPaper->page))<p>صفحات {{ta_persian_num($lastPaper->page)}}</p>@endif
                    @php
                        $authors=$lastPaper->authors_order;
                        $authors=substr($authors,0,strlen($authors)-1);
                        $authors=explode(';',$authors);
                    @endphp
                    <p>
                        @foreach($authors as $author_number)
                            @if(!empty($author_number))
                                @php
                                    $author=App\User::find($author_number);
                                @endphp
                                {{$author->last_name}}@if(!$loop->last) ; @endif
                            @endif
                        @endforeach
                    </p>
                    <p>
                        <a class="btn btn-default" href="/paper/{{$lastPaper->id}}"><i class="fa fa-file-text"></i> مشاهده مقاله</a>
                        @if(0)<a class="btn btn-success" href="/addtocart/{{$lastPaper->id}}"><i class="fa fa-shopping-cart"></i> خرید مقاله</a>@endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>