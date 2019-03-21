<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
 
            $params = "first_name,last_name,age_range,gender,posts.limit(500).until(now).since(2010-01-01){message,created_time}";
 
            $user = $this->api->get('/me?fields='.$params)->getGraphUser();
            $result = json_decode($user);
            dd($result);
 
        } catch (FacebookSDKException $e) {
 
        }
 
    }
}
