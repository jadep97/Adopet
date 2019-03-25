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
                      
                     
                      $query->orWhere('breed','like',$filters['breed']);
                      
                              
                    }
                    if($filters['eyes']){
                      
                     $query->orWhere('eyes','LIKE', '%'.$filters['eyes'].'%');
                      
                              
                    }
                    if($filters['ears']){
                      
                    $query->orWhere('ears','LIKE', $filters['ears']);
                     
                              
                    }
                    if($filters['hair']){
                      
                     $query->orwhere('hair','LIKE', '%'.$filters['hair'].'%');
                     
                              
                    }
                    if($filters['tail']){
                      
                     $query->orWhere('tail','LIKE', '%'.$filters['tail'].'%');
                     
                              
                    }
                    if($filters['color']){
                      
                      $query->orWhere('color','LIKE', '%'.$filters['color'].'%');
                    
                              
                    }
                    if($filters['marking']){
                      
                     $query->orWhere('marking','LIKE', '%'.$filters['marking'].'%');
                      
                              
                    }
                    if($filters['size']){
                      
                     $query->orWhere('size','LIKE', $filters['size']);
                      
                              
                    }

                   
                    return $query->get();


    }
    
}
