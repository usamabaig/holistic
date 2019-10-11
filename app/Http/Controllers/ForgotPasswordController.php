<?php

namespace App\Http\Controllers;

use DB;

class ForgotPasswordController extends Controller {

    function __construct() {
        // $this->middleware('auth_api');
    }

    /**
     * doLogin method
     * @return type
     */
    public function forgotPassword() {
        try {
            DB::beginTransaction();
            return $this->getForgotUtility()->forgotPassword();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
