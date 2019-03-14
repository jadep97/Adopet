<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use Auth;
use DB;

class PetController extends Controller
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
    {

        // $request->validate([
        //     'petName' => 'required',
        //     'petOwner' => 'required',
        //     'petBirth' => 'required',
        //     'breed' => 'required',
        //     'address' => 'required',
        //     'petInfo' => 'required',
				// 		'petImg' => 'required',
    		// 		'petImg.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);

				$pet = new Pet([
            'petName' => $request->get('petName'),
            'petOwner' => $request->get('petOwner'),
            'petBirth' => $request->get('petBirth'),
            'breed' => $request->get('breed'),
            'address' => $request->get('address'),
            'petInfo' => $request->get('petInfo'),
						'user_id' => Auth::user()->id,
						'isPosted' => false
        ]);

				$data = array();

				if($request->hasfile('petImg')) {
					foreach($request->file('petImg') as $image) {
						$name=$image->getClientOriginalName();
						$image->move(public_path().'/images/', $name);
						$data[] = $name;
					}

					$pet->petImg = json_encode($data);
				}

        $pet->save();
        return redirect('/pet')->with('success', 'Pet Added for Adoption');
    }

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
            'petInfo' => 'required'

        ]);

        $pet = Pet::find($id);

            $pet->petName = $request->get('petName');
            $pet->petOwner = $request->get('petOwner');
            $pet->petBirth = $request->get('petBirth');
            $pet->breed = $request->get('breed');
            $pet->address = $request->get('address');
            $pet->petInfo = $request->get('petInfo');

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

		public function postPet($id)
    {
        $pet = Pet::find($id);

				if($pet) {
					$pet->update(['isPosted' => true]);
				}

    }

		public function getPostedPets() {
			return DB::select('SELECT * FROM pets
												 		-- INNER JOIN users ON pets.user_id = users.id
												 WHERE isPosted = 1');
		}

		public function getUserRequest($id)
    {

        $pet = Pet::find($id);

				$pet->petRequest = Auth::user()->id;
			// dd($pet->petRequest);

				$pet->save();
				return view('pages.home')->with('success', 'Requested');



    }
}
