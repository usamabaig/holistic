<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;

class MobilyService extends BaseService {

    function __construct() {
        include_once(base_path() . '/vendor/mobily/includeSettings.php');
    }

    public function sendMobilySms($request_params) {
        $mobile = "923336067908";       //Mobile number (or username) of your Mobily.ws account
        $password = "racpakistan1947";
        $sender = "BARQAPP";     // BARQAPP The sender name that will be shown when the message is delivered , it will be encrypted automatically to (urlencode)
        $number_data = explode("+", $request_params['phone_no']);
        $numbers = $number_data[1];       //the mobile number or set of mobiles numbers that the SMS message will be sent to them, each number must be in international format, without zeros or symbol (+), and separated from others by the symbol (,).
        $msg = $request_params['message'];
        /*
          Messages text.
          Messages in English Letters : if the length of message is 160 characters or less, only one point will be deducted, if the length is more than 160 characters, then one point will be deducted for every 153 characters of the message.
          Messages in Arabic Letters (or English & Arabic): if the length of message is 70 characters or less, only one point will be deducted, if the length is more than 160 characters, then one point will be deducted for every 67 characters of the message.
         */

        $MsgID = rand(1, 99999);     //Random number that will be attached with the posting, just in case you want to send same message in less than one hour from the first one
        //Mobily prevents recurrence send the same message within one hour of being sent, except in the case of sending a different value with each send operation
        $timeSend = 0;       //Determine the send time, 0 means send now
        //Standard time format is hh:mm:ss
        $dateSend = 0;       //Determine the send date. 0:now
        //Standard date format is mm:dd:yyyy
        $deleteKey = 152485;     //use this value to delete message using delete potal.
        //you can specify one number for group of messages to delete
        $resultType = 0;      //This parameter specify the type of the API result
        //0: Returns API result as a number.
        //1: Returns API result as text.									
        // Send SMS
        $sendSms = sendSMS($mobile, $password, $numbers, $sender, $msg, $MsgID, $timeSend, $dateSend, $deleteKey, $resultType);
        if ($sendSms == 1) {
            return true;
        } elseif ($sendSms == 2) {
            return false;
        } elseif ($sendSms == 3) {
            return false;
        } elseif ($sendSms == 4) {
            return false;
        } elseif ($sendSms == 5) {
            return false;
        } elseif ($sendSms == 6) {
            return false;
        } elseif ($sendSms == 13) {
            return false;
        } elseif ($sendSms == 14) {
            return false;
        } elseif ($sendSms == 15) {
            return false;
        } elseif ($sendSms == 16) {
            return false;
        } elseif ($sendSms == 17) {
            return false;
        } elseif ($sendSms == 18) {
            return false;
        } elseif ($sendSms == 19) {
            return false;
        } else {
            return false;
        }
    }

}
