@foreach($books as $book)
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