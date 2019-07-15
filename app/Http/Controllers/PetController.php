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
            'petOwner' => Auth::user()->first_name,
            'petBirth' => $request->get('petBirth'),
            'breed' => $request->get('breed'),
            'address' => $request->get('address'),
            'description' => $request->get('description'),
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
        if($pet->save()){
            $petDetail = new PetDetail([

                'pet_id' => $pet->id,
                'eyes' => $request->get('petEyes'),
                'ears' => $request->get('petEars'),
                'hair' => $request->get('petHair'),
                'color' => $request->get('petColor'),
                'tail' => $request->get('petTail'),
                'marking' => $request->get('petMarking'),
                'size' => $request->get('petSize')

            ]);

            $petDetail->save();


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

		public function postPet($id)
    {
        $pet = Pet::find($id);

				if($pet) {
					$pet->update(['isPosted' => true]);
                }
        return redirect()->to('/pet');

    }

		public function getPostedPets() {

			return DB::select('SELECT * FROM pets
														-- INNER JOIN users ON pets.user_id = users.id
												 WHERE isPosted = 1');
		}

		public function getProfilePets() {
					return DB::select("SELECT DISTINCT
														pets.id,
														petName,
														petOwner,
														petBirth,
														breed,
														address,
														description,
														petImg,
														pets.user_id as pets_user_id,
														(SELECT count(*) from likes WHERE pet_id = pets.id) as likeCount
						FROM pets LEFT JOIN likes on pets.id = likes.pet_id
						WHERE isPosted = 1 AND pets.user_id = ". Auth::user()->id);
		}

		public function likePet($id)
		{
			$pet = Pet::find($id);

			$like = Likes::create([
				'pet_id' => $pet->id,
				'user_id' => Auth::user()->id
			]);

			$like->save();
			return view('/profile', compact('like'))->with('success');

		}

		public function getLikedPets() {
					return DB::select("SELECT DISTINCT
														pets.id,
														petName,
														petOwner,
														petBirth,
														breed,
														address,
														description,
														petImg,
														pets.user_id,
														likes.pet_id,
														(SELECT count(*) from likes WHERE pet_id = pets.id) as likeCount
								FROM pets LEFT JOIN likes on pets.id = likes.pet_id
								WHERE isPosted = 1
								ORDER BY likeCount DESC");
		}

			public function commentPet(Request $request, $id)
    {
				$pet = Pet::find($id);

        $comment = Comments::create([

					'pet_id' => $pet->id,
					'user_id' => Auth::user()->id,
					'username' => Auth::user()->first_name,
					'petComment' => $request->get('petComment'),
					'created_at' => Carbon::Now(),


				]);

				$comment->save();
          return redirect('/')->with('success', 'Sent');
		}

		public function getCommentPets($id) {

			return DB::select('SELECT * FROM comments
												 WHERE pet_id ='. $id);
		}



		public function getUserRequests($id) {

			return DB::select('SELECT DISTINCT
													pets.id,
													petName,
													petOwner,
													petBirth,
													breed,
													address,
													description,
													petImg,
													users.id,
													users.username as username,
													users.email as email,
													pet_requests.user_id,
													pet_requests.pet_id
												FROM pets LEFT JOIN pet_requests
												on pets.id = pet_requests.pet_id
												LEFT JOIN users
												on pet_requests.user_id = users.id
												WHERE pets.id ='. $id);

		}

		public function requestPet($id)
    {
			$pet = Pet::find($id);

        $petRequest = PetRequest::create([

					'pet_id' => $pet->id,
					'user_id' => Auth::user()->id,


				]);

				$petRequest->save();
				return redirect('/')->with('success', 'Requested');
    }


		public function getRequestPets() {
					return DB::select("SELECT DISTINCT
															pets.id,
															petName,
															petOwner,
															petBirth,
															breed,
															address,
															description,
															petImg,
															pet_requests.user_id,
															pet_requests.pet_id
														FROM pets LEFT JOIN pet_requests
														on pets.id = pet_requests.pet_id
														WHERE isPosted = 1
														AND pet_requests.user_id = ". Auth::user()->id);
		}

		public function chatPet($adopterId, $petId)
		{
			$pet = Pet::find($petId);
			$user = User::find($adopterId);

			$chats = DB::select("SELECT * FROM chats WHERE petAdopter = ". $adopterId .
												" AND pet_id = " . $petId);
//dd($chat);
			if($chats) { //  if may shud


			} else { // if empty
				Chat::create([
					'pet_id' => $pet->id,
					'petOwner' => $pet->user_id,
					'petAdopter' => $user->id,
					'created_at' => Carbon::Now()
				])->save();


			}
				// $chat = Chat::create([
				// 	'pet_id' => $pet->id,
				// 	'petOwner' => $pet->user_id,
				// 	'petAdopter' => $user->id,
				// 	'created_at' => Carbon::Now()
				// ]);
				//
				// $chat->save();

				// return redirect('/chatPet')->with('success');
				return view('pages.chat', compact('chats'));
		}

		public function messagePet(Request $request, $id)
		{

				$message = Message::create([
					'chat_id' => $id,
					'sender' => Auth::user()->id,
					'text' => $request->get('message'),
					'created_at' => Carbon::Now()
				]);

				$messagePet->save();
				return redirect('/')->with('success', 'Requested');
		}


		// public function getChatAdopter($id)
		// {
		// 		$pet = Pet::find($id);
		//
		// 		$chat = Chat::create([
		//
		// 			'pet_id' => $pet->id,
		// 			'pet_user_id' =>  Auth::user()->id,
		// 			'petOwner' => $pet->petOwner,
		// 			'adopter_id' => $id,
		// 			'username' => Auth::user()->first_name,
		// 			'pet_chat' => $request->get('pet_chat'),
		// 			'created_at' => Carbon::Now(),
		//
		// 		]);
		//
		// 		$petRequest->save();
		// 		return redirect('/')->with('success', 'Requested');
		// }

}
