<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waitinglist extends Model
{
    protected $fillable = ['firstname', 'name', 'birthdate', 'address', 'zip', 'city', 'tel', 'gsm', 'email', 'tak', 'priority', 'year'];
    public $timestamps = false;
    protected $table = 'waitinglist';

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
}
