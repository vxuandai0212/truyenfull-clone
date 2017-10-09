@extends('cmsLayouts.master')

@section('title')
<title>Authors</title>
@endsection

@section('container')
<div class="container">

      <div class="starter-template">
      <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href='/home'>Home</a></li>
        <li class='breadcrumb-item active'>Authors</li>
    </ol>

    <h2>Authors</h2>

    <hr/>

    @if($contents->count() > 0)

        <table class="table table-hover table-bordered table-striped">

         <thead>
         <th>#</th>
         <th>Name</th>
         <th>Edit</th>
         <th>Delete</th>
         </thead>

            <tbody>

            @foreach($contents as $content)

                <tr>
                    <th scope="row">{{ $i++ }}</td>
                    <td>{{ $content->author_name }}</td>
                    <td> <a href="/authors/{{ $content->id }}/edit">
                         <button type="button" class="btn btn-default">Edit</button></a>
                    </td>
                    <td>

                    <div class="form-group">

                        <form class="form" role="form" method="POST" action="{{ url('/authors/'. $content->id) }}">
                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}

                            <input class="btn btn-danger" Onclick="return ConfirmDelete();" type="submit" value="Delete">

                        </form>
                    </div>

                    </td>
                    
                </tr>

                @endforeach

            </tbody>

        </table>

    @else

    Sorry, no {{ $title }}

    @endif
    {{ $contents->links() }}
    <div>
<a href="/authors/create">
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