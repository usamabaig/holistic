<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;

class UserProfileService extends BaseService {

    /**
     * processProfileData method
     * @param type $inputs
     * @param type $user
     * @return type
     */
    public function processProfileData($inputs, $user) {
        if (isset($inputs['location']) && !empty($inputs['location'])) {
            return self::prepareProfileDataWithoutIP($inputs, $user);
        } else {
            return self::prepareProfileDataWithIp($inputs, $user);
        }
    }

    /**
     * prepareProfileData method 
     * @param type $request_params
     * @param type $user
     * @return type
     */
    public function prepareProfileDataWithoutIP($request_params, $user) {
        $user_profile['user_id'] = $user->id;
        $user_profile['lat'] = !empty($request_params['location']['lat']) ? $request_params['location']['lat'] : '';
        $user_profile['lng'] = !empty($request_params['location']['lng']) ? $request_params['location']['lng'] : '';
        $user_profile['city'] = !empty($request_params['location']['city']) ? $request_params['location']['city'] : NULL;
        $user_profile['state'] = !empty($request_params['location']['state']) ? $request_params['location']['state'] : NULL;
        $user_profile['zip_code'] = !empty($request_params['location']['zip_code']) ? $request_params['location']['zip_code'] : NULL;
        $user_profile['country'] = !empty($request_params['location']['country']) ? $request_params['location']['country'] : NULL;
        $user_profile['country_iso'] = !empty($request_params['location']['country_iso']) ? $request_params['location']['country_iso'] : NULL;
        $user_profile['image'] = !empty($request_params['profile_image']) ? $this->uploadProfileImage($request_params) : NULL;
        $user_profile['location_origin_type'] = !empty($request_params['location_origin_type']) ? $request_params['location_origin_type'] : 'user';
        $user_profile['type'] = 'current';
        $save_current_location = $this->getUserProfileModel()->saveProfile($user_profile);
        if ($save_current_location) {
            $user_profile['image'] = NULL;
            $user_profile['type'] = 'signup';
            return $this->getUserProfileModel()->saveProfile($user_profile);
        }
        return true;
    }

    /**
     * updateProfileImage method
     * @param type $request_params
     * @return type
     */
    public function uploadProfileImage($request_params) {

        $file = $this->getImageUtils()->uploadSingleImage($request_params['profile_image'], $this->getImageUtils()->s3_image_paths['profile_image'], $pre_fix = 'Profile_', 's3');


        if (!$file['success']) {
            return $this->getCommonUtils()->jsonErrorResponse(MessageHelper::getMessageData('error', $request_params['lang'])["can't_right_image"]);
        }

        $upload_thumbnails = $this->getImageUtils()->makeProfileThumbnailsUploads($request_params['profile_image'], $file['success']);

        if (!$upload_thumbnails) {

            return $this->getCommonUtils()->jsonErrorResponse(MessageHelper::getMessageData('error', $request_params['lang'])["can't_right_image"]);
        }
        return $file['file_name'];
    }

    /**
     * prepareProfileDataWithIp method
     * @param type $inputs
     * @param type $user
     * @return type
     */
    public function prepareProfileDataWithIp($request_params, $user) {
        $location = $this->getLocationService()->getUserGeolocation();
        if (empty($location) || empty($location['lat']) || empty($location['lng'])) {
            return false;
        }
        return $this->processDataWithIp($request_params, $user, $location);
    }

    /**
     * processDataWithIp method
     * @param type $request_params
     * @param type $user
     * @param type $location
     * @return type
     */
    public function processDataWithIp($request_params, $user, $location) {
        $user_profile['user_id'] = $user['id'];
        $user_profile['lat'] = !empty($location['lat']) ? $location['lat'] : NULL;
        $user_profile['lng'] = !empty($location['lng']) ? $location['lng'] : NULL;
        $user_profile['state'] = !empty($location['state']) ? $location['state'] : NULL;
        $user_profile['city'] = !empty($location['city']) ? $location['city'] : NULL;
        $user_profile['country'] = !empty($location['country']) ? $location['country'] : NULL;
        $user_profile['country_iso'] = !empty($location['country_iso']) ? $location['country_iso'] : NULL;
        $user_profile['zip_code'] = !empty($location['zip_code']) ? $location['zip_code'] : NULL;
        $user_profile['image'] = !empty($request_params['profile_image']) ? $this->uploadProfileImage($request_params):  NULL;
        $user_profile['location_origin_type'] = 'network';
        $user_profile['type'] = 'current';
        $save_current_location = $this->getUserProfileModel()->saveProfile($user_profile);
        if ($save_current_location) {
            $user_profile['image'] = NULL;
            $user_profile['type'] = 'signup';
            return $this->getUserProfileModel()->saveProfile($user_profile);
        }
    }

}
