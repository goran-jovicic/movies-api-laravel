<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = request()->input('title');
        $take = request()->input('take', Movie::get()->count());
        $skip = request()->input('skip', 0);

        if ($title) {
            return Movie::search($title, $skip, $take);
        } else if ($take && $skip) {
            return Movie::skip($skip)->take($take)->get();
        } else {
            return Movie::all();
        }
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

    /* PROVERA DA LI FILM POSTOJI U BAZI PODATAKA */
    public function checkIfExists($title, $date)
    {
        if (Movie::where('title', $title)->first()) {
            if (Movie::where('releaseDate', $date)->first()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->duration = intval($request->duration);
        if ($this->checkIfExists($request->input('title'), $request->input('releaseDate'))) {
            print_r('Postoji film sa tim imenom i istim datumom');
            return;
        }

        $this->validate(request(), Movie::STORE_RULES);

        $movie = new Movie();

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::find($id);
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
        $request->duration = intval($request->duration);
        if ($this->checkIfExists($request->input('title'), $request->input('releaseDate'))) {
            print_r('Postoji film sa tim imenom i istim datumom');
            return;
        }

        $movie = Movie::find($id);

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $this->validate(request(), Movie::STORE_RULES);

        $movie->save();

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        $movie->delete();

        return response()->json('Uspesno ste obrisali film');
    }
}
