<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [

        'comment',
        'user_id',
        'pet_id'
        
    ];

    public function pet(){
        
        return $this->hasOne(Pet::class);

    }

    public function user(){
        
        return $this->belongsTo(User::class);
        
    }
}
