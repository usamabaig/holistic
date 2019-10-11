<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\GlobalUtilties;

use App\Http\Utilties\BaseUtility;

class LocationUtils extends BaseUtility {

    /**
     * getUserGeolocation method helps to get user location from network
     * @return type
     */
    public function getUserGeolocation() {
        $TOKEN = config('paths.ip_info_key');
        $geoloc = [];
        if (env('APP_ENV') == 'local') {
            $ip = '122.129.79.81';
        } else {
            $ip = $this->getIP();
        }
        $context = stream_context_create(array('http' => array('ignore_errors' => true)));
        $details = json_decode(file_get_contents("http://ipinfo.io/$ip/json?token=$TOKEN", false, $context));
        $location = explode(',', $details->loc);
        $geo_data = json_decode(json_encode($details), True);
        $geoloc['lat'] = $location[0];
        $geoloc['lng'] = $location[1];
        $geoloc['city'] = !empty($geo_data['city']) ? $geo_data['city'] : NULL;
        $geoloc['state'] = !empty($geo_data['region']) ? $geo_data['region'] : NULL;
        $geoloc['zip_code'] = !empty($geo_data['postal']) ? $geo_data['postal'] : NULL;
        $geoloc['country'] = !empty($geo_data['country']) ? $geo_data['country'] : NULL;
        return $geoloc;
    }

    /**
     * getIP method
     * @return type
     */
    public function getIP() {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $clientIpAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {
            $clientIpAddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $clientIpAddress = config('paths.merchant_ip');
        }
        return $clientIpAddress;
    }

    /**
     * getServerIP method
     */
    public function getServerIP() {
        $serverIpAddress = '';
        if (isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR']) {
            $serverIpAddress = $_SERVER['SERVER_ADDR'];
        } else {
            $serverIpAddress = config('paths.merchant_ip');
        }
    }

}
