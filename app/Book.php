<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_name', 'image', 'status', 'source', 'description', 'category_description',
        'beta', 'editor', 'translator', 'character', 'other_description', 'slug'
    ];

    public function genders()
    {
        return $this->belongsToMany(Gender::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public static function form()
    {
        return [
            'book_name' => '',
            'image' => '',
            'description' => '',
            'chapters' => [
                Chapter::form()
            ],
            'authors' => [
                Author::form()
            ],
            'genders' => [
                Gender::form()
            ]
        ];
    }
}
