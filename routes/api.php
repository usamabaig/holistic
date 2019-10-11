<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('signup', 'SignupController@registerUser');

Route::get('verifyAccount/{code}', 'EmailVerificationController@verifyAccount');
Route::post('makeCall', 'EmailVerificationController@makeCall');
Route::get('emailConfirmation', 'EmailVerificationController@emailConfirmation');
Route::get('resendConfirmationEmail', 'EmailVerificationController@resendEmailVerification');

Route::post('login', 'LoginController@doLogin');
Route::get('logout', 'LoginController@logout');

Route::post('getVerificationCode', 'VerificationCodeController@sendVerificationCode');
Route::post('signup', 'SignupController@registerUser');
Route::post('checkVerificationCode', 'VerificationCodeController@checkVerificationCode');
Route::post('forgotPassword', 'ForgotPasswordController@forgotPassword');
Route::post('checkResetCode', 'UpdatePasswordController@checkResetCode');
Route::post('updatePassword', 'UpdatePasswordController@updatePassword');

