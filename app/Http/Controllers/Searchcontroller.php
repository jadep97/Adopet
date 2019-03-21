<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PetDetail;
use Auth;
use DB;

class Searchcontroller extends Controller
{
    public function index(){
        
        return view('search.SearchPet');

    }
   public function SearchPet(Request $request){

        

    }
}
