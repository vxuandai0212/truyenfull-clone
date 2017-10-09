<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book;
use App\Chapter;
use App\Gender;
use App\Author;

class CatalogController extends Controller
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
    public function show($catalog_slug)
    {
        
    }

    public function updatedBooks()
    {
        $title = "Truyện mới cập nhật";
        $mainTitle = "Truyện chữ mới";
        $description = "Danh sách truyện chữ được cập nhật (vừa ra mắt, thêm chương mới, sửa nội dung,..) gần đây.";
        $route = "/danh-sach/truyen-moi";
        $books = Book::with(['authors', 'chapters'])
        ->where('created_at', '>=', Carbon::today())
        ->orWhere('updated_at', '>=', Carbon::today())
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
    }

    public function hotBooks()
    {
        $title = "Truyện Hot";
        $mainTitle = "Tổng hợp truyện chữ cực hay và hot";
        $description = "Danh sách những truyện đang hot, có nhiều người đọc và quan tâm nhất trong tháng này.";
        $route = "/danh-sach/truyen-hot";
        $books = Book::with(['authors', 'chapters'])
        ->orderBy('view_count')
        ->where('updated_at', '>=', Carbon::now()->format('M'))
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
    }

    public function completeBooks()
    {
        $title = "Truyện Full";
        $mainTitle = "Tổng hợp truyện chữ hoàn thành(full)";
        $description = "Danh sách những truyện đã hoàn thành, ra đủ chương.";
        $route = "/danh-sach/truyen-full";
        $books = Book::with(['authors', 'chapters'])
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
    }

    public function ngontinhsac()
    {
        $title = "Ngôn Tình Sắc";
        $mainTitle = "Ngôn Tình Sắc";
        $description = "Tổng hợp các bộ truyện ngôn tình sắc (Thịt, H, 18+). Những bộ truyện này thường có yếu tố tình dục được mô tả rõ, cân nhắc trước khi xem.";
        $route = "/danh-sach/ngon-tinh-sac";
        $books = Book::with(['authors', 'chapters'])
        ->whereHas('genders', function ($query) {
            $query
            ->whereIn('gender_name', ['Sắc','Ngôn Tình']);
        })
        ->orderBy('id', 'desc')
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
    }

    public function ngontinhnguoc()
    {
        $title = "Ngôn Tình Ngược";
        $mainTitle = "Ngôn Tình Ngược";
        $description = "Tổng hợp những bộ ngôn tình ngược. Ngôn tình ngược là thể loại truyện ngôn tình có những tình tiết hành hạ nhân vật chính về mặt tinh thần hoặc thể xác, khiến người đọc xúc động mạnh, thường là tức giận, luyến tiếc thậm chí là ức chế thay cho nhân vật.";
        $route = "/danh-sach/ngon-tinh-nguoc";
        $books = Book::with(['authors', 'chapters'])
        ->whereHas('genders', function ($query) {
            $query->where([
                ['gender_name', '=', 'Ngược'],
                ['gender_name', '=', 'Ngôn Tình'],
            ]);
        })
        ->orderBy('id', 'desc')
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
    }

    public function ngontinhsung()
    {
        $title = "Ngôn Tình Sủng";
        $mainTitle = "Ngôn Tình Sủng";
        $description = "Tổng hợp những bộ ngôn tình sủng. Ngôn tình sủng là thể loại truyện ngôn tình có tình tiết ngọt ngào, nhân vật chính được một nửa của mình qaun tâm và chiều chuộng hết mình.";
        $route = "/danh-sach/ngon-tinh-sung";
        $books = Book::with(['authors', 'chapters'])
        ->whereHas('genders', function ($query) {
            $query->where([
                ['gender_name', '=', 'Sủng'],
                ['gender_name', '=', 'Ngôn Tình'],
            ]);
        })
        ->orderBy('id', 'desc')
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
    }

    public function dammi()
    {
        $title = "Đam Mỹ H Văn";
        $mainTitle = "Đam Mỹ H Văn";
        $description = "Tổng hợp các bộ truyện đa mỹ H văn (thịt, sắc, 18+). Những bộ truyện này thường có yếu tố tình dục được mô tả rõ, cân nhắc trước khi xem.";
        $route = "/danh-sach/dam-my-h-van";
        $books = Book::with(['authors', 'chapters'])
        ->whereHas('genders', function ($query) {
            $query->where('gender_name', '=', 'Đam Mỹ');
        })
        ->orderBy('id', 'desc')
        ->paginate(1);

        $genders = Gender::all();

        return view('guestLayouts.catalog', compact('books', 'genders', 'title', 'mainTitle', 'description', 'route'));
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
