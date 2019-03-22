<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\models;
use DB;

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
		
		public function withPetDetail()
		{
			return $this->hasOne(PetDetail::class);
    }
    public function joinPetDetail($search,$search1,$search2,$search3,$search4,$search5,$search6,$search7){
      
      $matchThese = ['breed' => $search, 
                     'eyes' => $search1,
                     'ears' => $search2,
                     'hair' => $search3,
                     'tail' => $search4,
                     'color' => $search5,
                     'marking' => $search6,
                     'size' => $search7
                    ];
    return  $query = DB::table('pets')
              ->join('pet_details', 'pets.id', '=', 'pet_details.pet_id')
              ->where($matchThese)
              ->get();

    }
    // public function getJoinPetDetail($query, $search){

    //   return $query->where('breed', 'LIKE', '%$search%' )
    //                 ->sortByDesc('id');

    // }
    
}
