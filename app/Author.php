<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'author_name', 'slug'
    ];

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public static function form()
    {
        return [
            'author_name' => ''
        ];
    }
}
