<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use App\Http\Models\User;
use Hash;
use DB;

class SignupUtils extends BaseUtility {

    /**
     * registerUser method verify and store user data to database
     * @return type
     */
    public function registerUser() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->register_user_rules_with_email, $this->getRulesUtils()->selectLanguageForMessages($rules = 'register_user_rules_with_email', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        $check_user = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
        if (!empty($check_user)) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['email_already_taken']);
        }
        return $this->processSignupProcess($request_params);
    }

    /**
     * 
     * @param type $request_params
     * @return type
     */
    public function processSignupProcess($request_params) {
        $check_code = $this->getVerificationService()->phoneNumberVerification($request_params);
        if (!$check_code) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['verification_code_invalid']);
        }
        $phone_data = $this->getVerificationModel()->getConfirmationCode($request_params);
        $time = $this->getVerificationService()->checkVerficationValidity($phone_data);
        if ($time < 7200) {
            $this->getVerificationService()->updateVerificationCodeStatus($request_params);
            return $this->processSignup($request_params);
        }
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['verification_code_expired']);
    }

    /**
     * processSignup method further takes the sign up request
     * @param type $request_params
     * @return type
     */
    public function processSignup($request_params) {
        \DB::beginTransaction();
        $save_user = $this->processUserData($request_params);
        $user_profie = $this->getUserProfileService()->processProfileData($request_params, $save_user);
        if (!$user_profie) {
            DB::rollBack();
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['enable_location']);
        }
        if ($save_user && $user_profie) {
            $user = $this->getUserModel()->getUserByColumnValue('id', $save_user->id);
            $send_email = $this->sendVerificationEmail($request_params, $user['id']);
            if ($send_email) {
                $user_device = $this->getUserDeviceService()->createNewDiceData($request_params, $user);
                if ($user_device) {
                    DB::commit();
                    $data['user'] = $this->getUsersResponse()->prepareUserResponse($this->getUserModel()->getUserByColumnValue('id', $user['id']));
                    return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['signup_success'], $data);
                }
            }
            DB::rollBack();
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['general_error']);
        }
        DB::rollBack();
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['general_error']);
    }

    /**
     * signupProcessContiue method 
     * @param type $inputs
     * @param type $save_user
     * @param type $lang
     * @return type
     */
    public function signupProcessContiue($inputs, $save_user, $lang) {
        $user = User::getUserByColumnValue('id', $save_user->id);
        $send_email = UserHelper::sendVerificationEmail($inputs, $user->id);
        if ($send_email) {
            return self::processDeviceData($inputs, $user, $user->profile, $lang);
        } else {
            DB::rollback();
            return CommonHelper::jsonErrorResponse(MessageHelper::getMessageData($type = 'error', $inputs['lang'])['could_not_signup']);
        }
    }

    /**
     * processUserData method
     * @param type $request_params
     * @return type
     */
    public function processUserData($request_params) {
        $user['phone_no'] = $request_params['phone_no'];
        $user['password'] = Hash::make($request_params['password']);
        $user['user_token'] = Hash::make($request_params['phone_no'] . time());
        $user['full_name'] = $request_params['full_name'];
        $user['email'] = $request_params['email'];
        $user['user_role_id'] = $request_params['user_role_id'];
        $user['language'] = $request_params['lang'];
        $user['version'] = config('paths.current_api_version');
        $user['default_currency'] = 'SAR';
        if ($request_params['country_code']) {
            $d_currency = $this->prepareDefaultCurrency($request_params['country_code']);
            if (!empty($d_currency)) {
                $user['default_currency'] = $d_currency;
            }
        }
        return $this->getUserModel()->saveNewUser($user);
    }

    /**
     * prepareDefaultCurrency method
     * @param type $country_code
     * @return type
     */
    public function prepareDefaultCurrency($country_code) {
        $default_currency = '';
        $json = file_get_contents(public_path() . '/currency.json');
        $currencies = json_decode($json, true);
        if ($currencies["$country_code"]) {
            $default_currency = $currencies["$country_code"];
        }
        return $default_currency;
    }

    /**
     * sendVerificationEmail method
     * @param type $request_params
     * @param type $user_id
     * @return type
     */
    public function sendVerificationEmail($request_params, $user_id) {
        $code = rand(pow(10, 4 - 1), pow(10, 4) - 1);
        $update_user = [];
        $update_user['email_verification_code'] = $code;
        $update_user['email_code_time'] = date("y-m-d H:i:s");
        $is_updated_user = $this->getUserModel()->updateUserByColumnValue('id', $user_id, $update_user);
        if ($is_updated_user) {
            $message_data = [];
            if (strpos($_SERVER['SERVER_NAME'], "barqapp.com") !== false) {
                $message_data['url'] = 'https://consumer1-5.barqapp.com/emailConfirmation?code=' . base64_encode('jkhglmp_' . $code);
            } else {
                $message_data['url'] = 'http://52.28.105.111/consumer-v1.0/emailConfirmation?code=' . base64_encode('jkhglmp_' . $code);
            }
            $message_data['subject'] = 'Email Verfication';
            $message_data['email'] = $request_params['email'];
            return $this->getCommonUtils()->sendEmail('email_verification', $message_data);
        }
    }

}
