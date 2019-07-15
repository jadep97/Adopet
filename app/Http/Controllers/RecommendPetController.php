<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FacebookLog;
use DB;

class RecommendPetController extends Controller
{
    public function recommend(){
        if(Auth::user()){
					if(Auth::user()->is_facebook){
	            $logs = FacebookLog::where('user_id',Auth::user()->id)->get()->toArray();

	            $posts_logs = json_decode($logs[0]['user_posts']);
	            $likes_logs = json_decode($logs[0]['user_likes']);
	            $split_posts = [];
	            $split_likes = [];
	            foreach($posts_logs as $value){
	                $split_posts[] = preg_split('/\s+|\./', $value);
	                //echo "<pre>".$value."</pre>";
	            }
	            foreach($likes_logs as $value){
	                $split_likes[] = preg_split('/\s+|\./', $value);
	                //echo "<pre>".$value."</pre>";
	            }
	            $posts = json_encode($split_posts);
	            $likes = json_encode($split_likes);
	            $dog_profile = json_encode([
	                'breed' => ['husky','labrador','bulldog','pug'],
	                'color' => ['white', 'black', 'brown', 'gold'],

	            ]);
	            //file_put_contents('dog_profile.txt',$dog_profile);
	            $jso=json_decode($dog_profile);
	            //dd($jso->breed);
	            //dd(json_decode(file_get_contents('posts_test.txt')));
	            $fb = FacebookLog::where('user_id',Auth::user())
	                            ->where('split_posts',$posts)
	                            ->where('split_likes',$likes)->get()->toArray();
	            if(!$fb){
	                $facebook = FacebookLog::where('user_id',Auth::user()->id)->update([
	                                            'split_posts' => $posts,
	                                            'split_likes' => $likes
	                                        ]);
	            }



	            //DB::update('update facebook_user_log set split_posts = ? where user_id = ?',[serialize($split),Auth::user()->id]);
	            //echo count($split[0]);
	            for($i = 0 ; $i < count($split_posts) ; $i++){
	                //echo "<pre>"; print_r($split[0]);"</pre>";
	                for($x = 0 ; $x < count($split_posts[$i]) ; $x++){
	                    //echo $split_posts[$i][$x]."<br>";
	                }
	            }
	            $breedCount = 0;
	            $colorCount = 0;
	            $dog = [
	                'breed' => [
	                    'husky' => [],
	                    'labrador' => [],
	                    'bulldog' => [],
	                    'pug' => []
	                ],
	                'color' => [
	                    'white' => [],
	                    'black' => [],
	                    'brown' => [],
	                    'gold' => []
	                ]
	            ];
	            //dd($split_posts[1][2]);
	            for($i = 0 ; $i < count($jso->breed) ; $i++){
	            //  echo "<pre>";echo ($jso->breed[$i]); echo "</pre>";

	                for($j = 0 ; $j < count($split_posts) ; $j++){
	                    //echo "<pre>"; print_r($split[0]);"</pre>";
	                    for($x = 0 ; $x < count($split_posts[$j]) ; $x++){
	                        //echo $split_posts[$i][$x]."<br>";
	                        if($jso->breed[$i] == strtolower($split_posts[$j][$x])){
	                            array_push($dog['breed'][strtolower($split_posts[$j][$x])], strtolower($split_posts[$j][$x]));

	                        }
	                        if($jso->color[$i] == strtolower($split_posts[$j][$x])){
	                            //echo "<pre>"; var_dump(strtolower($split_posts[$j][$x])); echo "</pre>";
	                            array_push($dog['color'][strtolower($split_posts[$j][$x])], strtolower($split_posts[$j][$x]));

	                        }
	                    }
	                }
	                for($j = 0 ; $j < count($split_likes) ; $j++){
	                    //echo "<pre>"; print_r($split[0]);"</pre>";
	                    for($x = 0 ; $x < count($split_likes[$j]) ; $x++){
	                        //echo $split_posts[$i][$x]."<br>";
	                        if($jso->breed[$i] == strtolower($split_likes[$j][$x])){
	                            array_push($dog['breed'][strtolower($split_likes[$j][$x])], strtolower($split_likes[$j][$x]));

	                        }
	                        if($jso->color[$i] == strtolower($split_likes[$j][$x])){
	                            array_push($dog['color'][strtolower($split_likes[$j][$x])], strtolower($split_likes[$j][$x]));

	                        }
	                    }
	                }
	            }
	            foreach($dog['breed'] as $key => $value){
	                if(!$dog['breed'][$key]){
	                // $breed = DB::table('pets')->whereIn('id',$pet_id);
	                }
	            }
	            foreach($dog['color'] as $key => $value){
	                if(!$dog['color'][$key]){
	                    //$pet_id = DB::table('pet_details')->select('pet_id')->where('color', max($dog["color"])[0]);
	                }
	            }
	            //dd(max($dog['breed']));
	            //dd(!$likes_logs);
	            if($posts_logs && $likes_logs){
	                if(!max($dog['breed'])){
	                    // $breed_id = DB::table('pets')->select('id');
	                    // $return = DB::table('pet_details')->where('color', max($dog["color"])[0])->whereIn('pet_id',$breed_id)->get()->toArray();
	                    //dd(max($dog));
	                    $pet_id = DB::table('pet_details')->select('pet_id')->where('color', max($dog["color"])[0]);
	                    $return = DB::table('pets')->whereIn('id',$pet_id)->get()->toArray();
	                }
	                elseif(!max($dog['color'])){
	                    $pet_id = DB::table('pet_details')->select('pet_id');
	                    $return = DB::table('pets')->where('breed',max($dog['breed'][0]))->whereIn('id',$pet_id)->get()->toArray();
	                }
	                elseif(max($dog['breed']) && max($dog['color'])){//dd($dog['breed'][0]);
	                //dd(max($dog["breed"])[0]);
	                //$return = DB::select('select * from pets where breed = ? and id in (select pet_id from pet_details where color = ?),max($dog["breed"][0]), max($dog["color"][0]))')->get();
	                    $pet_id = DB::table('pet_details')->select('pet_id')->where('color', max($dog["color"])[0]);
	                    $return = DB::table('pets')->where('breed',max($dog["breed"])[0])->whereIn('id',$pet_id)->get()->toArray();
	                    //return view('pages.home')->with(['result' => $return]);
	                }
	                else{
	                    return view('pages.home')->with(['result' => '']);
	                }
	            }else{
	                return view('pages.home')->with(['result' => '']);
	            }
	            //dd($return);
	            //$return[0]->petImg = json_decode($return[0]->petImg);
	            //dd(json_decode($return[0]->petImg));
	            //echo "<pre>"; dd($split_likes); echo "</pre>";
	            foreach($return as $key => $value){
	                //dd($return[$key]->petImg);
	                $return[$key]->petImg = json_decode($return[$key]->petImg);
	            }

	            return view('pages.homerec')->with(['result' => $return]);
            //return view('search.recommendation')->with(['result' => $return]);
            }
        else{
            return view('pages.home');
        }
			}
    }
}
