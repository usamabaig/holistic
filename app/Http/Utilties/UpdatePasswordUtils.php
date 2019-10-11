<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Http\Utilties\BaseUtility;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Request;
use DB;

class UpdatePasswordUtils extends BaseUtility {

    /**
 * checkResetCode method
     * @return type
     */
    public function checkResetCode() {
        $request_params = Request::all();
        $validator = Validator::make($request_params, $this->getRulesUtils()->check_code_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'check_code_rules', $request_params['lang']));
        if ($validator->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validator->errors()->first());
        }
        $user = $this->getUserModel()->getUserByColumnValue('reset_code', $request_params['reset_code']);
        if (empty($user)) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['verification_code_invalid']);
        }
        $created_time = strtotime($user['reset_code_time']);
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $time = $current_time - $created_time;
        if ($time > 7200) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['verification_code_expired']);
        }
        return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['code_verification_success']);
    }

    /**
     * updatePassword update
     * @return type
     */
    public function updatePassword() {
        $request_params = Request::all();
        $validator = Validator::make($request_params, $this->getRulesUtils()->update_password_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'update_password_rules', $request_params['lang']));
        if ($validator->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validator->errors()->first());
        }
        $user = $this->getUserModel()->getUserByColumnValue('reset_code', $request_params['reset_code']);
        if (empty($user)) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['verification_code_invalid']);
        }
        return $this->processUpdatePassword($request_params, $user);
    }

    /**
     * processUpdatePassword method
     * @param type $request_params
     * @param type $user
     * @return type
     */
    public function processUpdatePassword($request_params, $user) {
        $created_time = strtotime($user['reset_code_time']);
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $time = $current_time - $created_time;
        if ($time > 7200) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['reset_code_expired']);
        }
        $update_user['reset_code'] = null;
        $update_user['reset_code_time'] = null;
        $update_user['password'] = Hash::make($request_params['password']);
        $is_updated = $this->getUserModel()->updateUserByColumnValue('id', $user['id'], $update_user);
        if ($is_updated) {
            DB::commit();
            return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['password_updated']);
        }
    }

}
