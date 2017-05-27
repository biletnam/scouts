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

	/**
	 * @return array
	 **/
	protected function byTak() {
		return [
			'kapoenen'	=> Tak::where('name', 'Kapoenen')->first()->members()
								->orderBy('year')->orderBy('firstname')->get(),
			'welpen'	=> Tak::where('name', 'Welpen')->first()->members()
								->orderBy('year')->orderBy('firstname')->get(),
			'jojos'		=> Tak::where('name', 'Jojo\'s')->first()->members()
								->orderBy('year')->orderBy('firstname')->get(),
			'givers'	=> Tak::where('name', 'Givers')->first()->members()
								->orderBy('year')->orderBy('firstname')->get(),
			'jins'		=> Tak::where('name', 'Jins')->first()->members()->orderBy('year')->orderBy('firstname')->get(),
			'leiding'	=> self::where([['leiding', '=', 1], ['email', '!=', 'leiding@18bp.be']])
								->orderBy('year')->orderBy('firstname')->get(),
		];
	}

	/**
	 * @param string $query
	 * @return string
	 **/
	protected function getAjax($query) {
		$members = Member::select('id', DB::raw('CONCAT(firstname, " ", name) AS text'))
						->where('firstname', 'LIKE', '%'.$query.'%')
						->orWhere('name', 'LIKE', '%'.$query.'%')
						->get();
		return json_encode($members);
	}
}
