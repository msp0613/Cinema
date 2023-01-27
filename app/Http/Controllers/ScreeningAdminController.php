<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;
use App\Models\Hall;
use Redirect;
use Validator;

class ScreeningAdminController extends Controller
{
    public function index($id){
        $screenings = Screening::where('film_id', $id)->orderBy('id', 'desc')->get();
        
        return view('admin.screening.screenings', compact('screenings'));
    }

    public function modify($movie_id, $id = null){
        $screening = Screening::find($id);
        $halls = Hall::get();

        return view('admin.screening.modify', compact('screening', 'halls', 'movie_id'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);
        
        if($validator->fails()){
            return Redirect::back()->withInput()->with('save_error', 'error');
        }

        $screening = Screening::find($request->screening_id);
        if(!$screening){
            $screening = new Screening();
        }
        $screening->film_id = $request->film_id;
        $screening->hall_id = $request->hall_id;
        $screening->date = $request->date;
        $screening->save();

        return Redirect::to("/zarzadzanie-seansami/{$screening->film_id}");
    }

    public function delete($id){
        $screening = Screening::find($id);
        $movie_id = $screening->film_id;
        $screening->delete();
        return Redirect::to("/zarzadzanie-seansami/{$movie_id}");
    }

}
