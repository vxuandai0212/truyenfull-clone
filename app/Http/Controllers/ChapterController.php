<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapter;
use App\Book;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($book_slug, $chapter_slug)
    {
        $book = Book::where('slug', $book_slug)->first();

        $chapter = Chapter::with('book:id,book_name,slug')->where('slug','=', $chapter_slug)
        ->where('book_id', $book->id)
        ->first();

        $previous = Chapter::with('book:id,slug')->where('id', '<', $chapter->id)->where('book_id', $book->id)->orderBy('id', 'desc')->first();
            // get next user id
        $next = Chapter::with('book:id,slug')->where('id', '>', $chapter->id)->where('book_id', $book->id)->first();

        return view('guestLayouts.chapter',compact('chapter', 'previous', 'next', 'book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
