<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	public $timestamps = false;
	protected $fillable = ['name', 'tel', 'gsm', 'email', 'member_id'];

	public function member() {
		return hasOne('App\Member');
	}
}
