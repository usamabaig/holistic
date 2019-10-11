<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

Class LoginUtils extends BaseUtility {

    /**
     * validateRequest request method validate the user request
     * @return type
     */
    public function loginUser() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->login_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'login_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        return $this->attemptLogin($request_params);
    }

    /**
     * attemptLogin method make attempt of login against credential
     * @param type $request_params
     * @return type
     */
    public function attemptLogin($request_params) {
        $credentials = ['phone_no' => $request_params['phone_no'], 'password' => $request_params['password'], 'user_role_id' => 1];
        if (!Auth::attempt($credentials)) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['invalid_login_details']);
        }
        $user = Auth::user()->toArray();
        if ($user['user_role_id'] != 1) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['invalid_login_details']);
        }
        if ($user['is_archive'] == 1) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['account_suspended']);
        }
        $user_data = $this->processLogin($user, $request_params);
        $data['user'] = $this->getUsersResponse()->prepareUserResponse($user_data);
        return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['login_success'], $data);
    }

    /**
     * processLogin method
     * @param type $user
     * @param type $inputs
     * @param type $version
     * @return type
     */
    public function processLogin($user, $request_params) {
        
        $update_device = $this->getUserDeviceService()->processDeviceData($request_params, $user);
      
        $login_status = $this->updateLoginStatus($user, $request_params);
        $this->updateGeoLocation($request_params, $user);
        if ($update_device && $login_status) {
            $user_data = $this->getUserModel()->getUserByColumnValue('id', $user['id']);
        }
        return $user_data;
    }

    /**
     * update geo-locations as user logs in to the system
     * @param type $request_params
     * @param type $user
     * @return type
     */
    public function updateGeoLocation($request_params, $user) {
        if ((isset($request_params['lat']) && isset($request_params['lng'])) && (!empty($request_params['lat']) && ($request_params['lng']))) {
            $profile_data['lat'] = !empty($request_params['lat']) ? $request_params['lat'] : NULL;
            $profile_data['lng'] = !empty($request_params['lng']) ? $request_params['lng'] : NULL;
            $profile_data['zip_code'] = !empty($request_params['zip_code']) ? $request_params['zip_code'] : NULL;
            $profile_data['city'] = !empty($request_params['city']) ? $request_params['city'] : NULL;
            $profile_data['state'] = !empty($request_params['state']) ? $request_params['state'] : NULL;
            $profile_data['country'] = !empty($request_params['country']) ? $request_params['country'] : NULL;
            $profile_data['location_origin_type'] = !empty($request_params['location_origin_type']) ? $request_params['location_origin_type'] : 'network';
            return $this->getUserProfileModel()->where('user_id', '=', $user['id'])->where('type', '=', 'current')->update($profile_data);
        } else {
            return $this->updateUserLocationWithIp($user);
        }
        return true;
    }

    public function updateUserLocationWithIp($user) {
        $geo_loc = $this->getLocationUtils()->getUserGeolocation();
        if (!empty($geo_loc['lat']) && !empty($geo_loc['lng'])) {
            $geo_loc['location_origin_type'] = 'network';
            return $this->getUserProfileModel()->where('user_id', '=', $user['id'])->where('type', '=', 'current')->update($geo_loc);
        }
        return true;
    }

    /**
     * 
     * @param type $user
     * @param type $request_params
     * @return type
     */
    public function updateLoginStatus($user, $request_params) {
        $info_arr = [];
        $info_arr['is_login'] = 1;
        $info_arr['language'] = $request_params['lang'];
        $info_arr['user_token'] = Hash::make(time());
        $info_arr['version'] = config('paths.current_api_version');
        return $this->getUserModel()->updateUserByColumnValue('id', $user['id'], $info_arr);
    }

    /**
     * logout method
     * @return type
     */
    public function logout() {
        $request_params = Request::all();
        $headers = apache_request_headers();
        if (isset($headers['USERTOKEN'])) {
            $user = $this->getUserModel()->getUserByColumnValue('user_token', $headers['USERTOKEN']);
            if (empty($user)) {
                return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['user_not_found']);
            }
            $info_arr['is_login'] = 0;
            $logout = $this->getUserModel()->updateUserByColumnValue('id', $user['id'], $info_arr);
        }
        $logout = true;
        if ($logout) {
            return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['logout']);
        }
    }

}
