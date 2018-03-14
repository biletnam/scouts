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

	public function formatPhone()
	{
		$number = str_replace('+','00', $this->tel);
		$number =  preg_replace('/\D/', '', $number);
		return $number;
	}

	public function formatMobile()
	{
		$number = str_replace('+','00', $this->gsm);
		$number =  preg_replace('/\D/', '', $number);
		return $number;
	}
}
