<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'nickname', 'show_nick', 'img', 'active', 'member_id', 'tak_id', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function getExt() {
        return User::select('users.*', 'members.firstname', 'members.name', 'members.address', 'members.zip', 'members.city', 'members.gsm', 'members.tel')
                    ->join('members', 'members.id', '=', 'users.member_id')
                    ->get();
    }
}
