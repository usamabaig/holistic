<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Request;

class CodeValidationUtils extends BaseUtility {

    /**
     * checkVerificationCode validate request pramas and check code availability
     * @return type
     */
    public function checkVerificationCode() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->check_verification_code, $this->getRulesUtils()->selectLanguageForMessages('check_verification_code', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        $verficationCode = $this->getVerificationModel()->getConfirmationCode($request_params);
        if (empty($verficationCode)) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['verification_code_invalid']);
        }
        return $this->validationProcess($request_params, $verficationCode);
    }

    /**
     * validationProcess checks the code time and then return a status
     * @param type $request_params
     * @param type $verficationCode
     * @return type
     */
    public function validationProcess($request_params, $verficationCode) {
        $created_time = strtotime($verficationCode['created_at']);
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $time = $current_time - $created_time;
        if ($time > 7200) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['verification_code_expired']);
        }
        return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['number_confirmation']);
    }

}
