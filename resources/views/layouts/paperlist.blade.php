@php($lastPapers=$lastVol->papers()->orderBy('place','desc')->get())
<div class="panel panel-default">
    <div class="panel-heading">@if(!empty($title)){{$title}}@endif<span class="bold">{{ $lastVolCat->name }}، {{ $lastVol->name }}، {{ $lastVol->desc }}</span></div>
    <div class="panel-body">
        @foreach($lastPapers as $lastPaper)
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>{{ta_persian_num($loop->index+1)}}- <span class="bold">{{$lastPaper->title}}</span></p>
                    <p>{{ta_persian_num($lastPaper->page)}}</p>
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
                        <a class="btn btn-default" href="/paper/{{$lastPaper->id}}"><i class="fa fa-link"></i> مشاهده مقاله</a>
                        <a class="btn btn-success" href="/addtocart/{{$lastPaper->id}}"><i class="fa fa-shopping-cart"></i> خرید مقاله</a>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>