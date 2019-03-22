<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PetDetail;
use Auth;
use DB;

class SearchController extends Controller
{
    public function index(){

        $pet = Pet::all();
        $petDetail = PetDetail::all();
        

        return view('search.SearchPet')->with('pets', $pet, 'petDetails', $petDetail);

    }
   public function SearchPet(Request $request){
    
       $pet = new Pet;
       $pets = $pet->joinPetDetail(
           $request->petBreed, 
           $request->petEyes,
           $request->petEars,
           $request->petHair,
           $request->petTail,
           $request->petColor,
           $request->petMarking,
           $request->petSize
        );
    //    $searchpet = $pet->getJoinPetDetail($query,$request->petBreed);
       
        //  dd($searchPet);
        
        
    return view('search.showSearchPet')->with('pets', $pets);


    }
}
