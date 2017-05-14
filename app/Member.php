<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Excel;

class Member extends Model
{
	protected $fillable = ['firstname', 'name', 'birthdate', 'address', 'zip', 'city', 'tel', 'gsm', 'email', 'tak_id', 'paid', 'year'];
	public $timestamps = false;

	public function contacts() {
		return $this->belongsToMany('App\Contact', 'member_contacts');
	}

	public function tak() {
		return $this->belongsTo('App\Tak');
	}

	protected function byTak() {
		return [
			'kapoenen'	=> Tak::where('name', 'Kapoenen')->first()->members,
			'welpen'	=> Tak::where('name', 'Welpen')->first()->members,
			'jojos'		=> Tak::where('name', 'Jojo\'s')->first()->members,
			'givers'	=> Tak::where('name', 'Givers')->first()->members,
			'jins'		=> Tak::where('name', 'Jins')->first()->members,
			'leiding'	=> self::where('leiding', 1)->get(),
		];
	}

	protected function getAjax($query) {
		$members = Member::select('id', DB::raw('CONCAT(firstname, " ", name) AS text'))
						->where('firstname', 'LIKE', '%'.$query.'%')
						->orWhere('name', 'LIKE', '%'.$query.'%')
						->get();
		return json_encode($members);
	}
}
