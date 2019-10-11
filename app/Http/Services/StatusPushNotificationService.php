<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;
use App\Http\Models\Trip;
use App\Http\Models\Status;
use DB;

class StatusPushNotificationsService extends BaseService {

    public function getTripModel() {
        return new Trip();
    }

    public function getStatusModel() {
        return new Status();
    }

    /**
     * sendStatusPushNotification method
     * @param type $order
     * @param type $inputs
     * @param type $request_params
     * @param type $image
     * @return type
     */
    public function sendStatusPushNotification($order, $request_params, $status) {
        //PREPARING DATA FOR NOTIFICATIONS 
        $notification_data_to_send = $this->prepareMessageDataToCarrier($order, $status);
        $notification_data_to_save = $this->prepareMessageDataToCarrierToSave($order, $status);
        //GETTING USER DEVICE TO SEND NOTIFICATION
        $carrier_device = $this->getUserDeviceModel()->getUserDeviceByUser($notification_data_to_save['receiver_id']);
        if ($carrier_device) {
            //SAVING NOTIFICATION FOR TRACKING PURPOSE 
            $save_notification = $this->getNotificationsModel()->saveNotification($notification_data_to_save);
            if ($save_notification) {
                if ($notification_data_to_send['push_notification'] == 1 && $notification_data_to_send['is_login'] == 1) {
                    if (strtolower($carrier_device['device_type']) == 'ios') {
                        return $this->getPushNotificationUtils()->sendPushNotificationToIOS($carrier_device['device_token'], $notification_data_to_send);
                    }
                    if (strtolower($carrier_device['device_type']) == 'android') {
                        return $this->getPushNotificationUtils()->sendPushNotificationToAndroid($carrier_device['device_token'], $notification_data_to_send);
                    }
                }
                return true;
            }
        }
    }

    /**
     * prepareMessageDataToCarrier method
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function prepareMessageDataToCarrier($order, $status) {
        $trip = $this->getTripModel()->signleTripById($order['trip_id']);
        $sender_info = $this->getUserModel()->getUserByColumnValue('id', $order['created_by_id']);
        $receiver_info = $this->getUserModel()->getCarrierByColumnValue('id', $trip['user_id']);
        $message_data = [];
        $message_data['order_id'] = $order['uuid'];
        $message_data['sender_id'] = $sender_info['uuid'];
        $message_data['trip_id'] = !empty($order['trip_id']) ? $trip['uuid'] : '';
        $message_data['receiver_id'] = $receiver_info['uuid'];
        $message_data['push_notification'] = $receiver_info['settings']['push_notification'];
        $message_data['is_login'] = $receiver_info['is_login'];
        $message_data['receiver_id'] = $receiver_info['uuid'];
        $message_data['notification'] = $this->getStatusModel()->getStatusByName($status['status_id'])['title'];
        $message_data = $this->selectLangaueForMessageToCarrier($message_data, $receiver_info['language'], $sender_info, $status, $order);
        return $message_data;
    }

    /**
     * prepareMessageDataToCarrier method
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function prepareMessageDataToCarrierToSave($order, $status) {

        $sender_info = $this->getUserModel()->getUserByColumnValue('id', $order['created_by_id']);
        $receiver_info = $this->getUserModel()->getCarrierByColumnValue('id', $this->getTripModel()->signleTripById($order['trip_id'])['user_id']);
        $message_data = [];
        $message_data['order_id'] = $order['id'];
        $message_data['sender_id'] = $order['created_by_id'];
        $message_data['trip_id'] = !empty($order['trip_id']) ? $order['trip_id'] : '';
        $message_data['receiver_id'] = $receiver_info['id'];
        $message_data['notification'] = $this->getStatusModel()->getStatusByName($status['status_id'])['title'];
        $message_data = $this->selectLangaueForMessageToCarrier($message_data, $receiver_info['language'], $sender_info, $status, $order);
        return $message_data;
    }

    /**
     * selectLangaueForMessageToCarrier method
     * @param type $message_data
     * @param type $user_language
     * @param type $sender_info
     * @param type $status
     * @return type
     */
    public function selectLangaueForMessageToCarrier($message_data, $user_language, $sender_info, $status, $order) {
        if ($user_language == 'EN') {
            $message_data = self::selectTypeAndMessageDataForCarrierEN($message_data, $sender_info, $status, $order);
        } elseif ($user_language == 'AR') {
            $message_data = self::selectTypeAndMessageDataForCarrierAR($message_data, $sender_info, $status, $order);
        } else {
            $message_data = self::selectTypeAndMessageDataForCarrierEN($message_data, $sender_info, $status, $order);
        }
        return $message_data;
    }

    /**
     * selectTypeAndMessageDataForCarrierEN method
     * @param type $message_data
     * @param type $sender_info
     * @param type $status
     * @return string
     */
    public function selectTypeAndMessageDataForCarrierEN($message_data, $sender_info, $status, $order) {
        $message_data['title'] = 'Package Info';
        if (!empty($status['status_verification']) && $status['status_verification'] == 'conflicted') {
            $message_data['type'] = $sender_info['full_name'] . ' ' . 'has marked package #' . $order['order_id'] . ' conflicted. Please do contact with Barq admin to resolve this issue.';
            $message_data['message'] = $sender_info['full_name'] . ' ' . 'has marked package #' . $order['order_id'] . ' conflicted. Please do contact with Barq to adminresolve this issue.';
        }
        if ($status['status_id'] == 4) {
            $message_data['type'] = $sender_info['full_name'] . ' ' . 'has canceled package #' . $order['order_id'] . '.';
            $message_data['message'] = $sender_info['full_name'] . ' ' . 'has canceled package #' . $order['order_id'] . '.';
        }
        if ($status['status_id'] == 5 && $status['status_verification'] == 'verified') {
            $message_data['type'] = $sender_info['full_name'] . ' ' . 'has marked package #' . $order['order_id'] . ' picked. ';
            $message_data['message'] = $sender_info['full_name'] . ' ' . 'has marked package #' . $order['order_id'] . ' picked.';
        }
        if ($status['status_id'] == 6 && $status['status_verification'] == 'verified') {
            $message_data['type'] = $sender_info['full_name'] . ' ' . 'has marked package #' . $order['order_id'] . ' delivered. 😍';
            $message_data['message'] = $sender_info['full_name'] . ' ' . 'has marked package #' . $order['order_id'] . ' delivered. 😍';
        }
        return $message_data;
    }

    /**
     * selectTypeAndMessageDataForCarrierAR method
     * @param type $message_data
     * @param type $sender_info
     * @param type $status
     * @return string
     */
    public static function selectTypeAndMessageDataForCarrierAR($message_data, $sender_info, $status, $order) {
        $message_data['title'] = 'معلومات الحزمة';
        if (!empty($status['status_verification']) && $status['status_verification'] == 'conflicted') {
            $message_data['type'] = '، ممكن تتواصل مع إدارة برق لحل المشكلة' . $sender_info['full_name'] . ' بلغ عن وجود تعارض بالشحنة #' . $order['order_id'];
            $message_data['message'] = '، ممكن تتواصل مع إدارة برق لحل المشكلة' . $sender_info['full_name'] . ' بلغ عن وجود تعارض بالشحنة #' . $order['order_id'];
        }
        if ($status['status_id'] == 4) {
            $message_data['type'] = $sender_info['full_name'] . ' ألغيت الشحنة #' . $order['order_id'] . '👍';
            $message_data['message'] = $sender_info['full_name'] . ' ألغيت الشحنة #' . $order['order_id'] . '👍';
        }
        if ($status['status_id'] == 5 && $status['status_verification'] == 'verified') {
            $message_data['type'] = $sender_info['full_name'] . ' استلم الشحنة #' . $order['order_id'] . '👍';
            $message_data['message'] = $sender_info['full_name'] . ' استلم الشحنة #' . $order['order_id'] . '👍';
        }
        if ($status['status_id'] == 6 && $status['status_verification'] == 'verified') {
            $message_data['type'] = $sender_info['full_name'] . ' وصَّل الشحنة #' . $order['order_id'] . '😍';
            $message_data['message'] = $sender_info['full_name'] . ' وصَّل الشحنة #' . $order['order_id'] . '😍';
        }
        return $message_data;
    }

}
