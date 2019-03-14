<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\models;

class Pet extends Model
{
    protected $fillable = [
        'petName',
        'petOwner',
        'petBirth',
        'breed',
        'address',
        'petInfo',
				'isPosted',
				'user_id',
				'petImg'
    ];
		//
		// public function users()
		// {
		// 	return $this->belongsTo(User::class, 'user_id');
		// }
}
