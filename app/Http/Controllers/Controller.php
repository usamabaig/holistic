<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Utilties\VerificationCodeUtils;
use App\Http\Utilties\CodeValidationUtils;
use App\Http\Utilties\LoginUtils;
use App\Http\Utilties\CommonUtils;
use App\Http\Utilties\SignupUtils;
use App\Http\Utilties\ForgotPasswordUtils;
use App\Http\Utilties\UpdatePasswordUtils;
use App\Http\GlobalUtilties\ExceptionUtils;
use App\Http\GlobalUtilties\CurrencyUtils;
use App\Http\Services\PaytabsService;
use App\Http\UserUtilities\EmailVerificationUtils;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getSignupUtils() {
        return new SignupUtils();
    }

    public function sendCode() {
        return new VerificationCodeUtils();
    }

    public function attempt() {
        return new LoginUtils();
    }

    public function getNumberValidations() {
        return new CodeValidationUtils();
    }

    public function getForgotUtility() {
        return new ForgotPasswordUtils();
    }

    public function getUpdatePasswordUtility() {
        return new UpdatePasswordUtils();
    }

    public function getEmailVerificationUtils() {
        return new EmailVerificationUtils();
    }

    public function getExceptionUtils() {
        return new ExceptionUtils();
    }

    public function paytabs() {
        return new PaytabsService();
    }

    public function getCurrencyUtils() {
        return new CurrencyUtils();
    }

}
