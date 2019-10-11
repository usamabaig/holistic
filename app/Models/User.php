<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primarykey = 'id';
    protected $fillable = ['uuid', 'user_token', 'user_role_id', 'user_name', 'full_name', 'is_archive', 'email', 'phone_no', 'password', 'is_verified', 'version', 'language', 'stripe_id', 'default_currency'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $guarded = [];

    /**
     * All the database relations goes here
     *
     * @var array
     */
    public function orders() {
        return $this->hasMany('App\Http\Models\Order', 'created_by_id', 'id');
    }

    public function trips() {
        return $this->hasMany('App\Http\Models\Trip', 'user_id', 'id');
    }

    public function profile() {
        return $this->hasOne('App\Http\Models\UserProfile', 'user_id', 'id')->where('type', '=', 'current');
    }

    public function device() {
        return $this->hasOne('App\Http\Models\UserDevice', 'user_id', 'id');
    }

    public function settings() {
        return $this->hasOne('App\Http\Models\NotificationSetting', 'user_id', 'id');
    }

    /**
     * All the database function goes here
     *
     * @var array
     */
    public function saveNewUser($inputs) {
        $user = new User($inputs);
        if ($user->save()) {
            return $user;
        }
        return false;
    }

    public function getUserByColumnValue($column, $value) {
        $data = $this->where($column, '=', $value)->where('user_role_id', '=', 1)->with('profile')->with('settings')->first();
        return !empty($data) ? $data->toArray() : [];
    }

    public function getCarrierByColumnValue($column, $value) {
        $data = $this->where($column, '=', $value)->with('profile')->with('settings')->first();
        return !empty($data) ? $data->toArray() : [];
    }

    public function updateUserByColumnValue($cloumn, $value, $data) {
        return $this->where($cloumn, '=', $value)->update($data);
    }

    public function getIdleCarriers($lat, $lng) {
        $data = $this->where('is_login', 1)->where('user_role_id', 2)
                        ->whereHas('profile', function ($sql) use ($lat, $lng) {
                            $sql->selectRaw("(6371 * acos( cos( radians(" . $lat . ") ) *
                                cos( radians(lat) ) *
                                cos( radians(lng) - radians(" . $lng . ") ) + 
                                sin( radians(" . $lat . ") ) *
                                sin( radians(lat) ) ) ) 
                                AS distance"
                            )
                            ->having("distance", "<=", 50)
                            ->orderBy("distance", "ASC");
                        })
                        ->whereHas('settings', function ($sql) {
                            $sql->where('push_notification', 1);
                        })->with('device')->get();
        return !empty($data) ? $data->toArray() : [];
    }

}
