<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;

class AddressService extends BaseService {

    /**
     * addOrderToAddress method
     * @param type $inputs
     * @param type $order
     * @return type
     */
    public function addOrderToAddress($inputs, $order) {
        //PREPARING TO ADDRESS FOR THE TRIP
        $location = $inputs['location'];
        $to_add = [];
        $to_add['order_id'] = $order['id'];
        $to_add['type'] = 'to';
        $to_add['address_for'] = 'order';
        $to_add['lat'] = $location['to_lat'];
        $to_add['lng'] = $location['to_lng'];
        $to_add['full_address'] = $location['to_full_address'];
        $to_add['city'] = $location['to_city'];
        $to_add['state'] = !empty($location['to_state']) ? $location['to_state'] : NULL;
        $to_add['zip_code'] = !empty($location['to_zipcode']) ? $location['to_zipcode'] : NULL;
        $to_add['country'] = $location['to_country'];
        return $this->getAddressModel()->saveAddress($to_add);
    }

    /**
     * addOrderFromAddress method
     * @param type $inputs
     * @param type $order
     * @return type
     */
    public function addOrderFromAddress($inputs, $order) {
        //PREPARING FROM ADDRESS FOR THE TRIP
        $location = $inputs['location'];
        $from_add = [];
        $from_add['order_id'] = $order['id'];
        $from_add['type'] = 'from';
        $from_add['address_for'] = 'order';
        $from_add['lat'] = $location['from_lat'];
        $from_add['lng'] = $location['from_lng'];
        $from_add['full_address'] = $location['from_full_address'];
        $from_add['city'] = $location['from_city'];
        $from_add['state'] = !empty($location['from_state']) ? $location['from_state'] : NULL;
        $from_add['zip_code'] = !empty($location['from_zipcode']) ? $location['from_zipcode'] : NULL;
        $from_add['country'] = $location['from_country'];
        return $this->getAddressModel()->saveAddress($from_add);
    }

}
