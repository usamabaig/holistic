<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\GlobalUtilties;

use App\Http\Utilties\BaseUtility;
use DateTime;

class TimeCoversionUtils extends BaseUtility {

    /**
     * datetimeConvertToAnotherTimezone method
     * @param type $datetime
     * @param type $timezone
     * @param type $tz2
     * @return type
     */
    public function datetimeConvertToAnotherTimezone($datetime, $timezone, $tz2) {
        $date = new DateTime($datetime, new \DateTimeZone($timezone));
        $date->setTimezone(new \DateTimeZone($tz2));
        $result = $date->format('Y-m-d H:i:s');
        date_default_timezone_set('UTC');
        return $result;
    }

    /**
     * dateConvertToAnotherTimezone method
     * @param type $datetime
     * @param type $timezone
     * @param type $tz2
     * @return type
     */
    public function dateConvertToAnotherTimezone($datetime, $timezone, $tz2) {
        $date = new DateTime($datetime, new \DateTimeZone($timezone));
        $date->setTimezone(new \DateTimeZone($tz2));
        $result = $date->format('Y-m-d');
        date_default_timezone_set('UTC');
        return $result;
    }

    /**
     * datetimeConvertToAnotherTimezoneTwelveFortmat method
     * @param type $datetime
     * @param type $timezone
     * @param type $tz2
     * @return type
     */
    public function datetimeConvertToAnotherTimezoneTwelveFortmat($datetime, $timezone, $tz2) {
        $date = new DateTime($datetime, new \DateTimeZone($timezone));
        $date->setTimezone(new \DateTimeZone($tz2));
        $result = $date->format('d-m-Y');
        date_default_timezone_set('UTC');
        return $result;
    }

    /**
     * timeTonvertToAnotherTimezone method
     * @param type $datetime
     * @param type $timezone
     * @param type $tz2
     * @return type
     */
    public function timeTonvertToAnotherTimezone($datetime, $timezone, $tz2) {
        $date = new DateTime($datetime, new \DateTimeZone($timezone));
        $date->setTimezone(new \DateTimeZone($tz2));
        $result = $date->format('H:i:s');
        date_default_timezone_set('UTC');
        return $result;
    }

}
