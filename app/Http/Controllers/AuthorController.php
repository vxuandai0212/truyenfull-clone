<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Chapter;
use App\Book;
use App\Gender;
use Carbon\Carbon;
use Redirect;

class AuthorController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Author::paginate(5);
        $title = "Authors";
        $i = 1;
        return view('author.index', compact('contents', 'title', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
            
                    'author_name' => 'required|string'       
                    ]);

            
                    $author = Author::create(['author_name' => $request->author_name, 
                                        'author_slug' => str_slug($request->author_name, '-')]);
                    $author->save();
            
                    return Redirect::route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($author_slug)
    {
        $author = Author::where('slug','=',$author_slug)->first();

        $books = Book::with(['chapters'
        ])->whereHas('authors', function ($query) use ($author) {
            $query->where('authors.id', '=', $author->id);
        })->get();

        $genders = Gender::all();

        $hotbooks = Book::with(['genders'])
        ->orderBy('view_count','desc')
        ->where('updated_at', '>=', Carbon::now()->format('M'))
        ->take(10)
        ->get();

        $z = 0;

        return view('guestLayouts.author', compact('author', 'books', 'genders', 'hotbooks', 'z'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Author";
        $content = Author::find($id);
        return view('author.edit', compact('content', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $author->update(['author_name' => $request->author_name,
        'author_slug' => str_slug($request->author_name, '-')]);

        return Redirect::route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::destroy($id);
        return Redirect::route('authors.index');
    }
}
