<div id="hotbook-list" class="list list-truyen list-side col-xs-12">
@foreach($hotbooks as $hotbook)
    <?php $z++ ?>
    <div class="row top-item" itemscope itemtype="http://schema.org/Book">
        <div class="col-xs-12">
            <div class="top-num top-{{$z}}">{{$z}}</div>
                <div class="s-title">
                    <h3 itemprop="name"><a href="{{$hotbook->slug}}" title="{{$hotbook->book_name}}" itemprop="url">{{$hotbook->book_name}}</a></h3></div>
                <div>
                    @foreach($hotbook->genders as $gender)
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