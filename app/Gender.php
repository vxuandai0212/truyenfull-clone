<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = [
        'gender_name', 'gender_description', 'slug'
    ];

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public static function form()
    {
        return [
            'gender_name' => '',
            'gender_description' => ''
        ];
    }
}
