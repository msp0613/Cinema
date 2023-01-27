<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function screening(){
        return $this->hasOne(Screening::class, 'id', 'screening_id');
    }
}
