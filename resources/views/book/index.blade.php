@extends('cmsLayouts.master')

@section('title')
<title>{{$title}}</title>
@endsection

@section('container')
<div class="container">

      <div class="starter-template">
      <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href='/home'>Home</a></li>
        <li class='breadcrumb-item active'>{{$title}}</li>
    </ol>

    <h2>{{$title}}</h2>

    <hr/>

    @if($books->count() > 0)
        @foreach($books as $book)
        <figure class="figure">
            <a href="/books/{{$book->id}}/edit">    
            <img src="/images/{{$book->image}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
            <figcaption class="figure-caption text-center">{{$book->book_name}}</figcaption>
        </figure>
        @endforeach
      
    @else

    Sorry, no {{ $title }}

    @endif
  
    <div>
<a href="/books/create">
<button type="button"
class="btn btn-lg btn-primary">
Create New
</button>
</a>
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