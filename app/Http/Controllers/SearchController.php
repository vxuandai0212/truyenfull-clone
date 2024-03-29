<?php

namespace App\Http\Controllers;
use App\Book;
use App\Gender;
use Carbon\Carbon;
use App\Chapter;
use App\Author;
use Response;


use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search=  $request->term;
        
        $posts = Book::where('book_name','LIKE',"%{$search}%")
                       ->orderBy('created_at','DESC')->limit(5)->get();

        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
                
                $new_row['title']= $post->book_name;
                $new_row['url']= url($post->slug);
                
                $row_set[] = $new_row; //build an array
            }
        }
        
        echo json_encode($row_set); 
    }

    public function hotCategory(Request $request)
    {
        $cat_id = $request->cat_id;
        if($cat_id == "all")
        {
            $books = Book::orderBy('view_count','desc')->take(13)->get();
        }else{
            $books = Book::whereHas('genders', function($query) use ($cat_id){
                 $query->where('genders.id',$cat_id);
            })->orderBy('view_count', 'desc')->take(13)->get();
        }
       

        return Response::json($books);
    }

    public function newCategory(Request $request)
    {
        $cat_id = $request->cat_id;
        if($cat_id == 'all'){
            $books = Book::with('genders','chapters')
                ->where('updated_at', '>=', Carbon::today())
                ->take(-24)->get();
        }
        else{
            $books = Book::with(['genders', 'chapters'])
                ->whereHas('genders', function($query) use ($cat_id){
                    $query->where('genders.id','=', $cat_id);
                })
                ->where('updated_at', '>=', Carbon::today())
                ->take(-24)->get();
        }


        $genders = Gender::all();


        return view('guestLayouts.updatedList', compact('books','genders', 'cat_id'));
    }

    public function hotlist(Request $request)
    {
        $z = 0;
        if($request->date == "day"){
            $hotbooks = Book::with('genders')
            ->orderBy('id', 'desc')
            ->take(10)->get();
        }
        elseif($request->date == "month"){
            $hotbooks = Book::with('genders')
            ->orderBy('view_count','desc')
            ->take(10)->get();
        }else{
            $hotbooks = Book::with('genders')
            ->orderBy('view_count')
            ->take(10)->get();
        }

        return view('guestLayouts.hotlist', compact('hotbooks','z'));

    }
}
