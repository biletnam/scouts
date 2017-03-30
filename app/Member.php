<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Excel;

class Member extends Model
{
    protected $fillable = ['firstname', 'name', 'birthdate', 'address', 'zip', 'city', 'tel', 'gsm', 'email', 'tak', 'paid', 'year'];
    public $timestamps = false;

    protected function byTak() {
        return [
            'kapoenen'  => Tak::where('name', 'Kapoenen')->first()->members,
            'welpen'    => Tak::where('name', 'Welpen')->first()->members,
            'jojos'     => Tak::where('name', 'Jojo\'s')->first()->members,
            'givers'    => Tak::where('name', 'Givers')->first()->members,
            'jins'      => Tak::where('name', 'Jins')->first()->members,
            'leiding'   => self::where('leiding', 1)->get(),
        ];
    }
}
