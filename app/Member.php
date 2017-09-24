<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Excel;

/**
 *
 * @property string firstname
 * @property string lastname
 * @property string birthdate
 * @property string address
 * @property string zip
 * @property string city
 * @property string tel
 * @property string gsm
 * @property string email
 * @property int tak_id
 * @property boolean paid
 * @property int year
 *
 * @property Contact[] contacts
 * @property Tak tak
 */

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

	public function toNextTak() {
		switch ($this->tak->name) {
			case 'Kapoenen':
				$this->tak_id = Tak::where('name', 'Welpen')->first()->id;
				break;;
			case 'Welpen':
				$this->tak_id = Tak::where('name', 'Jojo\'s')->first()->id;
				break;
			case 'Jojo\'s':
				$this->tak_id = Tak::where('name', 'Givers')->first()->id;
				break;
			case 'Givers':
				$this->tak_id = Tak::where('name', 'Jins')->first()->id;
				break;
			case 'Jins':
				$this->tak_id = Tak::where('name', 'Leiding')->first()->id;
				break;
		}
		$this->year = 1;
		$this->save();
	}

	public function toPreviousTak() {
		switch ($this->tak->name) {
			case 'Welpen':
				$this->tak_id = Tak::where('name', 'Kapoenen')->first()->id;
				$this->year = 2;
				break;
			case 'Jojo\'s':
				$this->tak_id = Tak::where('name', 'Welpen')->first()->id;
				$this->year = 3;
				break;
			case 'Givers':
				$this->tak_id = Tak::where('name', 'Jojo\'s')->first()->id;
				$this->year = 3;
				break;
			case 'Jins':
				$this->tak_id = Tak::where('name', 'Givers')->first()->id;
				$this->year = 3;
				break;
			case 'Leiding':
				$this->tak_id = Tak::where('name', 'Jins')->first()->id;
				$this->year = 1;
				break;
		}
		$this->save();
	}
}
