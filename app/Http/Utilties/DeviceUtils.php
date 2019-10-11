<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\UserDevice;

class DeviceUtils {

    protected $user_device;

    function __construct(UserDevice $device) {
        $this->user_device = $device;
    }

    /**
     * updateDeviceData method
     * @param type $inputss
     * @param type $user
     * @param type $version
     * @return type
     */
    public function updateDeviceData($inputs, $user) {
        // PREPARING DEVICE DATA
        $device = $this->user_device->getUserDeviceByUser($user['id']);
        $device_data = [];
        $device_data['id'] = $device['id'];
        $device_data['device_type'] = $inputs['device_type'];
        $device_data['device_token'] = $inputs['device_token'];
        return $this->user_device->updateUserDevice($device_data);
    }

}
