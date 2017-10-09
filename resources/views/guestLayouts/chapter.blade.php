@extends('guestLayouts.master')

@section('title')
<title>{{$chapter->book->book_name}} - {{$chapter->chapter_number}}: {{$chapter->chapter_name}}</title>
@endsection

@section('breadcrumb')
<div class="navbar-breadcrumb">
<div class="container breadcrumb-container">
    <ol class="breadcrumb">
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ route('home') }}" accesskey="1"><span class="glyphicon glyphicon-home"></span></a><a href="{{ route('home') }}" title="Đọc truyện online" itemprop="url"><span itemprop="title">Truyện</span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <h1><a href="{{ route('book', ['book_slug' => $chapter->book->slug]) }}" title="{{$chapter->book->book_name}}" itemprop="url"><span itemprop="title">{{$chapter->book->book_name}}</span></a></h1></li>
        <li class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ route('chapter', ['book_slug' => $chapter->book->slug, 'chapter_slug' => $chapter->slug]) }}" title="{{$chapter->chapter_number}}" itemprop="url"><span itemprop="title">{{$chapter->chapter_number}}</span></a></li>
    </ol>
</div>
</div>
@endsection

@section('content')
        <div class="container chapter">
            <div class="row">
                <div class="col-xs-12">
                    <button type="button" class="btn btn-responsive btn-success toggle-nav-open"><span class="glyphicon glyphicon-menu-up"></span></button><a class="truyen-title" href="{{ route('book', ['book_slug' => $book->slug]) }}" title="{{$book->book_name}}">{{$book->book_name}}</a>
                    <h2><a class="chapter-title" href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $chapter->slug]) }}" title="{{$book->book_name}} - {{$chapter->chapter_number}}: {{$chapter->chapter_name}}"><span class="chapter-text">{{$chapter->chapter_number}}: {{$chapter->chapter_name}}</span></a></h2>
                    <hr class="chapter-start">
                    <div class="chapter-nav" id="chapter-nav-top">
                    <div class="btn-group">
                    
                    @if($previous == null)
                    <a class="btn btn-success disabled" href="javascript:void(0)" title="Không có chương trước" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
                    @else
                    <a class="btn btn-success" href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $previous->slug]) }}" title="{{$previous->chapter_number}}" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
                    @endif
                    @if($next == null)
                    <a class="btn btn-success disabled" href="javascript:void(0)" title="Không hoặc chưa có chương tiếp theo" id="next_chap"><span class="hidden-xs">Chương </span>tiếp <span class="glyphicon glyphicon-chevron-right"></span></a>
                    @else
                            <button type="button" class="btn btn-success chapter_jump"><span class="glyphicon glyphicon-list-alt"></span></button>
                            <a class="btn btn-success" href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $next->slug]) }}" title="{{$next->chapter_number}}" id="next_chap"><span class="hidden-xs">Chương </span>tiếp <span class="glyphicon glyphicon-chevron-right"></span></a></div>
                    @endif
                    </div>
                  
                    <hr class="chapter-end">
                    <div class="hidden-xs text-center ads-holder ads-728-90-holder">
                        <div class="ads-780-90-chapter-1"></div>
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg text-center w320 ads-holder">
                        <div class="ads-320-100-backup-1 ads-holder"></div>
                    </div>
                    <div class="chapter-c">{!!$chapter->chapter_content!!}</div>
                    <div class="hidden-xs text-center ads-holder">
                        <div class="ads-780-90-chapter-2"></div>
                    </div>
                    <div class="hidden-sm hidden-md hidden-lg text-center w320 ads-holder">
                        <div class="ads-320-100-backup-2 ads-holder"></div>
                    </div>
                    <hr class="chapter-end">
                    <div class="chapter-nav" id="chapter-nav-bot"></div>
                    <div class="btn-group">
                    
                    @if($previous == null)
                    <a class="btn btn-success disabled" href="javascript:void(0)" title="Không có chương trước" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
                    @else
                    <a class="btn btn-success" href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $previous->slug]) }}" title="{{$previous->chapter_number}}" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
                    @endif
                    @if($next == null)
                    <a class="btn btn-success disabled" href="javascript:void(0)" title="Không hoặc chưa có chương tiếp theo" id="next_chap"><span class="hidden-xs">Chương </span>tiếp <span class="glyphicon glyphicon-chevron-right"></span></a>
                    @else
                            <button type="button" class="btn btn-success chapter_jump"><span class="glyphicon glyphicon-list-alt"></span></button>
                            <a class="btn btn-success" href="{{ route('chapter', ['book_slug' => $book->slug, 'chapter_slug' => $next->slug]) }}" title="{{$next->chapter_number}}" id="next_chap"><span class="hidden-xs">Chương </span>tiếp <span class="glyphicon glyphicon-chevron-right"></span></a></div>
                    @endif
                    </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-warning" id="chapter_error"><span class="glyphicon glyphicon-exclamation-sign"></span> Báo lỗi chương</button>
                            <button type="button" class="btn btn-info" id="chapter_comment"><span class="glyphicon glyphicon-comment"></span> Bình luận</button>
                        </div>
                        <div class="bg-info text-center visible-md visible-lg box-notice">Bạn có thể dùng phím mũi tên hoặc WASD để lùi/sang chương.</div>
                        <div class="col-xs-12">
                            <div class="row" id="fb-comment-chapter"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection