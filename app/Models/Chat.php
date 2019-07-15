<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	protected $fillable = [
		'pet_id',
		'petOwner',
		'petAdopter',

	];

	public function pets()
	{
		return $this->belongsTo(Pet::class);
	}

	public function users()
	{
		return $this->belongsTo(User::class);
	}

}
