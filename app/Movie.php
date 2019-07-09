<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title','director','imageUrl','duration','releaseDate','genre'
    ];

    const STORE_RULES = [
        'title' => 'required|unique:movies',
        'director' => 'required',
        'duration' => 'required|between:1,500|integer',
        'releaseDate' => 'required|unique:movies',
        'imageUrl' => 'url'
    ];

    public static function search ($title) {
        return self::where('title', 'LIKE', '%'. $title . '%')->get();
    }
}