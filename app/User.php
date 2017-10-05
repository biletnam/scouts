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

    /**
     * @return User
     **/
    protected function getExt() {
        return User::select('users.*', 'members.firstname', 'members.name', 'members.address',
                            'members.zip', 'members.city', 'members.gsm', 'members.tel')
                    ->join('members', 'members.id', '=', 'users.member_id')
                    ->get();
    }

    /**
     * @return array
     **/
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

    public function member() { return $this->belongsTo('App\Member'); }

	public function tak() { return $this->belongsTo('App\Tak'); }

    public function roles() { return $this->belongsToMany('App\Role', 'user_roles'); }

    /**
     * @param int $role_id
     **/
    public function addRole($role_id) { $this->roles()->attach($role_id); }

    /**
     * @param int $role_id
     **/
    public function dropRole($role_id) { $this->roles()->detach($role_id); }

    /**
     * @return bool
     **/
    public function grl() {
        foreach ($this->roles as $role) {
            if ($role->name === 'groepsleiding') {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $permission
     * @return bool
     **/
    public function hasPermission($permission) {
        foreach ($this->roles as $role) {
        	$result = $role->hasPermission($permission);
            if ($result) { return true; }
        }
        return false;
    }
}
