<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\models;
use DB;

class Pet extends Model
{
  public $count;
    protected $fillable = [
        'petName',
        'petOwner',
        'petBirth',
        'breed',
        'address',
        'description',
				'isPosted',
				'user_id',
				'petImg'
    ];

		public function withPetDetail()
		{
			return $this->hasOne(PetDetail::class);
    }


		public function likes()
		{
			return $this->hasMany(Likes::class);
		}

		public function comments()
		{
			return $this->hasMany(Comments::class);
		}


    public function joinPetDetail(){

     return $query = DB::table('pets')
     ->join('pet_details', 'pets.id', '=', 'pet_details.pet_id');

            
            
    }
    

    public function getSearch($filters){
      
      
        
          $query = DB::table('pets')
                    ->join('pet_details', 'pets.id', '=', 'pet_details.pet_id');
                    // ->get();

                    if($filters['breed']){
                      
                     
                      $query->Where('breed','like',$filters['breed']);
                      
                              
                    }
                    if($filters['eyes']){
                      
                     $query->Where('eyes','LIKE', '%'.$filters['eyes'].'%');
                      
                              
                    }
                    if($filters['ears']){
                      
                    $query->Where('ears','LIKE', $filters['ears']);
                     
                              
                    }
                    if($filters['hair']){
                      
                     $query->where('hair','LIKE', '%'.$filters['hair'].'%');
                     
                              
                    }
                    if($filters['tail']){
                      
                     $query->Where('tail','LIKE', '%'.$filters['tail'].'%');
                     
                              
                    }
                    if($filters['color']){
                      
                      $query->Where('color','LIKE', '%'.$filters['color'].'%');
                    
                              
                    }
                    if($filters['marking']){
                      
                     $query->Where('marking','LIKE', '%'.$filters['marking'].'%');
                      
                              
                    }
                    if($filters['size']){
                      
                     $query->Where('size','LIKE', $filters['size']);
                      
                              
                    }

                    return $query->get();


    }
    public function getSearchPets($filters){
//dd($filters);
      $query = DB::table('pets')
        ->join('pet_details', 'pets.id', '=', 'pet_details.pet_id')
        ->orWhere('breed','like', '%'.$filters.'%')
        ->orWhere('eyes','LIKE', '%'.$filters.'%')
        ->orWhere('ears','LIKE', '%'.$filters.'%')
        ->orwhere('hair','LIKE', '%'.$filters.'%')
        ->orWhere('tail','LIKE', '%'.$filters.'%')
        ->orWhere('color','LIKE', '%'.$filters.'%')
        ->orWhere('marking','LIKE', '%'.$filters.'%')
        ->orWhere('size','LIKE', '%'.$filters.'%')
        ->get();
        return $query;



    }
    
}
