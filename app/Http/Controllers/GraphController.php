<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FacebookLog;

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
                //$pageCount++;
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
            echo "<pre>"; print_r($result); "</pre>";
            $result = [];
            do{
                foreach ($feedEdgeLikes as $status) {
                    //$result[] = json_decode($status);//->asArray();
                    $result[] = $status->asArray();
                }
                //$pageCount++;
            } while($feedEdgeLikes = $this->api->next($feedEdgeLikes));     
            
            // user likes
            foreach($result as $value){
                if(isset($value['description'])){
                    //echo "<pre>" . $value['description'] . "</pre>";
                    $user_likes[] = $value['description'];
                }
            }
            $serializePosts = serialize($user_posts);
            $serializeLikes = serialize($user_likes);
            $log = FacebookLog::create([
                'user_posts' => $serializePosts,
                'user_likes' => $serializeLikes,
                'user_id' => Auth::user()->id
            ]);
            $log->save();
            //echo "<pre>"; print_r($result); "</pre>";
        } catch (FacebookSDKException $e) {
 
        }
        return redirect()->to("/user/view");
    }
    public function viewLog(){
        $logs = FacebookLog::where('user_id','=',Auth::user()->id)->get()->toArray();
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
            $posts_logs = unserialize($logs[0]['user_posts']);
            $likes_logs = unserialize($logs[0]['user_likes']);

            //dd($posts_logs);
            $data = [
                [
                    'posts_logs' => $posts_logs,
                    'likes_logs' => $likes_logs
                ]
            ];
            //dd($data);
            // echo "<pre>"; print_r(unserialize($logs[0]['user_likes'])); "</pre>";
            return view('pages.facebooklog')->with(['data'=>$data]);
        }
        
        
    }
}
