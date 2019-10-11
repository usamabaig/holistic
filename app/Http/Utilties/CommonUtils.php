<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Response;
use Mail;

class CommonUtils extends BaseUtility {

    /**
     * Global data
     */
    public $admin_info = [
        'admin_email' => 'info@holistic.com',
        'support_email' => 'info@holistic.com',
        'site_title' => 'HolisticApp',
    ];
    public $app_version = [
        'ios-v2.0',
        'android-v0.12'
    ];
    public $limits = [
        'shipment_limit' => 10
    ];
    public $url = [
        'twillio_call_url' => 'http://52.28.105.111/consumer-v1.0/public/callxmls/',
    ];
    public $call_paths = [
        's3_path' => 'call_xmls/'
    ];
    public $methods_id_uuid = [
        1 => "72042e00-f6e9-11e8-a7bc-8b59cfec7125",
        2 => "968dd880-f6e9-11e8-97c1-79ea7e4f723b",
        3 => "c29db950-f6e9-11e8-a1b4-c5df8633d67f",
        4 => "fb54fec0-f6ea-11e8-908a-45755cc43de8",
    ];
    public $statuses = [
        'open' => 1,
        'rejected' => 2,
        'approved' => 3,
        'canceled' => 4,
        'picked' => 5,
        'delivered' => 6,
        'ready_to_pick' => 7,
        'on_track' => 8,
    ];

    /**
     * jsonErrorResponse method
     * @param type $error
     * @return error response
     */
    public function jsonErrorResponse($error) {
        $response = [];
        $response['success'] = false;
        $response['message'] = $error;
        return Response::json($response);
    }

    /**
     * jsonSuccessResponse method
     * @param type $msg
     * @param type $data
     * @return return success response with data
     */
    public function jsonSuccessResponse($msg, $data = array()) {
        $response = [];
        $response['success'] = true;
        $response['data'] = !empty($data) ? $data : [];
        $response['message'] = $msg;
        return Response::json($response);
    }

    /**
     * return success response without data 
     * @param type $msg
     * @return type
     */
    public function jsonSuccessResponseWithoutData($msg) {
        $response = [];
        $response['success'] = true;
        $response['message'] = $msg;
        return Response::json($response);
    }

    /**
     * sendEmail method
     * @param type $template
     * @param type $data
     * @param type $attachment
     * @return boolean
     */
    public function sendEmail($template, $data, $attachment = null) {
      
        $support_email = $this->admin_info['support_email'];
        $site_title = $this->admin_info['site_title'];
        Mail::send('emails.' . $template, ['data' => $data], function($message) use ($support_email, $site_title, $data) {
            $message->from($support_email, $site_title);
            $message->subject($data['subject']);
            $message->to($data['email']);
            if (!empty($attachment)) {
                $message->attach($attachment);
            }
        });
        return true;
    }

    /**
     * generateUniqueFourDigirCode method
     * @param type $digits
     * @return array
     */
    public function generateUniqueFourDigirCode($digits = 4) {
        $reset_code['reset_code'] = '';
        $reset_code['reset_code'] = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $validate_code = Validator::make($reset_code, ['reset_code' => 'unique:users']);
        if ($validate_code->fails()) {
            $reset_code['reset_code'] = self::generateUniqueFourDigirCode(4);
        }
        return $reset_code['reset_code'];
    }

    /**
     * getTimezoneByIp helps to get timezone by IP address
     * @return type
     */
    public function getTimezoneByIp() {
        $time_zone = '';
        $ip_address = $_SERVER['REMOTE_ADDR'];
//        $ip_address = '122.129.79.81';
        $jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);
        $data = json_decode($jsondata, true);
        if ($data['meta']['code'] == '200' && $data['data']['timezone'] != null) {
            $time_zone = $data['data']['timezone']['id'];
        } else {
            $time_zone = 'UTC';
        }
        return $time_zone;
    }

    /**
     * freeCurrencyConverterApi method uses Free currency Converter API to convert currency
     * @param type $amount
     * @param type $from_currency
     * @param type $to_currency
     * @return type
     */
    public function selectConversionMethod($amount, $from_currency, $to_currency) {
        try {
//            $total = $this->fixirConverter($amount, $from_currency, $to_currency);
//            if ($total == 0) {
            return $this->fixirConverter($amount, $from_currency, $to_currency);
//            }
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * freeConverter method is associated with a free currency converter
     * @param type $amount
     * @param type $from_currency
     * @param type $to_currency
     * @return type
     */
    public function freeConverter($amount, $from_currency, $to_currency) {
        $end_param = $this->prepareCurrencyConverterAPIkey();
        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query = "{$from_Currency}_{$to_Currency}";
        $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}" . $end_param);
        $obj = json_decode($json, true);
        $val = $obj['results']["$query"]['val'];
        $total = $val * $amount;
        return number_format($total, 2, '.', '');
    }

    /**
     * 
     * @param type $amount
     * @param type $from_currency
     * @param type $to_currency
     * @return type
     */
    public function fixirConverter($amount, $from_currency, $to_currency) {
        try {            
            $responnse = [];
            $key = config('paths.fixir_key');
            $from_Currency = urlencode($from_currency);
            $to_Currency = urlencode($to_currency);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => "http://data.fixer.io/api/latest?access_key=" . $key . "&base=" . $from_Currency . "&symbols=" . $to_Currency,
                // You can set any number of default request options.
                'timeout' => 2.0,
            ]);

            $res = $client->request("get");

            $resBodyContents = $res->getBody()->getContents();

            $obj = json_decode($resBodyContents, true);

            if ($obj['success'] == true) {
                $one_unit = $obj['rates']["$to_Currency"];
            }
            if (!empty($one_unit) && $one_unit != 0) {
                $responnse['success'] = true;
                $responnse['converted_amount'] = number_format($amount * $one_unit, 2, '.', '');
            } else {
                $responnse['success'] = false;
                $responnse['message'] = $obj['error']['type'];
            }

            return $responnse;
        } catch (\Exception $ex) {

            $responnse['success'] = false;
            $responnse['message'] = $ex->getMessage();
        }
    }

    /**
     * prepareCurrencyConverterAPIkey method
     * @return string
     */
    public function prepareCurrencyConverterAPIkey() {
//        $end_param = '';
//        $KEY = config('paths.currency_converter_key');
//        if (isset($KEY) && !empty($KEY)) {
//            $end_param = '&apiKey=' . $KEY;
//        }
        return $end_param;
    }

    /**
     * prepareStatusVerification methods
     * @param type $request_params
     * @return type
     */
    public function prepareStatusVerification($request_params) {
        $status_verification = '';
        if ($request_params['status_id'] == 4 || $request_params['status_id'] == 1) {
            $status_verification = 'verified';
        } else {
            $status_verification = $request_params['status_verification'];
        }
        return $status_verification;
    }

    /**
     * getTimeZoneFromGoogle method gets timezone on the basics of lat & lng
     * @param type $lat
     * @param type $lng
     */
    public function getTimeZoneFromGoogle_old($lat, $lng) {
        $time_zone = '';
        $GOOGLE_MAP_API = config('paths.maps_key');
        $url = 'https://maps.googleapis.com/maps/api/timezone/json?location=' . $lat . ',' . $lng . '&timestamp=' . time() . '&key=' . $GOOGLE_MAP_API;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $json_response = json_decode($output);
        if (isset($json_response->timeZoneId)) {
            $time_zone = $json_response->timeZoneId;
        }
        return $time_zone;
    }
    
    public function getTimeZoneFromGoogle($lat, $lng, $type = 'GET')
    {
        try{
            
          $GOOGLE_MAP_API = config('paths.maps_key');
          $url = 'https://maps.googleapis.com/maps/api/timezone/json?location=' . $lat . ',' . $lng . '&timestamp=' . time() . '&key=' . $GOOGLE_MAP_API;

           $client = new Client(['base_uri' =>  $url]);
            $res = $client->request($type);

            $status = $res->getStatusCode();
            if ($status == 200) {
                $resBodyContents = $res->getBody()->getContents();
                $resBodyContents_ecoded = json_decode($resBodyContents, true);
                if (empty($resBodyContents_ecoded)) {
                    $resBodyContents_ecoded = json_decode(str_replace('null', ' ', $resBodyContents), true);
                    return $resBodyContents_ecoded;
                }
                return $resBodyContents_ecoded['timeZoneId'];
            }
            else {
                return NULL;
            }
        } catch (RequestException $ex) {
            return NULL;
        }
    }

    /**
     * checkMediumAndPreference method
     * @param type $method
     * @param type $pickup_preference
     * @param type $dropoff_preference
     * @return boolean
     */
    public function checkMethodAndPreference($method, $pickup_preference, $dropoff_preference) {
        $flag = false;
        if (!empty($method) && $method['id'] == 1) {
            if (($dropoff_preference['id'] == 1 || $dropoff_preference['id'] == 4 || $dropoff_preference['id'] == 5) && ($pickup_preference['id'] == 1 || $pickup_preference->id == 4 || $pickup_preference->id == 5)) {
                $flag = true;
            }
        }
        if (!empty($method) && $method['id'] == 2) {
            if (($dropoff_preference['id'] == 2 || $dropoff_preference['id'] == 4 || $dropoff_preference['id'] == 5) && ($pickup_preference['id'] == 3 || $pickup_preference['id'] == 4 || $pickup_preference['id'] == 5)) {
                $flag = true;
            }
        }
        if (!empty($method) && $method['id'] == 3) {
            if (($dropoff_preference['id'] == 3 || $dropoff_preference['id'] == 4 || $dropoff_preference['id'] == 5) && ($pickup_preference['id'] == 2 || $pickup_preference['id'] == 4 || $pickup_preference['id'] == 5)) {
                $flag = true;
            }
        }
        return $flag;
    }

    public function convertPngToJpg($images) {
        $jpegs = [];
        foreach ($images as $image) {
            $partitioned_name = explode('.', $image['image']);
            if ($partitioned_name[1] == 'PNG' || $partitioned_name[1] == 'png' || $partitioned_name[1] == 'jpeg') {
                $new_name = $partitioned_name[0] . '.jpg';
            } else {
                $new_name = $image['image'];
            }
            $jpegs[] = $new_name;
        }
        return $jpegs;
    }

    public function convertPngToJpgSingle($image) {
        $partitioned_name = explode('.', $image);
        if ($partitioned_name[1] == 'PNG' || $partitioned_name[1] == 'png' || $partitioned_name[1] == 'jpeg') {
            $new_name = $partitioned_name[0] . '.jpg';
        } else {
            $new_name = $image;
        }
        return $new_name;
    }

    /**
     * prepareMehtodInformation method
     * This is explicity prepare TRIP MEHTOD data for a shipment
     * @param type $shipment
     */
    public function prepareMehtodInformation($shipment) {
        $response = '';
        $method_arr = $this->methods_id_uuid;
        if (isset($shipment['trip']['method_id'])) {
            if (!empty($method_arr[$shipment['trip']['method_id']])) {
                $response = $method_arr[$shipment['trip']['method_id']];
            }
        } else {
            $response = $method_arr[1];
        }
        return $response;
    }

}
