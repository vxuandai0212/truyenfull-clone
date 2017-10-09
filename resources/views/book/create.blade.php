@extends('cmsLayouts.master')

@section('title')
<title>Add a Book</title>
@endsection

@section('container')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Home</a></li>
<li class="breadcrumb-item">Books</li>
<li class="breadcrumb-item active">Create</li>
</ol>

<h2>Create a book</h2>

</hr>

<form class="form" role="form" method="POST" action="{{ url('/books') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

        <div class="form-group">
            <label class="custom-file">
            <input type="file" class="form-control" id="file" name="image">
            </label></br>

            <label class="control-label">Name</label>
            <input required type="text" class="form-control" name="book_name" value="{{ old('book_name') }}">

            <label class="control-label">Description</label></br>
            <textarea required class="form-control" name="book_description">{{ old('book_description') }}</textarea>

            <label class="control-label">Status</label></br>
            <label class="radio-inline">
                 <input type="radio" name="status" value="0" checked>Updating
            </label>
            <label class="radio-inline">
                 <input type="radio" name="status" value="1">Complete
            </label>
            </br>

            <label class="control-label">Source</label>
            <input type="text" class="form-control" name="source" value="{{ old('source') }}">

            <label class="control-label">Category</label>
            <input type="text" class="form-control" name="category" value="{{ old('category') }}">

            <label class="control-label">Beta</label>
            <input type="text" class="form-control" name="beta" value="{{ old('beta') }}">

            <label class="control-label">Editor</label>
            <input type="text" class="form-control" name="editor" value="{{ old('editor') }}">

            <label class="control-label">Translator</label>
            <input type="text" class="form-control" name="translator" value="{{ old('translator') }}">

            <label class="control-label">Character</label>
            <input type="text" class="form-control" name="character" value="{{ old('character') }}">
            </br>

            <label class="control-label">Author</label></br>
            <div class="author_input_field">
            <button class="add_author_button">Add Author</button>
            <div><input placeholder="Author name" type="text" name="authors[]"></div>
            </div>
            </br>

            <label class="control-label">Gender</label></br>
            <div class="gender_input_field">
            <button class="add_gender_button">Add Gender</button>
            <div><input placeholder="Gender name" type="text" name="genders[]"></div>
            </div>
            </br>

            <label class="control-label">Chapter</label></br>
            <div class="chapter_input_field">
            <button class="add_chapter_button">Add More Chapter</button>
            <div>
            <input type="text" placeholder="Chapter number" name="chapters[]">
            <input type="text" placeholder="Chapter name" name="chapters[]">
            <textarea placeholder="Chapter content" name="chapters[]"></textarea>
            </div>
            </div>

      

        </div>


        <div class="form-group">

            <button type="submit" class="btn btn-primary btn-lg">

                Create

            </button>

        </div>

    </form>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".author_input_field"); //Fields wrapper
    var add_button      = $(".add_author_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input placeholder="Author name" type="text" name="authors[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".gender_input_field"); //Fields wrapper
    var add_button      = $(".add_gender_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" placeholder="Gender name" name="genders[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".chapter_input_field"); //Fields wrapper
    var add_button      = $(".add_chapter_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" placeholder="Chapter number" name="chapters[]"><input type="text" placeholder="Chapter name" name="chapters[]"><textarea placeholder="Chapter content" name="chapters[]"></textarea><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@endsection