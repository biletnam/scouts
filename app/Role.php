<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions() {
    	return $this->belongsToMany('App\Permission', 'role_permissions');
    }

    /**
     * @param string $$user_permission
     * @return bool
     **/
    public function hasPermission($user_permission) {
    	foreach ($this->permissions as $permission) {
    		if ($permission->name == $user_permission) { return true; }
	    }
	    return false;
    }
}
