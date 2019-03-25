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

        $pet = Pet::distinct()->get(['breed']);
       
        $petDetail = PetDetail::all();
       // dd($petDetail);
        

        return view('search.SearchPet')->with('pets', $pet)->with('petDetail', $petDetail);

    }
   public function SearchPets(Request $request){
        $filters = [
           'breed' => $request->petBreed, 
           'eyes' => $request->petEyes,
           'ears' => $request->petEars,
           'hair' => $request->petHair,
           'tail' => $request->petTail,
           'color' => $request->petColor,
           'marking' => $request->petMarking,
           'size' => $request->petSize
        ];
       $pet = new Pet;
       $pets = $pet->getSearch($filters);
    //    $searchpet = $pet->getJoinPetDetail($query,$request->petBreed);
       
       
        
    return view('search.showSearchPet')->with('pets',$pets);


    }
    public function searchPet(Request $request){

        

    }
}
