@extends('guestLayouts.master')

@section('title')
<title>Tác giả {{$author->author_name}}</title>
@endsection

@section('breadcrumb')
<div class="navbar-breadcrumb">
<div class="container breadcrumb-container">
    <ol class="breadcrumb">
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{route('home')}}" accesskey="1"><span class="glyphicon glyphicon-home"></span></a><a href="{{route('home')}}" title="Đọc truyện online" itemprop="url"><span itemprop="title">Truyện</span></a></li>
        <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <h1><a href="{{route('author', ['author_slug' => $author->slug])}}" title="{{$author->author_name}}" itemprop="url"><span itemprop="title">{{$author->author_name}}</span></a></h1></li>
    </ol>
</div>
</div>
@endsection

@section('content')
        <div class="container" id="list-page">
            <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                <div class="list list-truyen col-xs-12">
                    <div class="title-list">
                        <h2>Tác giả {{$author->author_name}}</h2>
                        <div class="filter">
                            <a href="{{route('author', ['author_slug' => $author->slug])}}"></a>
                        </div>
                    </div>
                    @foreach($books as $book)
                   
                    <div class="row" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-3">
                        <div>
                        <img style="margin:-65% 0px -65% 0px;" src="/images/{{$book->image}}" class="cover" alt="{{$book->book_name}}">
                        </div>
                        </div>
                        <div class="col-xs-7">
                            <div><span class="glyphicon glyphicon-book"></span>
                                <h3 class="truyen-title" itemprop="name"><a href="{{route('book', ['book_slug' => $book->slug])}}" title="{{$book->book_name}}" itemprop="url">{{$book->book_name}}</a></h3><span class="label-title label-new"></span><span class="label-title label-full"></span><span class="author" itemprop="author"><span class="glyphicon glyphicon-pencil"></span> {{$author->author_name}}</span>
                            </div>
                        </div> 
                        
                        
                        <div class="col-xs-2 text-info">
                            @foreach($book->chapters as $chapter) 
                            @if($loop->last)
                            <div><a href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $chapter->slug]) }}" title="{{$book->book_name}} - {{$chapter->chapter_number}}"><span class="chapter-text"><span>{{$chapter->chapter_number}}</span></a></div>
                            @endif
                            @endforeach
                        </div>
                      
                    </div>
                    
                    @endforeach
                </div>
            </div>
            <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
                <div class="panel cat-desc text-left">
                    <div class="panel-body">Danh sách truyện của tác giả {{$author->author_name}}</div>
                </div>
                <div class="list list-truyen list-cat col-xs-12">
                    <div class="title-list">
                        <h4>Thể loại truyện</h4></div>
                    <div class="row">
                        @foreach($genders as $gender)
                        <div class="col-xs-6"><a href="{{ route('genre', ['genre_slug' => $gender->slug]) }}" title="Truyện {{$gender->gender_name}}">{{$gender->gender_name}}</a></div>
                        @endforeach
                    </div>
                </div>
                <div class="ads-300-250"></div>
                <div class="list list-truyen list-side col-xs-12">
            <div class="title-list">
                <h4>Truyện đang hot</h4>
            </div>
            <div class="row top-nav" data-limit="10">
                <div id="hotday" class="col-xs-4 active" data-type="day">Ngày</div>
                <div id="hotmonth" class="col-xs-4" data-type="month">Tháng</div>
                <div id="hotalltime" class="col-xs-4" data-type="all">All time</div>
            </div>
        </div>
        <div id="hotbook-list" class="list list-truyen list-side col-xs-12">
            @foreach($hotbooks as $book)
            <?php $z++ ?>
            <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                <div class="col-xs-12">
                    <div class="top-num top-{{$z}}">{{$z}}</div>
                    <div class="s-title">
                        <h3 itemprop="name"><a href="{{route('book', ['book_slug' => $book->slug])}}" title="{{$book->book_name}}" itemprop="url">{{$book->book_name}}</a></h3></div>
                    <div>
                    @foreach($book->genders as $gender)
                        @if($loop->last)                             
                        <a itemprop="genre" href="/the-loai/{{$gender->slug}}/" title="{{$gender->gender_name}}">{{$gender->gender_name}}</a>
                        @else
                        <a itemprop="genre" href="/the-loai/{{$gender->slug}}/" title="{{$gender->gender_name}}">{{$gender->gender_name}}</a>,
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            </div>
        </div>
@endsection
