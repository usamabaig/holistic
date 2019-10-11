<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Http\Utilties\BaseUtility;
use Illuminate\Support\Facades\Validator;
use Request;
use DB;

class ForgotPasswordUtils extends BaseUtility {

    /**
     * forgotPassword method
     * @return type
     */
    public function forgotPassword() {
        $request_params = Request::all();
        $validate = Validator::make($request_params, $this->getRulesUtils()->forgot_password_rules, $this->getRulesUtils()->selectLanguageForMessages('forgot_password_rules', $request_params['lang']));
        if ($validate->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validate->errors()->first());
        }
        return $this->selectForgotPasswordMethod($request_params);
    }

    /**
     * selectForgotPasswordMethod method
     * @param type $request_params
     * @param type $language
     * @return type
     */
    public function selectForgotPasswordMethod($request_params) {
        if (strtolower($request_params['recovery_type']) == 'email') {
            $user_info = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
            if (empty($user_info)) {
                return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['user_not_found']);
            }
            return $this->sendForgotCodeToEmail($request_params, $user_info);
        }
        if (strtolower($request_params['recovery_type']) == 'phone') {
            $user_info = $this->getUserModel()->getUserByColumnValue('phone_no', $request_params['phone_no']);
            if (empty($user_info)) {
                return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['user_not_found']);
            }
            return $this->sendForgotCodeToPhone($request_params, $user_info);
        }
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['user_not_found']);
    }

    /**
     * sendForgotCodeToPhone method
     * @param type $request_params
     * @param type $language
     * @return type
     */
    public function sendForgotCodeToPhone($request_params, $user_info) {
        $reset_code = $this->updateCodeData($user_info);
        if ($reset_code) {
            if (!empty($request_params['call']) && $request_params['call'] == 'yes') {
                return $this->makeCallToPhone($request_params, $reset_code);
            } else {
                return $this->sendSmsToPhone($request_params, $reset_code, $user_info);
            }
        }
    }

    /**
     * makeCallToPhone method is responsible for making call to phone
     * @param type $request_params
     * @param type $reset_code
     * @return type
     */
    public function makeCallToPhone($request_params, $reset_code) {
        $call_data['phone_no'] = $request_params['phone_no'];
        $call_data['verification_code'] = $reset_code;
        $file_name = $this->twimlFactory()->makeXMLFile($call_data);
        $url = $this->getCommonUtils()->url['twillio_call_url'] . $file_name;
        $make_call = $this->sendCode()->makeCall($url, $request_params['phone_no']);
        if ($make_call) {
            DB::commit();
            return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['verifcation_code_sent']);
        }
        DB::rollback();
        return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['general_error']);
    }

    /**
     * sendSmsToPhone method is responsible for sending message to phone
     * @param type $request_params
     * @param type $reset_code
     * @return type
     */
    public function sendSmsToPhone($request_params, $reset_code, $user_info) {
        $message_data['message'] = $this->prepareMessageDataForgot($request_params['lang'], $reset_code);
        $message_data['phone_no'] = $request_params['phone_no'];
        $message_data['country_iso'] = !empty($user_info->profile->country_iso) ? $user_info->profile->country_iso : '';
        $send_code = $this->sendCode()->sendSmsToPhoneNubmer($message_data);
        if ($send_code) {
            DB::commit();
            return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['verifcation_code_sent']);
        }
    }

    /**
     * sendRecoveryMessageToEmail method
     * @param type $request_params
     * @param type $user_info
     * @param type $reset_code
     * @param type $language
     * @return type
     */
    public function sendForgotCodeToEmail($request_params, $user_info) {
        $reset_code = $this->updateCodeData($user_info);
        if ($reset_code) {
            $email_data = [
                'subject' => 'Reset Password',
                'name' => $user_info['full_name'],
                'email' => $user_info['email'],
                'reset_code' => $reset_code
            ];
            $send_mail = $this->getCommonUtils()->sendEmail('forgot_password', $email_data);
            if ($send_mail) {
                DB::commit();
                return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['reset_code_sent_to_email']);
            }
        }
    }

    /**
     * prepareMessageDataForgot method
     * @param type $language
     * @param type $reset_code
     * @return string
     */
    public function prepareMessageDataForgot($language, $reset_code) {
        if (isset($language) && $language == 'AR') {
            $message = $reset_code . ' هو رمز التحقق Barq الخاص بك ، وسوف تنتهي صلاحيته خلال ساعتين.';
        } else {
            $message = $reset_code . ' is your Barq verification code, and this will expire in 2 hours.';
        }
        return $message;
    }

    /**
     * updateCodeData method is responsible to update reset_code to database
     * @param type $user_info
     * @return type
     */
    public function updateCodeData($user_info) {
        $reset_code = $this->getCommonUtils()->generateUniqueFourDigirCode();
        $code_update['reset_code'] = $reset_code;
        $code_update['reset_code_time'] = date('Y-m-d H:i:s');
        $update_user = $this->getUserModel()->updateUserByColumnValue('id', $user_info['id'], $code_update);
        if ($update_user) {
            return $reset_code;
        }
    }

}
