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
        if($cat_id == "all")
        {
            $books = Book::with(['genders', 'chapters'])
                ->where('created_at', '>=', Carbon::today())
                ->orWhere('updated_at', '>=', Carbon::today())->take(25)->get();
        }else{
            $books = Book::with(['genders', 'chapters'])->whereHas('genders', function($query) use ($cat_id){
                $query->where('genders.id',$cat_id);
            })
                ->where('created_at', '>=', Carbon::today())
                ->orWhere('updated_at', '>=', Carbon::today())->take(25)->get();
        }


        return Response::json($books);
    }
}
