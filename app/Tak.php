<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tak extends Model
{
    protected $table = 'takken';
    public $timestamps = false;

    public function leaders() {
	    return $this->hasMany('App\User')->where('active', 1);
    }

    public function takleiding() {
        return User::select('users.*', 'members.firstname', 'members.name', 'members.address', 'members.zip', 'members.city', 'members.gsm', 'members.tel')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('members', 'users.member_id', '=', 'members.id')
                    ->where('roles.name', 'takleiding')
                    ->where('users.tak_id', $this->id)->first();
    }

    public function members() {
    	return $this->hasMany('App\Member')->where('leiding', 0);
    }
}
