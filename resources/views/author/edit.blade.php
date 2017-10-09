@extends('cmsLayouts.master')

@section('title')
<title>{{$title}}</title>
@endsection

@section('container')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Home</a></li>
<li class="breadcrumb-item">Authors</li>
<li class="breadcrumb-item active">Edit</li>
</ol>

<h2>Edit an author</h2>

</hr>

<form class="form" role="form" method="POST" action="{{ url('/authors/'. $content->id) }}">
{{ method_field('PATCH') }}

    {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label">Author Name</label>
            <input required type="text" class="form-control" name="author_name" value="{{ $content->author_name }}">
        </div>


        <div class="form-group">

            <button type="submit" class="btn btn-primary btn-lg">

                Edit

            </button>

        </div>

    </form>
</div>
@endsection
