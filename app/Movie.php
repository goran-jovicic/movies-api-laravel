<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'director', 'imageUrl', 'duration', 'releaseDate', 'genre'
    ];

    const STORE_RULES = [
        'title' => 'required',
        'director' => 'required',
        'duration' => 'required|between:1,500|integer',
        'releaseDate' => 'required',
        'imageUrl' => 'url'
    ];

    public static function search($title,$skip,$take)
    {
        return self::where('title', 'LIKE', '%' . $title . '%')->skip($skip)->take($take)->get();
    }
}
