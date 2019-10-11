<?php

namespace App\Http\Controllers;

use DB;

class UpdatePasswordController extends Controller {

    function __construct() {
        // $this->middleware('auth_api');
    }

    /**
     * checkResetCode password method
     * @return type
     */
    public function checkResetCode() {
        try {
            return $this->getUpdatePasswordUtility()->checkResetCode();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * updatePassword method updates the password in the database
     * @return type
     */
    public function updatePassword() {
        try {
            DB::beginTransaction();
            return $this->getUpdatePasswordUtility()->updatePassword();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
