<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\models;

class PetDetail extends Model
{
    //
    protected $fillable = [

        'eyes',
        'ears',
        'hair',
        'color',
        'tail',
        'marking',
        'size',
        'pet_id',

    ];

    public function pet(){

        return $this->belongsTo(Pet::class);

    }
}
