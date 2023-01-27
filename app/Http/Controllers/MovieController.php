<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Screening;
use App\Models\Reservation;
use Carbon\Carbon;
use Validator;
use Redirect;
use Auth;

class MovieController extends Controller
{
    public function index(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openweathermap.org/data/2.5/weather?lang=pl&q=Gdansk&appid=dba3cbbbe22de845daba54e9ad2c2c0b&units=metric');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $weather = json_decode(curl_exec($ch));

        $movies = Movie::orderBy('id', 'desc')->get();

        return view('movies.movies', compact('movies', 'weather'));
    }

    public function getMovie($id){
        $movie = Movie::findOrFail($id);
        $screenings = Screening::whereDate('date', '>', Carbon::now())->where('film_id', $id)->get();

        return view('movies.movie', compact('movie', 'screenings'));
    } 

    public function makeReservation(Request $request){
        $validator = Validator::make($request->all(), [
            'normal_tickets' => 'required_without:concession_tickets',
            'concession_tickets' => 'required_without:normal_tickets',
        ]);
        
        if($validator->fails()){
            return Redirect::back()->withInput()->with('save_error', 'error');
        }

        $screening = Screening::find($request->screening_id);

        if($request->normal_tickets + $request->concession_tickets > $screening->getFreeSeats()){
            return Redirect::back()->withInput()->with('seats_error', 'error');
        }

        $reservation = new Reservation();
        $reservation->screening_id = $screening->id;
        $reservation->normal_tickets = $request->normal_tickets;
        $reservation->concession_tickets = $request->concession_tickets;
        $reservation->user_id = Auth::user()->id;
        $reservation->save();

        return Redirect::back()->withInput()->with('reservation_success', 'ok');
    }

    public function userReservations(){
        $reservations = Reservation::where('user_id' , Auth::user()->id)->get();

        return view('reservations.reservations', compact('reservations'));
    }
}
