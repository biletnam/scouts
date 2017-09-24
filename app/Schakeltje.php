<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schakeltje extends Model
{
	const EXCEPTION_MONTHS = [10,11,12];
    protected $fillable = ['title', 'url', 'archived', 'created_at', 'updated_at'];

	public function getStartingYear()
	{
		$date = new Carbon($this->created_at);
		$year = intval($date->year);
		if (!in_array(intval($date->month), self::EXCEPTION_MONTHS)) {
			$year--;
		}
		return $year;
	}
}
