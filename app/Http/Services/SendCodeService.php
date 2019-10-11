<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use \Twilio\Rest\Client;

class SendCodeService {

    /**
     * searchTwilioIdFromFile method selects SMS sending service as per user number
     * @param type $confirmation
     * @return type
     */
    public function searchTwilioIdFromFile($confirmation) {
        $twilio_id = '';
        $iso_code = $confirmation['country_iso'];
        $json = file_get_contents(public_path() . '/TwillioConturies.json');
        $twilio_ids = json_decode($json, true);
        if (isset($twilio_ids["$iso_code"])) {
            $twilio_id = $twilio_ids["$iso_code"];
        }
        return $twilio_id;
    }

    /**
     * searchTwilioIdFromCode method selects SMS sending service as per user number
     * @param type $confirmation
     * @return type
     */
    public function searchTwilioIdFromCode($confirmation) {
        $twilio_id = '';
        if (strpos($confirmation['phone_no'], "+966") !== false) {
            $twilio_id = 'BARQAPP';
        }
        return $twilio_id;
    }

    /**
     * send single SMS to number
     * @param type $data
     * @return type
     */
    public function sendSmsToPhoneNubmer($data) {
        try {
            $res = $this->configureApi()->messages->create(
                    $data['phone_no'], array(
                'from' => config('paths.twilio_number'),
                'body' => $data['message'],
                    )
            );
            if ($res->errorMessage == NULL) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * configureApi method do configuration and return twillio client
     * @return \App\Http\Services\Client
     */
    public function configureApi() {
        $account_sid = config('paths.twillio_account_sid');
        $auth_token = config('paths.twillio_auth_token');
        $client = new Client($account_sid, $auth_token);
        return $client;
    }

    /**
     * makeCall method is responsible for making outbound twillio
     * @param type $url
     * @param type $phone_number
     * @return boolean
     */
    public static function makeCall($url, $phone_number) {
        try {
            $account_sid = config('paths.twillio_account_sid');
            $auth_token = config('paths.twillio_auth_token');
            $twilio_number = config('paths.twilio_number');
            $client = new Client($account_sid, $auth_token);
            $res = $client->calls
                    ->create($phone_number, // to
                    $twilio_number, // from
                    array(
                'url' => \URL::to('/') . '/makeCall',
            ));
            if ($res->status == 'queued') {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            false;
        }
    }

    /**
     * goForLookUp method 
     * @param type $isValidPhone
     * @return type
     */
    public static function goForLookUp($isValidPhone) {
        $response = ['success' => true, 'phone' => trim($isValidPhone)];
        $sid = config('paths.twillio_account_sid');
        $token = config('paths.twillio_auth_token');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://lookups.twilio.com/v1/PhoneNumbers/$isValidPhone?Type=carrier");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_USERPWD, "$sid" . ":" . "$token");
        $curlResult = curl_exec($ch);
        if (curl_errno($ch)) {
            $response = ['success' => false, 'message' => $ch];
        }
        curl_close($ch);
        $decode = json_decode($curlResult);
        if (isset($decode->status) && ($decode->status == 404 || $decode->status == 401)) {
            $response = ['success' => false, 'message' => 'The phone number you entered is incorrect, please enter a correct phone number'];
        } else {
            $response['phone'] = trim($decode->phone_number);
        }
        return $response;
    }

}
