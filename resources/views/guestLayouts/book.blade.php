@extends('guestLayouts.master')

@section('title')
<title>{{$book->book_name}}</title>
@endsection

@section('breadcrumb')
<div class="navbar-breadcrumb">
                <div class="container breadcrumb-container">
                    <ol class="breadcrumb">
                        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ route('home') }}" accesskey="1"><span class="glyphicon glyphicon-home"></span></a><a href="{{route('home')}}" title="Đọc truyện online" itemprop="url"><span itemprop="title">Truyện</span></a></li>
                        <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                            <h1><a href="{{route('book', ['book_slug' => $book->slug])}}" title="{{$book->book_name}}" itemprop="url"><span itemprop="title">{{$book->book_name}}</span></a></h1></li>
                    </ol>
                </div>
            </div>
@endsection


@section('content')
<div class="container" id="truyen">
            <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                <div class="col-xs-12 col-info-desc" itemscope itemtype="http://schema.org/Book">
                    <div class="title-list book-intro">
                        <h2>Thông tin truyện</h2></div>
                    <div class="col-xs-12 col-sm-4 col-md-4 info-holder">
                        <div class="books">
                            <div class="book"><img src="/images/{{$book->image}}" alt="{{$book->book_name}}" itemprop="image"></div>
                        </div>
                        <div class="info">
                            <div>
                                <h3>Tác giả:</h3>
                                @foreach($book->authors as $author)
                                <?php $i++; ?>
                                <a itemprop="author" href="/tac-gia/{{$author->slug}}" title="{{$author->author_name}}">{{$author->author_name}}</a>
                                @if ($i != count($book->authors))
                                ,
                                @endif
                                @endforeach
                            </div>
                            <div>
                                <h3>Thể loại:</h3>
                                @foreach($book->genders as $gender)
                                <?php $j++ ?>
                                <a itemprop="genre" href="/the-loai/{{$gender->slug}}/" title="{{$gender->gender_name}}">{{$gender->gender_name}}</a>                               
                                @if ($j != count($book->genders))
                                ,
                                @endif
                                
                                @endforeach
                            </div>
                            <div>
                                <h3>Nguồn:</h3><span class="source">{{$book->source}}</span></div>
                            <div>
                                <h3>Trạng thái:</h3><span class="text-success">@if ($book->status == 0)Đang ra @else Full @endif</span></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 desc">
                        <h3 class="title" itemprop="name">{{$book->book_name}}</h3>
                        <div class="rate">
                            <div class="rate-holder" data-score="7.7"></div><em class="rate-text"></em>
                            <div class="small" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><em>Đánh giá: <strong><span itemprop="ratingValue">7.7</span></strong>/<span class="text-muted" itemprop="bestRating">10</span> từ <strong><span itemprop="ratingCount">210</span> lượt</strong></em></div>
                        </div>
                        <div class="desc-text desc-text-full" itemprop="description">
                        @if($book->category_description != null)
                        <b>Thể loại</b>: {{$book->category_description}}</br>
                        @endif
                        @if($book->beta != null)
                        <b>Beta</b>: {{$book->beta}}</br>
                        @endif
                        @if($book->editor != null)
                        <b>Editor</b>: {{$book->editor}}</br>
                        @endif
                        @if($book->translator != null)
                        <b>Translator</b>: {{$book->translator}}
                        @endif
                        </br>
                        </br>
                        @if($book->description != null)
                        {!!$book->description!!}
                        @endif
                        </br>
                        </br>
                        @if($book->other_description != null)
                        {{$book->other_description}}</br>
                        @endif
                        @if($book->character != null)
                        <b>Nhân vật</b>: {{$book->character}}
                        @endif
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="hidden-xs hidden-sm hidden-md">
                        <div class="ads-780-90"></div>
                    </div>
                    <div class="hidden-lg text-center w320">
                        <div class="ads-320-100-backup-2"></div>
                    </div>
                </div>
                <div class="col-xs-12" id="list-chapter">
                    <div class="title-list">
                        <h2>Danh sách chương</h2></div>
                    <div class="row">
                    @foreach($chapters->chunk(5) as $chunkedChapters)
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <ul class="list-chapter">
                            @foreach($chunkedChapters as $chapter)
                            <li><span class="glyphicon glyphicon-certificate"></span> <a href="{{$book->slug}}/{{$chapter->slug}}/" title="{{$book->book_name}} - {{$chapter->chapter_number}}: {{$chapter->chapter_name}}"><span class="chapter-text">{{$chapter->chapter_number}}</span>: {{$chapter->chapter_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                    
                    <ul class="pagination pagination-sm">

                    {{$chapters->links()}}

                    </ul>
                </div>
            </div>
            <div class="visible-md visible-lg">
            <div class="col-xs-12 comment-box">
                <div class="title-list">
                    <h2>Bình luận truyện</h2></div>
                <div class="fb-comments" data-href="http://truyenfull.vn/hon-sai-55-lan/" data-width="832" data-numposts="5" data-colorscheme="light"></div>
            </div>
        </div>
    </div>
    <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
        <div class="ads-300-250"></div>
        <div class="list list-truyen col-xs-12">
            <div class="title-list">
                <h4>Truyện cùng tác giả</h4></div>
            @foreach($sameAuthorBooks as $book) 
            <div class="row" itemscope itemtype="http://schema.org/Book">
                <div class="col-xs-12"><span class="glyphicon glyphicon-chevron-right"></span>
                    <h3 itemprop="name"><a href="{{$book->slug}}" title="{{$book->book_name}}" itemprop="url">{{$book->book_name}}</a></h3></div>
            </div>
            @endforeach
        </div>
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
                        <h3 itemprop="name"><a href="http://truyenfull.vn/truyen-ngon-tinh-choc-tuc-vo-yeu-mua-mot-tang-mot/" title="Chọc Tức Vợ Yêu - Mua Một Tặng Một" itemprop="url">Chọc Tức Vợ Yêu - Mua Một Tặng Một</a></h3></div>
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
                        <h3 itemprop="name"><a href="http://truyenfull.vn/pham-nhan-tu-tien/" title="Phàm Nhân Tu Tiên" itemprop="url">Phàm Nhân Tu Tiên</a></h3></div>
                    <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/tien-hiep/" title="Tiên Hiệp">Tiên Hiệp</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/kiem-hiep/" title="Kiếm Hiệp">Kiếm Hiệp</a></div>
                </div>
            </div>
            <div class="row top-item" itemscope itemtype="http://schema.org/Book">
                <div class="col-xs-12">
                    <div class="top-num top-9">9</div>
                    <div class="s-title">
                        <h3 itemprop="name"><a href="http://truyenfull.vn/de-ba/" title="Đế Bá" itemprop="url">Đế Bá</a></h3></div>
                    <div><a itemprop="genre" href="http://truyenfull.vn/the-loai/huyen-huyen/" title="Huyền Huyễn">Huyền Huyễn</a></div>
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
</div>
@endsection

@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
       $(document).on('click','.pagination a', function(e){
           e.preventDefault();
           var page = $(this).attr('href').split('page=')[1];
           getPosts(page);
       });
 
       function getPosts(page)
       {
           $.ajax({
               type: "GET",
               url: '?page='+ page
           })
           .done(function(data) {
               $('body').html(data);
           });
       }
  </script>
@endsection
