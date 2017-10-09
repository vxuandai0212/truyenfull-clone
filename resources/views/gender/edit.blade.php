@extends('cmsLayouts.master')

@section('title')
<title>{{$title}}</title>
@endsection

@section('container')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Home</a></li>
<li class="breadcrumb-item">Genders</li>
<li class="breadcrumb-item active">Edit</li>
</ol>

<h2>Edit a gender</h2>

</hr>

<form class="form" role="form" method="POST" action="{{ url('/genders/'. $content->id) }}">
{{ method_field('PATCH') }}

    {{ csrf_field() }}

        <div class="form-group">
            <label class="control-label">Gender Name</label>
            <input required type="text" class="form-control" name="gender_name" value="{{ $content->gender_name }}">

            <label class="control-label">Gender Description</label></br>
            <textarea rows="10" required class="form-control" name="gender_description">{{ $content->gender_description }}</textarea>

        </div>


        <div class="form-group">

            <button type="submit" class="btn btn-primary btn-lg">

                Edit

            </button>

        </div>

    </form>
</div>
@endsection
