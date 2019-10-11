<?php

namespace App\Http\Controllers;

class VerificationCodeController extends Controller {

    function __construct() {
        // $this->middleware('auth_api');
    }

    /**
     * sendVerificationCode methods sends verification sms
     * @return type
     */
    public function sendVerificationCode() {
        try {
            return $this->sendCode()->getVerificationCode();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * checkVerificationCode method check the verification code
     * @return type
     */
    public function checkVerificationCode() {
        try {
            return $this->getNumberValidations()->checkVerificationCode();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
