@extends('cmsLayouts.master')

@section('title')
<title>{{$book->book_name}}</title>
@endsection

@section('container')
<div class="container">

      <div class="starter-template">
         <ol class='breadcrumb'>
             <li class="breadcrumb-item"><a href='/home'>Home</a></li>
             <li class='breadcrumb-item active'>{{$book->book_name}}</li>
         </ol>

      <h2>{{$book->book_name}}</h2>

      <hr/>
    
      <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                <div class="col-xs-12 col-info-desc" itemscope itemtype="http://schema.org/Book">
           
                        <a href="/books/{{ $book->id }}/edit">
                        <button type="button" class="btn btn-default">Edit</button>
                        </a>
                        <form class="form" role="form" method="POST" action="{{ url('/books/'. $book->id) }}">
                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}
                            <input class="btn btn-danger" Onclick="return ConfirmDelete();" type="submit" value="Delete">
                        </form>               
             
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
                                <a itemprop="author" href="/authors/{{$author->author_name}}" title="{{$author->author_name}}">{{$author->author_name}}</a>
                                @endforeach
                            </div>
                            <div>
                                <h3>Thể loại:</h3>
                                @foreach($book->genders as $gender)
                                <a itemprop="genre" href="/genders/{{$gender->gender_name}}" title="{{$gender->gender_name}}">{{$gender->gender_name}}</a>
                                @endforeach
                            </div>
                            <div>
                                <h3>Nguồn:</h3><span class="source">{{$book->source}}</span></div>
                            <div>
                                <h3>Trạng thái:</h3>
                                <span class="text-success">
                                @if (($book->status) === 1)
                                    Full
                                @else
                                    Đang ra
                                @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 desc">
                        <h3 class="title" itemprop="name">{{$book->book_name}}</h3>
                        <div class="desc-text desc-text-full" itemprop="description">{{$book->description}}</div>
                    </div>
                </div>
                <div class="col-xs-12" id="list-chapter">
                    <div class="title-list">
                        <h2>Danh sách chương</h2></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <ul class="list-chapter">
                                @foreach($book->chapters as $chapter)
                                <li><span class="glyphicon glyphicon-certificate"></span> <a href="/books/{{$book->book_name}}/{{$chapter->chapter_name}}" title="{{$book->book_name}} - {{$chapter->chapter_number}}: {{$chapter->chapter_name}}"><span class="chapter-text"><span>{{$chapter->chapter_number}}: {{$chapter->chapter_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                  
                </div>
            </div>
  

      </div>

</div><!-- /.container -->
@endsection

@section('script')
<script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x){

                return true;
            } else {

                return false;
            }

        }
    </script>
@endsection

        
    
