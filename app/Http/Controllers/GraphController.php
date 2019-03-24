<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FacebookLog;
use DB;

class GraphController extends Controller
{
    private $api;
    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
            $fb->setDefaultAccessToken(Auth::user()->token);
            $this->api = $fb;
            return $next($request);
        });
    }
 
    public function retrieveUserProfile(){
        try {
            // $params = "first_name,last_name,age_range,gender,posts.limit(500).until(now).since(2010-01-01){message,created_time},likes{description}";
 
            // $user = $this->api->get('/me?fields='.$params)->getGraphUser();
            // $result = json_decode($user);
            // dd($result->first_name);

            $responsePosts = $this->api->get('/me/feed?fields=id,message,created_time'); //user posts
            $responseLikes = $this->api->get('/me/likes?fields=id,description');

            $feedEdgePosts = $responsePosts->getGraphEdge();
            $feedEdgeLikes = $responseLikes->getGraphEdge();
            $result = [];

            $maxPage = 5;
            $pageCount = 0;
            
            do{
                foreach ($feedEdgePosts as $status) {
                    //$result[] = json_decode($status);//->asArray();
                    $result[] = $status->asArray();
                }
            } while($feedEdgePosts = $this->api->next($feedEdgePosts));
            // user posts
            $user_posts = [];
            foreach($result as $value){
                if(isset($value['message'])){
                    //echo "<pre>" . $value['message'] . "</pre>";
                    //$serial[] = serialize($value['message']);
                    $user_posts[] = $value['message'];
                }
            }
            //echo "<pre>"; print_r($result); "</pre>";
            $result = [];
            do{
                foreach ($feedEdgeLikes as $status) {
                    //$result[] = json_decode($status);//->asArray();
                    $result[] = $status->asArray();
                }
            } while($feedEdgeLikes = $this->api->next($feedEdgeLikes));     
            
            // user likes
            $user_likes = [];
            foreach($result as $value){
                if(isset($value['description'])){
                    //echo "<pre>" . $value['description'] . "</pre>";
                    $user_likes[] = $value['description'];
                }
            }
            $jsonPosts = json_encode($user_posts);
            $jsonLikes = json_encode($user_likes);
            $facebooklog = FacebookLog::where('user_posts',$jsonPosts)->where('user_likes',$jsonLikes)->get()->toArray();
            // $logs = FacebookLog::where('user_id','=',Auth::user()->id)->get()->toArray();
            // if(isset($logs[0])){
            //     if(unserialize($logs[0]['user_posts']) != unserialize($jsonPosts)){
                    
            //         var_dump(unserialize($logs[0]['user_posts']));
            //     }
            //     else{

            //     }
            // }
            
            if(!$facebooklog){
                $facebook = FacebookLog::where('user_id',Auth::user()->id)
                                ->update([
                                    'user_posts' => $jsonPosts,
                                    'user_likes' => $jsonLikes
                                    ]);
                echo "lol";
            }
            else{
                echo "bitch";
                $log = FacebookLog::create([
                    'user_posts' => $jsonPosts,
                    'user_likes' => $jsonLikes,
                    'user_id' => Auth::user()->id
                ]);
                $log->save();
            }
            // }
            //echo "<pre>"; print_r($result); "</pre>";
        } catch (FacebookSDKException $e) {
 
        }
        //return redirect()->to("/user/view");
    }
    public function viewLog(){
        $logs = FacebookLog::where('user_id',Auth::user()->id)->get()->toArray();
        //dd(Auth::user()->id);
        if(!isset($logs[0]) && !isset($logs[0])){
            echo "<pre id='err'></pre>";
            ?>
            <script>
                var prompt = confirm('You need to fetch data first. Fetch now?');
                var err = document.getElementById('err');
                if(prompt){
                    err.innerHTML = "Fetching data... This might take a while";    
                    window.location.href="/user";
                }
                
            </script>

            <?php
        }else{
            $posts_logs = json_decode($logs[0]['user_posts']);
            $likes_logs = json_decode($logs[0]['user_likes']);
            
            //dd($posts_logs);
            $data = [
                    'posts_logs' => $posts_logs,
                    'likes_logs' => $likes_logs
            ];
            //dd($data);
            // echo "<pre>"; print_r(unserialize($logs[0]['user_likes'])); "</pre>";
            return view('pages.facebooklog')->with(['data'=>$data]);
        }
        
        
    }

    public function recommend(){
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
            'color' => ['white', 'black', 'brown', 'mix'],
        
        ]);
        file_put_contents('dog_profile.txt',$dog_profile);
        $jso=json_decode($dog_profile);
        //dd($jso->breed);
        //dd(json_decode(file_get_contents('posts_test.txt')));
        $fb = FacebookLog::where('user_id',Auth::user())
                        ->where('split_posts',$posts)
                        ->orWhere('split_likes',$likes)->get()->toArray();
        if($fb){
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
                'labrador' => []
            ],
            'color' => [
                'white' => [],
                'black' => [],
                'brown' => []
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
                        $breedCount++;
                    }
                    if($jso->color[$i] == strtolower($split_posts[$j][$x])){
                            array_push($dog['color'][strtolower($split_posts[$j][$x])], strtolower($split_posts[$j][$x]));
                        $colorCount++;
                    }
                }
            }
            for($j = 0 ; $j < count($split_likes) ; $j++){
                //echo "<pre>"; print_r($split[0]);"</pre>";
                for($x = 0 ; $x < count($split_likes[$j]) ; $x++){
                    //echo $split_posts[$i][$x]."<br>";
                    if($jso->breed[$i] == strtolower($split_likes[$j][$x])){
                        echo "<pre>".$split_posts[$j][$x]."</pre>";
                        $breedCount++;
                    }
                    if($jso->color[$i] == strtolower($split_likes[$j][$x])){
                        echo "<pre>".$split_likes[$j][$x]."</pre>";
                        $colorCount++;
                    }
                }
            }
        }
        //dd(max($dog['color'])[0]);
        //$return = DB::select('select * from pets where breed = ? and id in (select pet_id from pet_details where color = ?),max($dog["breed"][0]), max($dog["color"][0]))')->get();
        $pet_id = DB::table('pet_details')->select('pet_id')->where('color', max($dog["color"])[0]);
        $return = DB::table('pets')->where('breed',max($dog["breed"])[0])->whereIn('id',$pet_id)->get();
        dd($return);
        //echo "<pre>"; dd($split_likes); echo "</pre>";
    }
}