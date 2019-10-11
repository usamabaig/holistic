<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

use App\Http\Responses\BaseResponse;

class UserResponse extends BaseResponse {

    public function prepareUserResponse($user) {
        $response = [];
        $response['id'] = $user['uuid'];
        $response['user_token'] = $user['user_token'];
        $response['stripe_id'] = !empty($user['stripe_id']) ? $user['stripe_id'] : '';
        $response['full_name'] = $user['full_name'];
        $response['phone_no'] = $user['phone_no'];
        $response['image'] = !empty($user['profile']['image']) ? $this->getImageUtils()->s3_image_paths['home_url'] . $this->getImageUtils()->s3_image_paths['profile_image'] . $user['profile']['image'] : $this->getImageUtils()->placeholders['user_placeholder'];
        $response['email'] = $user['email'];
        $response['default_currency'] = !empty($user['default_currency']) ? $user['default_currency'] : '';
        $response['is_verified'] = $user['is_verified'];
        $response['is_email_confirmed'] = $user['is_email_confirmed'];
        $response['notifications'] = !empty($user['settings']) ? $user['settings']['push_notification'] : 0;
        $response = $this->profileResponse($response, $user['profile']);
        return $response;
    }

    public function profileResponse($response, $user) {
        $response['lat'] = $user['lat'];
        $response['lng'] = $user['lng'];
        $response['city'] = $user['city'] != null ? $user['city'] : '';
        $response['state'] = $user['state'] != null ? $user['state'] : '';
        $response['zip_code'] = $user['zip_code'] != null ? $user['zip_code'] : '';
        $response['country'] = $user['country'] != null ? $user['country'] : '';
        $response['location_origin_type'] = $user['location_origin_type'] != null ? $user['location_origin_type'] : '';
        if (isset($user['settings'])) {
            $response['notifications'] = $user['settings']['push_notification'];
        }
        return $response;
    }

}
