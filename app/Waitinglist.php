<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waitinglist extends Model
{
    protected $fillable = ['firstname', 'name', 'birthdate', 'address', 'zip', 'city', 'tel', 'gsm', 'email', 'tak', 'priority', 'year'];
    public $timestamps = false;
    protected $table = 'waitinglist';

    /**
     * @return array
     **/
    protected function byTak() {
        return [
                'kapoenen' => [
                    'priority'  => self::where(['tak' => 'Kapoenen', 'priority' => 1])->get(),
                    'regular'   => self::where(['tak' => 'Kapoenen', 'priority' => 0])->get()
                ],
                'welpen' => [
                    'priority'  => self::where(['tak' => 'Welpen', 'priority' => 1])->get(),
                    'regular'   => self::where(['tak' => 'Welpen', 'priority' => 0])->get()
                ],
                'jojos' => [
                    'priority'  => self::where(['tak' => 'Jojo\'s', 'priority' => 1])->get(),
                    'regular'   => self::where(['tak' => 'Jojo\'s', 'priority' => 0])->get()
                ],
                'givers' => [
                    'priority'  => self::where(['tak' => 'Givers', 'priority' => 1])->get(),
                    'regular'   => self::where(['tak' => 'Givers', 'priority' => 0])->get()
                ]
        ];
    }

	public function toNextTak() {
		switch ($this->tak) {
			case 'Kapoenen':
				$this->tak = 'Welpen';
				break;;
			case 'Welpen':
				$this->tak = 'Jojo\'s';
				break;
			case 'Jojo\'s':
				$this->tak = 'Givers';
				break;
			case 'Givers':
				$this->tak = 'Jins';
				break;
			case 'Jins':
				$this->tak = 'Leiding';
				break;
		}
		$this->year = 1;
		$this->save();
	}

	public function toPreviousTak() {
		switch ($this->tak) {
			case 'Welpen':
				$this->tak = 'Kapoenen';
				$this->year = 2;
				break;
			case 'Jojo\'s':
				$this->tak = 'Welpen';
				$this->year = 3;
				break;
			case 'Givers':
				$this->tak = 'Jojo\'s';
				$this->year = 3;
				break;
			case 'Jins':
				$this->tak = 'Givers';
				$this->year = 3;
				break;
			case 'Leiding':
				$this->tak = 'Jins';
				$this->year = 1;
				break;
		}
		$this->save();
	}
}
