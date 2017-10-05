<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	public $timestamps = false;
	protected $fillable = ['name', 'tel', 'gsm', 'email'];

	public function members() {
		return $this->belongsToMany('App\Member', 'member_contacts');
	}
}
