@extends('cmsLayouts.master')

@section('title')
<title>Add an Author</title>
@endsection

@section('container')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Home</a></li>
<li class="breadcrumb-item">Authors</li>
<li class="breadcrumb-item active">Create</li>
</ol>

<h2>Create an author</h2>

</hr>

<form class="form" role="form" method="POST" action="{{ url('/authors') }}">

    {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label">Author Name</label>
            <input required type="text" class="form-control" name="author_name" value="{{ old('author_name') }}">
        </div>


        <div class="form-group">

            <button type="submit" class="btn btn-primary btn-lg">

                Create

            </button>

        </div>

    </form>
</div>
@endsection