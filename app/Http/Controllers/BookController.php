<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Gender;
use App\Author;
use App\Chapter;
use File;
use Redirect;
use DB;
use App\Events\BookViewed;
use Carbon\Carbon;

class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Books';
        $books = Book::orderBy('created_at', 'desc')
        ->get(['id', 'book_name', 'image']);

        return view('book.index', compact('books', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!$request->hasFile('image') && !$request->file('image')->isValid())
        {
            return abort(404, 'Image not uploaded!');
        }

        $filename = $this->getFileName($request->image);
        $request->image->move(base_path('public/images'), $filename);

        $slug = str_slug($request->book_name, "-");
      
        $book = Book::create(['book_name' => $request->book_name,
                            'image' => $filename,
                            'status' => $request->status,
                            'source' => $request->source,
                            'description' => $request->book_description,
                            'category_description' => $request->category,
                            'beta' => $request->beta,
                            'editor' => $request->editor,
                            'translator' => $request->translator,
                            'character' => $request->character,
                            'slug' => $slug]);
        
        $book->image = $filename;

        $book->save();

        foreach($request->authors as $key => $value)
        {
            $author = Author::where('author_name', '=', $value)->first();
            if ($author === null){
                $newAuthor = new Author;
                $newAuthor->author_name = $value;
                $newAuthor->slug = str_slug($value, "-");
                $newAuthor->save();
                $book->authors()->attach($newAuthor->id); 
                
            }else{
                $book->authors()->attach($author->id);
            }
            
        }

        foreach($request->genders as $key => $value)
        {
            $gender = Gender::where('gender_name', '=', $value)->first();
            if ($gender === null) {
                $newGender = new Gender;
                $newGender->gender_name = $value;
                $newGender->slug = str_slug($value, "-");
                $newGender->save();
                $book->genders()->attach($newGender->id);
            }else{
                $book->genders()->attach($gender->id);
            }
        }

        $chapters = array_chunk($request->chapters, 3);

        $dataSet = [];
        foreach ($chapters as $key => $value) {
            $dataSet[] = [
                'chapter_number'  => $value[0],
                'chapter_name'    => $value[1],
                'chapter_content' => $value[2],
                'slug' => str_slug($value[0], "-")
            ];
        }
        
        $book->chapters()->createMany($dataSet);

        return Redirect::route('books.index');

    }

    protected function getFileName($file)
    {
        return str_random(32).'.'.$file->extension();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($book_slug, Request $request)
    {
        
        $book = Book::with(['genders'])
        
        ->where('slug','=', $book_slug)
        ->firstOrFail();
       
        event(new BookViewed($book));
        
        $i = 0;
        $j = 0;
        $z = 0;
        $k = 0;


        $author = Author::whereHas('books', function($query) use ($book) {
            $query->where('books.id', '=', $book->id);
        })->first();

        $sameAuthorBooks = Book::whereHas('authors', function ($query) use ($author) {
            $query->where('authors.id', '=', $author->id);
        })->where('id', '!=', $book->id)->get();

        $chapters = DB::table('books')
        ->where('books.slug','=', $book_slug)
        ->join('chapters', 'chapters.book_id', '=', 'books.id')
        ->select('chapters.id', 'chapters.chapter_number', 'chapters.chapter_name', 'chapters.slug')
        ->paginate(2);

        $hotbooks = Book::with(['genders'])
        ->orderBy('view_count','desc')
        ->where('updated_at', '>=', Carbon::now()->format('M'))
        ->take(10)
        ->get();

        if($request->ajax() || 'NULL'){
    	     return view('guestLayouts.book',compact('book', 'i', 'j', 'chapters', 'author', 'sameAuthorBooks','hotbooks','z','k'));
        }

      
    }

    public function home()
    {
        $genders = Gender::all();
        $recentUpdateBooks = Book::with('genders','chapters')
        ->where('created_at', '>=', Carbon::today())
        ->orWhere('updated_at', '>=', Carbon::today())
        ->take(-24)->get();
        $completeBooks = Book::with('chapters')->where('status', 1)->take(-12)->get();
        $hotBooks = Book::with('genders', 'chapters')->orderBy('view_count', 'desc')->take(13)->get();
        return view('guestLayouts.index', compact('completeBooks', 'recentUpdateBooks', 'hotBooks', 'genders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with(['authors', 'genders', 'chapters'])
        ->findOrFail($id);
        
        return view('book.edit', compact('book'));
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
        //Update book
        $book = Book::findOrFail($id);

        $book->book_name = $request->book_name;
        $book->status = $request->status;
        $book->source = $request->source;
        $book->description = $request->book_description;
        $book->category_description = $request->category;
        $book->beta = $request->beta;
        $book->editor = $request->editor;
        $book->translator = $request->translator;
        $book->character = $request->character;
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $filename = $this->getFileName($request->image);
            $request->image->move(base_path('public/images'), $filename);

            File::delete(base_path('public/images'.$book->image));
            $book->image = $filename;
        }

        $book->save();

        //Update related authors
        $authorsArray = [];
        foreach ($request->authors as $key => $value) {
            $authorsArray[] = [
                'author_name'  => $value
            ];
        }
        $authorsUpdated = [];

        foreach($authorsArray as $author) {
            $newAuthor = Author::firstOrCreate($author);
            $authorsUpdated[] = $newAuthor->id;
        }

        $book->authors()
        ->sync($authorsUpdated);

        //Update related genders
        $gendersArray = [];
        foreach ($request->genders as $key => $value) {
            $gendersArray[] = [
                'gender_name'  => $value
            ];
        }
        $gendersUpdated = [];

        foreach($gendersArray as $gender) {
            $newGender = Gender::firstOrCreate($gender);
            $gendersUpdated[] = $newGender->id;
        }

        $book->genders()
        ->sync($gendersUpdated);
        

        //Update related chapters
        $chapters = array_chunk($request->chapters, 3);
        
        $chaptersArray = [];
        $gendersUpdated = [];
        foreach ($chapters as $key => $value) {
            $chaptersArray[] = [       
            'chapter_number'  => $value[0],
            'chapter_name'    => $value[1],            
            'chapter_content' => $value[2]                 
            ];
        }

        foreach($chaptersArray as $chapter) {
            $newChapter = Chapter::updateOrCreate([
                'book_id' => $book->id,
                'chapter_number'  => $chapter['chapter_number'],
                'chapter_name'    => $chapter['chapter_name'],            
                'chapter_content' => $chapter['chapter_content'] 
            ]);
            $chaptersUpdated[] = $newChapter->id;
        }

        Chapter::whereNotIn('id', $chaptersUpdated)
        ->where('book_id', $book->id)
        ->delete();

        return Redirect::route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $book = Book::findOrFail($id);

        $book->authors()->detach();
        $book->genders()->detach();
        Chapter::where('book_id', $book->id)->delete();

        File::delete(base_path('public/images'.$book->image));

        $book->delete();

        return Redirect::route('books.index');
    }
}
