<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilties\BaseUtility;
use Request;

class VerificationCodeUtils extends BaseUtility {

    public function getVerificationCode() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->unique_phone_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'unique_phone_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        return $this->checkApplicationVersion($request_params);
    }

    /**
     * checkApplicationVersion method
     * @param type $request_params
     * @return type
     */
    public function checkApplicationVersion($request_params) {
        $user = $this->getUserModel()->getUserByColumnValue('phone_no', $request_params['phone_no']);
        if (isset($user) && !empty($user)) {
            if ($user['is_archive'] == 1) {
                return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['no_blocked']);
            }
            $data['is_user_exist'] = true;
            return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['user_found'], $data);
        }
        return $this->sendCodeSms($request_params);
    }

    /**
     * sendCodeSms method
     * @param type $request_params
     * @return type
     */
    public function sendCodeSms($request_params) {
        $is_exist = $this->getVerificationModel()->chechkPhoneExistance($request_params);
        if (isset($is_exist) && !empty($is_exist)) {
            $this->getVerificationModel()->deleteRecordById($is_exist['id']);
        }
        $request_params['verification_code'] = $this->codeCreation(4);
        $request_params['message'] = $this->prepareMessageText($request_params['lang'], $request_params['verification_code']);
        if (!empty($request_params['call']) && $request_params['call'] == 'yes') {
            return $this->makeVerificationCall($request_params);
        } else {
            return $this->selectAndSendMessage($request_params);
        }
    }

    /**
     * makeVerificationCall method is responsible for making call to user
     * @param type $request_params
     * @return type
     */
    public function makeVerificationCall($request_params) {
        $file_name = $this->twimlFactory()->makeXMLFile($request_params, 'signup');
        $url = $this->getCommonUtils()->url['twillio_call_url'] . $file_name;
        $make_call = $this->sendCode()->makeCall($url, $request_params['phone_no']);
        if ($make_call) {
            return $this->saveCode($request_params);
        }
    }

    /**
     * selectAndSendMessage method
     * @param type $request_params
     * @return type
     */
    public function selectAndSendMessage($request_params) {
        $phone_lookup = $this->sendCode()->goForLookUp($request_params['phone_no']);
        if ($phone_lookup['success'] == false) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['twillio_lookup_error']);
        }
        $send_code = $this->sendCode()->sendSmsToPhoneNubmer($request_params);
        if ($send_code) {
            return $this->saveCode($request_params);
        }
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['twillio_lookup_error']);
    }

    /**
     * codeCreation method generate unique code
     * @param type $digits
     * @return type
     */
    public function codeCreation($digits = 4) {
        $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        return $code;
    }

    /**
     * prepareMessageText method
     * @param type $code
     * @return string
     */
    public function prepareMessageText($lang, $code) {
        if (isset($lang) && $lang == 'AR') {
            $message = $code . ' هو رمز التحقق Barq الخاص بك ، وسوف تنتهي صلاحيته خلال ساعتين.';
        } else {
            $message = $code . ' is your Barq verification code, and this will expire in 2 hours.';
        }
        return $message;
    }

    /**
     * saveCode method save data to database
     * @param type $request_params
     */
    public function saveCode($request_params) {
        $tabl_data = [];
        $tabl_data['phone_no'] = $request_params['phone_no'];
        $tabl_data['verification_code'] = $request_params['verification_code'];
        $save_data = $this->getVerificationModel()->saveConformationCode($tabl_data);
        if ($save_data) {
            $data['is_user_exist'] = false;
            return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['verifcation_code_sent'], $data);
        }
    }

}
