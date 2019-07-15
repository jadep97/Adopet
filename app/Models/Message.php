<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = [
		'chat_id',
		'sender',
		'text'
	];

	public function chats()
	{
		return $this->belongsTo(Chat::class);
	}

}
