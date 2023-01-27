<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    public function movie(){
        return $this->belongsTo(Movie::class, 'film_id');
    }

    public function hall(){
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    public function getFreeSeats(){
        $reservations = Reservation::where('screening_id', $this->id)->get();
        $sold_tickets = $reservations->sum('normal_tickets') + $reservations->sum('concession_tickets');
        return $this->hall->seats - $sold_tickets;
    }
}
