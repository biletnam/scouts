<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tak extends Model
{
    protected $table = 'takken';
    public $timestamps = false;

    public function leaders() {
        return User::select('users.*', 'members.firstname', 'members.name', 'members.address', 'members.zip', 'members.city', 'members.gsm', 'members.tel')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('members', 'users.member_id', '=', 'members.id')
                    ->where('user_roles.role_id', 5)
                    ->where('tak_id', $this->id)->get();
    }

    public function takleiding() {
        return User::select('users.*', 'members.firstname', 'members.name', 'members.address', 'members.zip', 'members.city', 'members.gsm', 'members.tel')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('members', 'users.member_id', '=', 'members.id')
                    ->where('user_roles.role_id', 4)
                    ->where('tak_id', $this->id)->first();
    }
}
