<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;
use App\Http\Models\UserDevice;

class UserDeviceService extends BaseService {

    /**
     * processDeviceData method
     * @param type $request_params
     * @param type $user
     * @param type $user_profile
     * @return type
     */
    public function processDeviceData($request_params, $user) {
       
        if ($request_params['device_token']) {
            $this->getUserDeviceModel()
                    ->updateUserDeviceByCondition('device_token', $request_params['device_token'], ['device_token' => NULL]
            );
        } 
        $user_device_data = UserDevice::where('user_id',$user['id'])->first();
        if(empty($user_device_data)){

            $device = new UserDevice;
            $device->user_id = $user['id'];
            $device->device_type = $request_params['device_type'];
            $device->device_token = $request_params['device_token'];
            return $device->save();
        }
        $device_data['user_id'] = $user['id'];
        $device_data['device_type'] = $request_params['device_type'];
        $device_data['device_token'] = !empty($request_params['device_token']) ? $request_params['device_token'] : NULL;
        return $this->getUserDeviceModel()->updateUserDeviceByCondition('user_id', $user['id'], $device_data);
    }

    /**
     * processDeviceData method
     * @param type $request_params
     * @param type $user
     * @param type $user_profile
     * @return type
     */
    public function createNewDiceData($request_params, $user) {
        $device_data['user_id'] = $user['id'];
        $device_data['device_type'] = $request_params['device_type'];
        $device_data['device_token'] = !empty($request_params['device_token']) ? $request_params['device_token'] : NULL;
        $save_devie = $this->getUserDeviceModel()->saveDevice($device_data);
        if ($save_devie) {
            return $this->processNotificationSettingNew($user['id']);
        }
    }

    /**
     * processNotificationSetting method process settings for user
     * @param type $user_id
     * @return type
     */
    public function processNotificationSetting($user_id) {
        $setting = [
            'user_id' => $user_id,
            'push_notification' => 1,
            'email_notification' => 0,
            'text_notification' => 0
        ];
        return $this->getNotificationModel()->updateUserSetting($setting);
    }

    /**
     * processNotificationSettingNew Method to create new notification settings.
     */
    public function processNotificationSettingNew($user_id) {
        $setting = [
            'user_id' => $user_id,
            'push_notification' => 1,
            'email_notification' => 0,
            'text_notification' => 0
        ];
        return $this->getNotificationModel()->saveSettings($setting);
    }

}
