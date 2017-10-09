@extends('guestLayouts.master')

@section('title')
<title>Đọc truyện online, đọc truyện hay</title>
@endsection

@section('breadcrumb')
<div class="navbar-breadcrumb">
    <div class="container breadcrumb-container"> Đọc truyện online, đọc truyện chữ, truyện full, truyện hay. Tổng hợp đầy đủ và cập nhật liên tục. </div>
</div>
@endsection

@section('content')
<div class="container visible-md-block visible-lg-block" id="intro-index">
            <div class="title-list">
                <h2><a href="/danh-sach/truyen-hot/" title="Truyện hot">Truyện hot</a></h2><a href="/danh-sach/truyen-hot/" title="Truyện hot"><span class="glyphicon glyphicon-fire"></span></a>
                <select id="hot-select" class="form-control new-select">
                    <option value="all">Tất cả</option>
                    <option value="1">Tiên Hiệp</option>
                    <option value="2">Kiếm Hiệp</option>
                    <option value="3">Ngôn Tình</option>
                    <option value="4">Đô Thị</option>
                    <option value="20">Quan Trường</option>
                    <option value="6">Võng Du</option>
                    <option value="5">Khoa Huyễn</option>
                    <option value="8">Huyền Huyễn</option>
                    <option value="7">Dị Giới</option>
                    <option value="19">Dị Năng</option>
                    <option value="10">Quân Sự</option>
                    <option value="11">Lịch Sử</option>
                    <option value="15">Xuyên Không</option>
                    <option value="17">Trọng Sinh</option>
                    <option value="18">Trinh Thám</option>
                    <option value="16">Thám Hiểm</option>
                    <option value="9">Linh Dị</option>
                    <option value="12">Sắc</option>
                    <option value="30">Ngược</option>
                    <option value="36">Sủng</option>
                    <option value="21">Cung Đấu</option>
                    <option value="22">Nữ Cường</option>
                    <option value="24">Gia Đấu</option>
                    <option value="23">Đông Phương</option>
                    <option value="13">Đam Mỹ</option>
                    <option value="14">Bách Hợp</option>
                    <option value="25">Hài Hước</option>
                    <option value="27">Điền Văn</option>
                    <option value="28">Cổ Đại</option>
                    <option value="29">Mạt Thế</option>
                    <option value="26">Truyện Teen</option>
                    <option value="32">Tiểu Thuyết Phương Tây</option>
                    <option value="33">Nữ Phụ</option>
                    <option value="34">Light Novel</option>
                    <option value="35">Văn học Việt Nam</option>
                    <option value="37">Đoản Văn</option>
                    <option value="31">Khác</option>
                </select>
            </div>
            <div class="index-intro">
            @foreach($hotBooks as $book)
            @if($loop->first)
            <div class="item top-1" itemscope itemtype="http://schema.org/Book">
                <a href="{{$book->slug}}" itemprop="url">
                <span class="full-label"></span>
                <img src="/images/{{$book->image}}" dalt="{{$book->book_name}}" class="img-responsive item-img" itemprop="image">
                <div class="title">
                <h3 itemprop="name">{{$book->book_name}}</h3>
                </div>
                </a>
            </div>
            @else
            <div class="item top-2" itemscope itemtype="http://schema.org/Book">
                <a href="{{$book->slug}}" itemprop="url">
                <img src="/images/{{$book->image}}" dalt="{{$book->book_name}}" class="img-responsive item-img" itemprop="image">
                <div class="title">
                <h3 itemprop="name">{{$book->book_name}}</h3>
                </div>
                </a>
            </div>
            @endif
            @endforeach
            </div>
        </div>
        <div class="container" id="list-index">
            <div class="row text-center"></div>
            <div class="hide" id="history-holder"></div>
            <div class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">
                <div class="title-list">
                    <h2><a href="/danh-sach/truyen-moi/" title="Truyện mới">Truyện mới cập nhật</a></h2><a href="/danh-sach/truyen-moi/" title="Truyện mới"><span class="glyphicon glyphicon-menu-right"></span></a>
                    <select id="new-select" class="form-control new-select">
                        <option value="all">Tất cả</option>
                        <option value="1">Tiên Hiệp</option>
                        <option value="2">Kiếm Hiệp</option>
                        <option value="3">Ngôn Tình</option>
                        <option value="4">Đô Thị</option>
                        <option value="20">Quan Trường</option>
                        <option value="6">Võng Du</option>
                        <option value="5">Khoa Huyễn</option>
                        <option value="8">Huyền Huyễn</option>
                        <option value="7">Dị Giới</option>
                        <option value="19">Dị Năng</option>
                        <option value="10">Quân Sự</option>
                        <option value="11">Lịch Sử</option>
                        <option value="15">Xuyên Không</option>
                        <option value="17">Trọng Sinh</option>
                        <option value="18">Trinh Thám</option>
                        <option value="16">Thám Hiểm</option>
                        <option value="9">Linh Dị</option>
                        <option value="12">Sắc</option>
                        <option value="30">Ngược</option>
                        <option value="36">Sủng</option>
                        <option value="21">Cung Đấu</option>
                        <option value="22">Nữ Cường</option>
                        <option value="24">Gia Đấu</option>
                        <option value="23">Đông Phương</option>
                        <option value="13">Đam Mỹ</option>
                        <option value="14">Bách Hợp</option>
                        <option value="25">Hài Hước</option>
                        <option value="27">Điền Văn</option>
                        <option value="28">Cổ Đại</option>
                        <option value="29">Mạt Thế</option>
                        <option value="26">Truyện Teen</option>
                        <option value="32">Tiểu Thuyết Phương Tây</option>
                        <option value="33">Nữ Phụ</option>
                        <option value="34">Light Novel</option>
                        <option value="35">Văn học Việt Nam</option>
                        <option value="37">Đoản Văn</option>
                        <option value="31">Khác</option>
                    </select>
                </div>
                @foreach($recentUpdateBooks as $book)
                <div class="row" itemscope itemtype="http://schema.org/Book">
                    <div class="col-xs-9 col-sm-6 col-md-5 col-title"><span class="glyphicon glyphicon-chevron-right"></span>
                        <h3 itemprop="name"><a href="{{route('book', ['book_slug' => $book->slug])}}" title="{{$book->book_name}}" itemprop="url">{{$book->book_name}}</a></h3></div>
                    <div class="hidden-xs col-sm-3 col-md-3 col-cat text-888">
                    @foreach($book->genders as $genre)
                    <a itemprop="genre" href="{{route('genre', ['genre_slug' => $genre->slug])}}" title="{{$genre->gender_name}}">{{$genre->gender_name}}</a>
                    @endforeach
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-2 col-chap text-info"> 
                    @foreach($book->chapters as $chapter) 
                        @if($loop->last)
                        <a href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $chapter->slug]) }}" title="{{$book->book_name}} - {{$chapter->chapter_number}}"><span class="chapter-text"><span>{{$chapter->chapter_number}}</span></span></a>
                        @endif
                    @endforeach
                    </div>
                    <div class="hidden-xs hidden-sm col-md-2 col-time text-888">{{$book->updated_at->diffForHumans()}}</div>
                </div>
                @endforeach
            </div>
            <div class="visible-md-block visible-lg-block col-md-4 text-center col-truyen-side">
                <div class="hide" id="history-holder-side"></div>
                <div class="list list-truyen list-cat col-xs-12">
                    <div class="title-list">
                        <h4>Thể loại truyện</h4></div>
                    <div class="row">
                        @foreach($genders as $gender)
                        <div class="col-xs-6"><a href="{{ route('genre', ['genre_slug' => $gender->slug]) }}" title="Truyện {{$gender->gender_name}}">{{$gender->gender_name}}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="truyen-slide">
            <div class="list list-thumbnail col-xs-12">
                <div class="title-list">
                    <h2><a href="/danh-sach/truyen-full/" title="Truyện full">Truyện đã hoàn thành</a></h2><a href="/danh-sach/truyen-full/" title="Truyện full"><span class="glyphicon glyphicon-menu-right"></span></a></div>
                <div class="row">
                    @foreach($completeBooks as $book)
                    <div class="col-xs-4 col-sm-3 col-md-2">
                        <a href="{{$book->slug}}" title="{{$book->book_name}}">
                        <img width="164px" height="245px" src="/images/{{$book->image}}" class="undefined" alt="{{$book->book_name}}">                            
                        <div class="caption">
                                <h3>{{$book->book_name}}</h3><small class="btn-xs label-primary">Full - {{$book->chapters->count()}} chương</small></div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection