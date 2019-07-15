<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetDetail;
use App\Models\PetRequest;
use App\Models\Pet;
use App\Models\User;
use App\Models\Likes;
use App\Models\Comments;
use App\Models\Chat;
use Auth;
use DB;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		$pets = DB::select('select * from pets where user_id = ' . Auth::user()->id);

        return view('pages.petlist', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.petcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pet = Pet::find($id);

        return view('pet.editPet', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'petName' => 'required',
            'petOwner' => 'required',
            'petBirth' => 'required',
            'breed' => 'required',
            'address' => 'required',
            'description' => 'required'

        ]);

        $pet = Pet::find($id);

            $pet->petName = $request->get('petName');
            $pet->petOwner = $request->get('petOwner');
            $pet->petBirth = $request->get('petBirth');
            $pet->breed = $request->get('breed');
            $pet->address = $request->get('address');
            $pet->description = $request->get('description');

        $pet->save();

        return view('pages.petlist', compact('pets'))->with('success', 'Pet has been updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        $pet = Pet::find($id);
        $pet->delete();

        return view('/welcome')->with('success', 'Pet has been deleted');
    }


		public function getChat($adopterId, $petId) {
			return DB::select("SELECT DISTINCT
													pets.id,
													pets.petName,
													pets.petOwner,
													pets.petBirth,
													pets.breed,
													pets.address,
													pets.description,
													pets.petImg,
													chats.id
													pet_id,
													petAdopter,
													users.id,
													users.username as username,
													users.email as email
													FROM chats LEFT JOIN pets
													on pet_id = pets.id
													LEFT JOIN users
													on chats.petAdopter = users.id
													WHERE chats.petAdopter = ". $adopterId .
																						" AND pets.id = " . $petId);
		}



}
