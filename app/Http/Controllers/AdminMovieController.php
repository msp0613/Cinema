<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Validator;
use Redirect;

class AdminMovieController extends Controller
{
    public function index(){
        $movies = Movie::orderBy('id', 'desc')->get();

        return view('admin.movies.movies', compact('movies'));
    }

    public function modify($id = null){
        $movie = Movie::find($id);
        
        return view('admin.movies.modify', compact('movie'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'min_age' => 'required|numeric',
            'price' => 'required|numeric',
            'discounted_price' => 'required|numeric'
        ]);
        
        if($validator->fails()){
            return Redirect::back()->withInput()->with('save_error', 'error');
        }

        $movie = new Movie();
        if($request->movie_id){
            $movie = Movie::find($request->movie_id);
        }
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->min_age = $request->min_age;
        $movie->price = $request->price;
        $movie->discounted_price = $request->discounted_price;
        $movie->save();

        return Redirect::to('/zarzadzanie-filmami');
    }
    
    public function delete($id){
        Movie::find($id)->delete();
        return Redirect::back();
    }
    
    
}
