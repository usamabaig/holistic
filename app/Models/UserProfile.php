<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    protected $table = 'user_profiles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'lat', 'lng', 'state', 'zip_code', 'city', 'country', 'country_iso', 'image', 'type', 'location_origin_type'
    ];

    /**
     * All the database relations  goes here
     *
     * @var array
     */
    public function user() {
        return $this->belongsTo('App\Http\Models\User', 'user_id', 'id');
    }

    /**
     * All the database function goes here
     *
     * @var array
     */
    public function saveProfile($data = null) {
        $profile = new UserProfile($data);
        if ($profile->save()) {
            return $profile;
        }
    }

    public function getUserProfileByColumnValue($column, $value) {
        $profile = UserProfile::where('is_archive', '=', 0)->where('type', '=', 'current')->where($column, '=', $value)->first();
        return !empty($profile) ? $profile->toArray() : [];
    }

    public function updateProfileByUserId($user_id, $inputs) {
        return UserProfile::where('user_id', '=', $user_id)->where('type', '=', 'current')->update($inputs);
    }

}
