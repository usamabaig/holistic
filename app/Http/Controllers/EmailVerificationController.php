<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

class EmailVerificationController extends Controller {

    /**
     * verifyAccount verify user through email
     * @param type $id
     * @return type
     */
    public function verifyAccount($code) {
        try {
            return $this->getEmailVerificationUtils()->processEmailVerificationRequest($code);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * verifyAccount verify user through email
     * @param type $id
     * @return type
     */
    public function makeCall() {
        try {
            $request_params = \Request::all();
            $file_name = str_replace('+', '0', $request_params['To']) . '.xml';
            $data = file_get_contents("https://s3.eu-central-1.amazonaws.com/barq-live/call_xmls/" . $file_name);
            print($data);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * emailConfirmation sends a confirmation code to user
     * @return type
     */
    public function emailConfirmation() {
        try {
            return $this->getEmailVerificationUtils()->verifyConfirmationRequest();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * emailConfirmation sends a confirmation code to user
     * @return type
     */
    public function resendEmailVerification() {
        try {
            return $this->getEmailVerificationUtils()->resendVerificationEmail();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
