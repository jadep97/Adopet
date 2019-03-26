<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PetDetail;
use App\Models\Comments;
use Auth;
use DB;

class SearchController extends Controller
{
    public function index(){

        $pet = Pet::all();
       
        $petDetail = PetDetail::all();
       // dd($petDetail);
        

        return view('search.SearchPet')->with('pets', $pet)->with('petDetail', $petDetail);

    }
   public function SearchPets(Request $request){
        
        $filters = $request['searchData'];

    
        $pet = new Pet;
        $pets = $pet->getSearchPets($filters);
        //dd($pets);
        // if(isset($pets)){
        //     return redirect('home')->with('success','no data found');
        // }else{
        //     return view('search.showSearchPet')->with('pets',$pets);
        // }
        return view('search.showSearchPet')->with('pets',$pets);
    }
    public function searchPet(Request $request){

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
        // dd($pets);
        // if(isset($pets)){
        //     return redirect('home')->with('success','no data found');
        // }else{
        //     return view('search.showSearchPet')->with('pets',$pets);
        // }
        return view('search.showSearchPet')->with('pets',$pets);
    }

    public function getSearchCommentPet(Request $request,$id){

        // $filters = [
            
        //     'pet_id' => $pet->id,
		// 	'user_id' => Auth::user()->id,
		//     'username' => Auth::user()->username,
		// 	'petComment' => $request->get('petComment'),    

        // ];
        // $petID = Pet::find($id);
        $pet = Pet::all();
        
        $comment = new Comments([
            'pet_id' => $pet->id,
			'user_id' => Auth::user()->id,
		    'username' => Auth::user()->username,
			'petComment' => $request->get('petComment'), 
        ]);
        return view('search.showSearchPet')->with('comment', $comment)->with('pets', $pet);

    }
}
