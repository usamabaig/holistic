<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;

class OrderService extends BaseService {

    /**
     * prepareSaveOrder method
     * @param type $inputs
     */
    public function prepareSaveOrder($inputs) {
        $order_data = $this->prepareOrderData($inputs);
        return $this->getOrderModel()->saveOrder($order_data);
    }

    /**
     * prepareOrderData method
     * @param type $inputs
     * @return type
     */
    public function prepareOrderData($inputs) {
        $user_data = $this->getUserModel()->getUserByColumnValue('user_token', $inputs['user_token']);
        $id = $this->getIncrementModel()->createId();
        $order_arr['order_id'] = $id->id;
        $order_arr['expected_pick_up_at'] = !empty($inputs['expected_pick_up_at']) ? $inputs['expected_pick_up_at'] : NULL;
        $order_arr['current_user_timezone'] = !empty($inputs['current_user_timezone']) ? $inputs['current_user_timezone'] : NULL;
        $order_arr['recipient_name'] = $inputs['recipient_name'];
        $order_arr['recipient_phone'] = $inputs['recipient_phone'];
        $order_arr['recipient_country_iso'] = !empty($inputs['recipient_country_iso']) ? $inputs['recipient_country_iso'] : NULL;
        $order_arr['created_by_id'] = $user_data['id'];
        $order_arr['trip_id'] = !empty($inputs['trip_id']) ? $this->getTripModel()->getTripByColumnValue('uuid', $inputs['trip_id'])['id'] : NULL;
        $order_arr['status_id'] = 1;
        $order_arr['status_verification'] = 'verified';
        $order_arr = $this->preparePackageTimezones($inputs, $order_arr);
        $order_arr = $this->prepareOrderDataCont($order_arr, $inputs, $user_data);
        $order_arr = $this->preparePareOfferData($order_arr, $inputs, $user_data);
//        $order_arr = $this->preparePreferencesAndMethod($order_arr, $inputs);
        return $order_arr;
    }

    /**
     * preparePreferencesAndMetho method
     * @param type $inputs
     * @param type $order_arr
     * @return type
     */
    public function preparePreferencesAndMethod($order_arr, $inputs) {
        $order_arr['method_id'] = $inputs['method_id'];
        $order_arr['pickup_preference_id'] = $inputs['pickup_preference_id'];
        $order_arr['dropoff_preference_id'] = $inputs['dropoff_preference_id'];
        return $order_arr;
    }

    /**
     * preparePackageTimezones method
     * @param type $inputs
     * @param type $order_arr
     * @return type
     */
    public function preparePackageTimezones($inputs, $order_arr) {
        if (isset($inputs['pickup_timezone']) && !empty($inputs['pickup_timezone'])) {
            $order_arr['pickup_timezone'] = $inputs['pickup_timezone'];
        } else {
            $order_arr['pickup_timezone'] = $this->getCommonUtils()->getTimeZoneFromGoogle($inputs['location']['from_lat'], $inputs['location']['from_lng']);
        }
        if (isset($inputs['dropoff_timezone']) && !empty($inputs['dropoff_timezone'])) {
            $order_arr['dropoff_timezone'] = $inputs['dropoff_timezone'];
        } else {
            $order_arr['dropoff_timezone'] = $this->getCommonUtils()->getTimeZoneFromGoogle($inputs['location']['to_lat'], $inputs['location']['to_lng']);
        }
        return $order_arr;
    }

    /**
     * prepareOrderDataCont method
     * @param type $order_arr
     * @param type $inputs
     * @return type
     */
    public function prepareOrderDataCont($order_arr, $inputs, $user) {
        $size = $this->getSizeModel()->getSizeByColumnValue('uuid', $inputs['size_id']);
        $category = $this->getCategoryModel()->getCategoryByColumnValue('uuid', $inputs['category_id']);
        $order_arr['size_id'] = $size['id'];
        $order_arr['category_id'] = $category['id'];
        $order_arr['created_by_id'] = $user['id'];
        $price = $this->getPackagePriceModel()->getPriceBySizeAndCategory($order_arr['category_id'], $order_arr['size_id']);
        $order_arr['package_price_id'] = $price['id'];
        $order_arr['price'] = $price['price'];
        $order_arr['converted_price'] = $inputs['converted_price'];
        $order_arr['converted_currency_code'] = $inputs['converted_currency_code'];
        $order_arr['converted_currency_datetime'] = date('Y-m-d H:i:s');
        $order_arr['ISO_country_code'] = $inputs['ISO_country_code'];

        return $order_arr;
    }

    /**
     * 
     * @param type $order_arr
     * @param type $inputs
     */
    public function preparePareOfferData($order_arr, $inputs) {

        if (isset($inputs['offer_amount'])) {
            $order_arr['offer_converted_amount'] = $inputs['offer_converted_amount'];
            $order_arr['offer_amount'] = $inputs['offer_amount'];
            $order_arr['offer_description'] = !empty($inputs['offer_description']) ? $inputs['offer_description'] : NULL;
            $order_arr['offer_type'] = !empty($inputs['offer_type']) ? $inputs['offer_type'] : NULL;
        }

        return $order_arr;
    }

    /**
     * convertTipAmount method convert user tip amount to project base currency which is now SAR
     * @param type $from_curr
     * @param type $amount
     * @return int
     */
    public function convertTipAmount($from_curr, $amount) {

        $response = $this->getCommonUtils()->selectConversionMethod($amount, $from_curr, 'SAR');
        if ($response['success'] == true) {
            return $response['convereted_amount'];
        }
        return false;
    }

    /*     * oonse 
     * prepareTotalPrice prepares total price of the package
     * @param type $order_arr
     * @param type $inputs
     * @return type
     */

    public function prepareTotalPrice($order_arr, $inputs) {
        $total_amount = 0;
        if (!empty($inputs['offer_type']) && !empty($inputs['offer_amount'])) {
            $total_amount = $order_arr['price'] + $inputs['offer_amount'];
        } else {
            $total_amount = $order_arr['price'];
        }
        return $total_amount;
    }

    /**
     * saveOrderLog method
     * @param type $order
     * @param type $inputs
     * @return type
     */
    public function saveOrderLog($order, $inputs) {
        $log_arr = [];
        $log_arr['order_id'] = $order['id'];
        $log_arr['action_by_user'] = $order['created_by_id'];
        $log_arr['status_id'] = 1;
        $log_arr['status_verification'] = $this->getCommonUtils()->prepareStatusVerification(['status_id' => 1]);
        $log_arr['description'] = $this->getUserModel()->getUserByColumnValue('id', $order['created_by_id'])['full_name'] . ' ' . 'has created an order';
        $log_arr['consumer_timezone'] = !empty($inputs['current_user_timezone']) ? $inputs['current_user_timezone'] : NULL;
        $log_arr['carrier_timezone'] = $this->prepareCarrierTimezone($inputs);
        $log_arr = $this->prepareLatLongForAction($inputs['location'], $log_arr);
        return $this->getOrderStatusLogModel()->saveLog($log_arr);
    }

    /**
     * prepareLatLongForAction method
     * @param type $request_params
     * @param type $log_arr
     * @return type
     */
    public function prepareLatLongForAction($request_params, $log_arr) {
        if (empty($request_params['current_lat']) || empty($request_params['current_lng'])) {
            $location = $this->getLocationService()->getUserGeolocation();
            $log_arr['lat'] = $location['lat'];
            $log_arr['lng'] = $location['lng'];
        } else {
            $log_arr['lat'] = $request_params['current_lat'];
            $log_arr['lng'] = $request_params['current_lng'];
        }
        return $log_arr;
    }

    /**
     * prepareCarrierTimezone method
     * @param type $inputs
     */
    public function prepareCarrierTimezone($inputs) {
        $timezone = NULL;
        if (isset($inputs['trip_id']) && !empty($inputs['trip_id'])) {
            $trip = $this->getTripModel()->getTripUserTimezone($inputs['trip_id']);
            $timezone = $trip['current_user_timezone'];
        }
        return $timezone;
    }

}
