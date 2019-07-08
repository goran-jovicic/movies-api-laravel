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
        'director' => 'required|between:1,500',
        'duration' => 'required',
        'releaseDate' => 'required|unique:movies',
        'imageUrl' => 'url'
    ];
}