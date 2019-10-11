<?php

namespace App\Http\Controllers;

use DB;

class ProfileController extends AuthUserController {

    /**
     * doLogin method
     * @return type
     */
    public function changePassword() {
        try {
            DB::beginTransaction();
            return $this->getPofileUtils()->changePassword();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * updateUserProfile method
     * @return type
     */
    public function updateUserProfile() {
        try {
            DB::beginTransaction();
            return $this->getPofileUtils()->updateUserProfile();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getCommonUtils()->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getCommonUtils()->jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * updateUserProfile method
     * @return type
     */
    public function updateSettings() {
        try {
            DB::beginTransaction();
            return $this->getPofileUtils()->updateSettings();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getCommonUtils()->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getCommonUtils()->jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * 
     * @return type
     */
    public function updateUserLocation() {
        try {
            DB::beginTransaction();
            return $this->getPofileUtils()->updateUserLocation();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    /**
     * 
     * @return type
     */
    public function updateUserInfo() {
        try {
            DB::beginTransaction();
            return $this->getPofileUtils()->updateUserInfo();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

    public function getUserStatus() {
        try {
            DB::beginTransaction();
            return $this->getPofileUtils()->checkUserStatus();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
