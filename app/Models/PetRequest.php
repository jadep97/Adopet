<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetRequest extends Model
{
	protected $fillable = [
		'pet_id',
		'user_id'
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
