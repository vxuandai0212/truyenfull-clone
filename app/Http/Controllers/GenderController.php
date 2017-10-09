<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Gender;
use App\Author;
use App\Chapter;
use Redirect;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Gender::paginate(5);
        $title = "Genders";
        $i = 1;
        return view('gender.index', compact('contents', 'title', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            
                    'gender_name' => 'required|string',
                    'gender_description' => 'required|unique:genders'           
                    ]);

            
                    $gender = Gender::create(['gender_name' => $request->gender_name, 
                                        'gender_description' => $request->gender_description,
                                        'gender_slug' => str_slug($request->gender_name, '-')]);
                    $gender->save();
            
                    return Redirect::route('genders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($genre_slug)
    {   
        $genre = Gender::where('slug','=',$genre_slug)->firstOrFail();

        $books = Book::with(['authors', 'chapters'])->whereHas('genders', function ($query) use ($genre_slug) {
            $query->where('slug', '=', $genre_slug);
        })
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.genre', compact('books', 'genre', 'genders'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Gender";
        $content = Gender::find($id);
        return view('gender.edit', compact('content', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         Gender::where('id', $id)->update(['gender_name' => $request->gender_name,
        'gender_description' => $request->gender_description,
        'slug' => str_slug($request->gender_name, '-')]);

        return Redirect::route('genders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gender::destroy($id);
        return Redirect::route('genders.index');
    }
}
