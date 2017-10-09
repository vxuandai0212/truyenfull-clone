@extends('guestLayouts.master')

@section('title')
<title>{{$mainTitle}}</title>
@endsection

@section('breadcrumb')
<div class="navbar-breadcrumb">
<div class="container breadcrumb-container">
    <ol class="breadcrumb">
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{route('home')}}" accesskey="1"><span class="glyphicon glyphicon-home"></span></a><a href="{{route('home')}}" title="Đọc truyện online" itemprop="url"><span itemprop="title">Truyện</span></a></li>
        <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <h1><a href="{{$route}}" title="{{$title}}" itemprop="url"><span itemprop="title">{{$title}}</span></a></h1></li>
    </ol>
</div>
</div>
@endsection

@section('content')
        <div class="container" id="list-page">
            <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                <div class="list list-truyen col-xs-12">
                    <div class="title-list">
                        <h2>{{$title}}</h2>
                        <div class="filter">
                            <a href="{{$route}}"></a>
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
                                <h3 class="truyen-title" itemprop="name"><a href="{{route('book', ['book_slug' => $book->slug])}}" title="{{$book->book_name}}" itemprop="url">{{$book->book_name}}</a></h3><span class="label-title label-new"></span><span class="label-title label-full"></span><span class="author" itemprop="author"><span class="glyphicon glyphicon-pencil"></span> </span>
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
                    <div class="panel-body">{{$description}}</div>
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
                        <h4>Truyện đang hot</h4></div>
                    <div class="row top-nav" data-limit="10">
                        <div class="col-xs-4 active" data-type="day">Ngày</div>
                        <div class="col-xs-4" data-type="month">Tháng</div>
                        <div class="col-xs-4" data-type="all">All time</div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-1">1</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/truyen-choc-tuc-vo-yeu-mua-mot-tang-mot/" title="Chọc Tức Vợ Yêu - Mua Một Tặng Một" itemprop="url">Chọc Tức Vợ Yêu - Mua Một Tặng Một</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/ngon-tinh/" title="Ngôn Tình">Ngôn Tình</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/hai-huoc/" title="Hài Hước">Hài Hước</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/sung/" title="Sủng">Sủng</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-2">2</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/linh-vu-thien-ha/" title="Linh Vũ Thiên Hạ" itemprop="url">Linh Vũ Thiên Hạ</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/tien-hiep/" title="Tiên Hiệp">Tiên Hiệp</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/di-gioi/" title="Dị Giới">Dị Giới</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-3">3</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/van-co-chi-ton/" title="Vạn Cổ Chí Tôn" itemprop="url">Vạn Cổ Chí Tôn</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-4">4</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/hon-sai-55-lan/" title="Hôn Sai 55 Lần" itemprop="url">Hôn Sai 55 Lần</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/ngon-tinh/" title="Ngôn Tình">Ngôn Tình</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-5">5</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/truyen-than-khong-thien-ha/" title="Thần Khống Thiên Hạ" itemprop="url">Thần Khống Thiên Hạ</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/tien-hiep/" title="Tiên Hiệp">Tiên Hiệp</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/di-gioi/" title="Dị Giới">Dị Giới</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-6">6</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/boss-hung-du-ong-xa-ket-hon-di/" title="Boss Hung Dữ - Ông Xã Kết Hôn Đi" itemprop="url">Boss Hung Dữ - Ông Xã Kết Hôn Đi</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/ngon-tinh/" title="Ngôn Tình">Ngôn Tình</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-7">7</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/dai-chua-te/" title="Đại Chúa Tể" itemprop="url">Đại Chúa Tể</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/tien-hiep/" title="Tiên Hiệp">Tiên Hiệp</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/di-gioi/" title="Dị Giới">Dị Giới</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-8">8</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/de-ba/" title="Đế Bá" itemprop="url">Đế Bá</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-9">9</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/pham-nhan-tu-tien/" title="Phàm Nhân Tu Tiên" itemprop="url">Phàm Nhân Tu Tiên</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/tien-hiep/" title="Tiên Hiệp">Tiên Hiệp</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/kiem-hiep/" title="Kiếm Hiệp">Kiếm Hiệp</a></div>
                        </div>
                    </div>
                    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-xs-12">
                            <div class="top-num top-10">10</div>
                            <div class="s-title">
                                <h3 itemprop="name"><a href="http://truyenfull.vn/dau-pha-thuong-khung/" title="Đấu Phá Thương Khung" itemprop="url">Đấu Phá Thương Khung</a></h3></div>
                            <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/tien-hiep/" title="Tiên Hiệp">Tiên Hiệp</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/di-gioi/" title="Dị Giới">Dị Giới</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
                        </div>
                    </div>
                </div>
                <div class="ads-300-600"></div>
            </div>
        </div>
        <div class="container text-center pagination-container">
            <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                <ul class="pagination pagination-sm">
                   {{$books->links()}}
                </ul>
            </div>
        </div>
@endsection