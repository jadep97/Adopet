<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'email',
				'first_name',
				'last_name',
				'gender',
				'username',
				'password',
				'token'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function facebookLog(){
        return $this->hasOne(FacebookLog::class);
    }


		public function likes()
		{
			return $this->hasMany(Likes::class);
		}

		public function comments()
		{
			return $this->hasMany(Comments::class);
		}


}
