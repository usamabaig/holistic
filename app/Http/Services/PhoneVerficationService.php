<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Models\PhoneNumberVerification;

class PhoneVerificationService extends BaseService {

    public function getVerificationModel() {
        return new PhoneNumberVerification();
    }

    /**
     * phoneNumberVerification method
     * @param type $request_params
     * @return type
     */
    public function phoneNumberVerification($request_params) {
        $phone_data = $this->getVerificationModel()->getConfirmationCode($request_params);
        if (!empty($phone_data)) {
            return true;
        }
        return false;
    }

    /**
     * checkVerficationValidity method
     * @param type $phone_data
     * @return type
     */
    public function checkVerficationValidity($phone_data) {
        $created_time = strtotime($phone_data['created_at']);
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $time = $current_time - $created_time;
        return $time;
    }

    /**
     * updateVerificationCodeStatus method
     * @param type $request_params
     * @return type
     */
    public function updateVerificationCodeStatus($request_params) {
        //PREPARING PHONE VERFICATION DATA 
        $update_data['status'] = 0;
        $update_data['phone_no'] = $request_params['phone_no'];
        return $this->getVerificationModel()->updatePhoneVerification($update_data);
    }

}
