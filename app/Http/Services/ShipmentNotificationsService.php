<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;
use App\Http\Models\Trip;
use DB;

class ShipmentNotificationsService extends BaseService {

    public function getTripModel() {
        return new Trip();
    }

    /**
     * sendNotification method
     * @param type $order
     * @return type
     */
    public function sendNotification($order) {

        if ($order['trip']['user']['is_login'] == 1 &&
                $order['trip']['user']['settings']['push_notification'] == 1
        ) {

            return $this->sendShipmentPushNotification($order);
        }
    }

    /**
     * sendOrderPushNotification method
     * @param type $order
     * @return type
     */
    public function sendShipmentPushNotification($order) {
       
        $message_data_to_send = $this->prepareMessageDataForNotificationToSend($order['trip']['user'], $order['user'], $order['trip'], $order);

        $message_data_to_save = $this->prepareMessageDataForNotificationToSave($order['trip']['user'], $order['user'], $order['trip'], $order);

        $carrier_device = $this->getUserDeviceModel()->getUserDeviceByUser($order['trip']['user_id']);

        if ($carrier_device) {

            $this->getNotificationsModel()->saveNotification($message_data_to_save);

            if (strtolower($carrier_device['device_type']) == 'ios') {
                return $this->getPushNotificationUtils()->sendPushNotificationToIOS($carrier_device['device_token'], $message_data_to_send);
            }
            if (strtolower($carrier_device['device_type']) == 'android') {
                return $this->getPushNotificationUtils()->sendPushNotificationToAndroid($carrier_device['device_token'], $message_data_to_send);
            }
        }
    }

    /**
     * prepareMessageDataForNotificationToSave method
     * @param type $order
     * @param type $carrier_name
     * @param type $trip_owner_id
     * @param type $user
     * @return type
     */
    public function prepareMessageDataForNotificationToSave($carrier, $consumer, $trip, $order) {
        $message_data['trip_id'] = $trip['id'];
        $message_data['sender_id'] = $consumer['id'];
        $message_data['receiver_id'] = $carrier['id'];
        $message_data['order_id'] = $order['id'];
        $message_data = $this->prepareTypeAndMessageForOrder($message_data, $carrier, $order);
        return $message_data;
    }

    /**
     * prepareMessageDataForNotificationToSend method
     * @param type $order
     * @param type $carrier_name
     * @param type $trip_owner_id
     * @param type $user
     * @return type
     */
    public function prepareMessageDataForNotificationToSend($carrier, $consumer, $trip, $order) {
        $message_data['trip_id'] = $trip['uuid'];
        $message_data['sender_id'] = $consumer['uuid'];
        $message_data['receiver_id'] = $carrier['uuid'];
        $message_data['order_id'] = $order['uuid'];
        $message_data = $this->prepareTypeAndMessageForOrder($message_data, $carrier, $order);
        return $message_data;
    }

    /**
     * prepareTypeAndMessageForOrder method
     * @param type $message_data
     * @param type $user
     * @return string
     *///SELECTING TYPE AND MESSAGE DATA WHEN USER ADDIND NEW ORDER AND IT WILL BE SENT TO CARRIER OF THE TRIP

    public function prepareTypeAndMessageForOrder($message_data, $user, $order) {
        $address_to = $this->getAddressModel()->getAddressByColumnValue('order_id', $order['id'], 'to');
        if ($user['language'] == 'AR') {
            $message_data['title'] = 'معلومات الحزمة';
            $message_data['type'] = 'لديك شحنة جديدة #' . $order['order_id'] . ' إلى' . $address_to['city'];
            $message_data['message'] = 'لديك شحنة جديدة#' . $order['order_id'] . ' إلى' . $address_to['city'];
        }
        if ($user['language'] == 'EN') {
            $message_data['title'] = 'Package Info';
            $message_data['type'] = 'You have new package # ' . $order['order_id'] . ' to ' . $address_to['city'];
            $message_data['message'] = 'You have new package # ' . $order['order_id'] . ' to ' . $address_to['city'];
        }
        return $message_data;
    }

    /**
     * sendNotificationToIdleCarrier method
     * @param type $order
     * @return boolean
     */
    public function sendNotificationToIdleCarrier($order) {
        if (empty($order['trip_id'])) {
            $from_address = $this->getAddressModel()->getAddressByColumnValue('order_id', $order['id'], 'from');
            $carriers = $this->getUserModel()->getIdleCarriers($from_address['lat'], $from_address['lng']);
            foreach ($carriers as $carrier) {
                $message_data = $this->prepareMessageDataToSendIdleCarriers($carrier, $order);
                if (strtolower($carrier['device']['device_type']) == 'ios') {
                    $this->getPushNotificationUtils()->sendPushNotificationToIOS($carrier['device']['device_token'], $message_data);
                }
                if (strtolower($carrier['device']['device_type']) == 'android') {
                    $this->getPushNotificationUtils()->sendPushNotificationToAndroid($carrier['device']['device_token'], $message_data);
                }
            }
        }
        return true;
    }

    /**
     * prepareMessageDataToSendIdleCarriers method
     * @param type $carrier
     * @param type $order
     * @return type
     */
    public function prepareMessageDataToSendIdleCarriers($carrier, $order) {
        $message_data['receiver_id'] = $carrier['uuid'];
        $message_data['order_id'] = $order['uuid'];
        $message_data = $this->prepareTypeAndMessageForCarrier($message_data, $carrier);
        return $message_data;
    }

    /**
     * prepareTypeAndMessageForCarrier method
     * @param type $user
     * @return string
     */
    public function prepareTypeAndMessageForCarrier($message_data, $user) {
        if ($user['language'] == 'AR') {
            $message_data['title'] = 'معلومات الحزمة';
            $message_data['type'] = 'قد يكون لديك حزم جديدة في منطقتك';
            $message_data['message'] = 'قد يكون لديك حزم جديدة في منطقتك';
        }
        if ($user['language'] == 'EN') {
            $message_data['title'] = 'Package Info';
            $message_data['type'] = 'You may have new packages in your area.';
            $message_data['message'] = 'You may have new packages in your area.';
        }
        return $message_data;
    }

}
