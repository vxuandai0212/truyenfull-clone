<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'book_id', 'chapter_number', 'chapter_name', 'chapter_content', 'slug'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function form()
    {
        return [
            'chapter_number' => '',
            'chapter_name' => '',
            'chapter_content' => ''
        ];
    }
}
