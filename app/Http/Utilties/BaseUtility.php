<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Http\Utilties\CommonUtils;
use App\Http\Utilties\RulesUtils;
use App\Http\GlobalUtilties\LocationUtils;
use App\Http\Utilties\MessageUtils;
use App\Http\Utilties\CallUtils;
use App\Http\GlobalUtilties\ImageUtils;
use App\Http\Services\SendCodeService;
use App\Http\Models\PhoneNumberVerification;
use App\Http\Models\UserProfile;
use App\Http\Services\UserDeviceService;
use App\Http\Services\PhoneVerificationService;
use App\Http\Services\StripeService;
use App\Http\Services\SignupService;
use App\Http\Models\UserDevice;
use App\Http\Models\User;
use App\Http\Responses\UserResponse;
use App\Http\GlobalUtilties\TimeCoversionUtils;
use App\Http\Services\UserProfileService;

class BaseUtility {

    function __construct() {
        
    }

    /**
     * 
     * SETTERS
     */
    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getRulesUtils() {
        return new RulesUtils();
    }

    public function getLocationUtils() {
        return new LocationUtils();
    }

    public function getMessageUtils() {
        return new MessageUtils();
    }

    public function getImageUtils() {
        return new ImageUtils();
    }

    public function getUserModel() {
        return new User();
    }

    public function getUsersResponse() {
        return new UserResponse();
    }

    public function getVerificationModel() {
        return new PhoneNumberVerification();
    }

    public function sendCode() {
        return new SendCodeService();
    }

    public function getVerificationService() {
        return new PhoneVerificationService();
    }

    public function getStripeService() {
        return new StripeService();
    }

    public function getSignupService() {
        return new SignupService();
    }

    public function getUserProfileModel() {
        return new UserProfile();
    }

    public function getUserDeviceModel() {
        return new UserDevice();
    }

    public function getUserDeviceService() {
        return new UserDeviceService();
    }

    public function getTimeCoversionUtils() {
        return new TimeCoversionUtils();
    }

    public function getUserProfileService() {
        return new UserProfileService();
    }

    public function twimlFactory() {
        return new CallUtils();
    }

}
