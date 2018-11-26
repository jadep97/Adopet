<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    //
    use Notifiable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'token',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
