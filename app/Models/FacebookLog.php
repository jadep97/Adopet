<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookLog extends Model
{
    protected $table = "facebook_user_log";
    protected $fillable = [
        'user_posts', 'user_likes', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
