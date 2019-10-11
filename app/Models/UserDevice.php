<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_devices';
    protected $primarykey = 'id';
    protected $fillable = array('user_id', 'device_type', 'device_token', 'version');

    
    public function saveDevice($inputs) {
        $user_devive = new UserDevice($inputs);
        if ($user_devive->save()) {
            return $user_devive;
        }
        return false;
    }

    public function updateUserDevice($data) {
        return UserDevice::where('id', '=', $data['id'])->update($data);
    }

    public function updateUserDeviceByCondition($column, $value, $data) {
        return UserDevice::where($column, '=', $value)->update($data);
    }

    public function getUserDeviceByUser($id) {
        $data = UserDevice::where('user_id', '=', $id)->first();
        return !empty($data) ? $data->toArray() : [];
    }   
}
