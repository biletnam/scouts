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

    public $timestamps = false;
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
        return User::select('users.*', 'members.firstname', 'members.name', 'members.address',
                            'members.zip', 'members.city', 'members.gsm', 'members.tel')
                    ->join('members', 'members.id', '=', 'users.member_id')
                    ->get();
    }

    protected function getPerRole() {
        $roles = Role::get();
        $result = [];
        foreach ($roles as $role) {
            $users = User::select('users.*', 'members.firstname', 'members.name')
                            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                            ->join('members', 'users.member_id', '=', 'members.id')
                            ->where('user_roles.role_id', $role->id)->get();
            $result[$role->name] = $users;
        }
        return $result;
    }

    public function member() {
        return Member::find($this->member_id);
    }

    public function roles() { return $this->belongsToMany('App\Role', 'user_roles'); }

    public function addRole($role_id) { $this->roles()->attach($role_id); }

    public function dropRole($role_id) { $this->roles()->detach($role_id); }

    public function hasPermission($permission) {
        foreach ($this->roles as $role) {
        	$result = $role->hasPermission($permission);
            if ($result) { return true; }
        }
        return false;
    }
}
