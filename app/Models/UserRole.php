<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRole extends Authenticatable {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Table information 
     *
     * @var array
     */
    protected $table = 'user_roles';
    protected $primarykey = 'id';

    /**
     * All the database function goes here
     *
     * 
     */
    public function getRoleByName($name) {
        return UserRole::where('name', '=', $name)->where('is_archive', '=', 0)->first();
    }

}
