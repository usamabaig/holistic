<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Http\Utilties\BaseUtility;

class PushNotificationUtils extends BaseUtility {

    public function sendNotificationToUser($device_token, $messageData = null, $totalBadgeCount = 0) {
        $iosNotificationDetail = $this->setIosNotificationDataParameters($messageData, $totalBadgeCount);
        $this->sendPushNotificationToIOS($device_token, $iosNotificationDetail);
        return true;
    }

    public function setIosNotificationDataParameters($message_data, $badgeCount = 0) {

        $message = array(
            'aps' => array(
                'alert' => $message_data['type'],
                'sound' => 'default',
                'content-available' => 1,
                'badge' => $badgeCount,
            ),
            'type' => 'Order',
            'data' => $message_data
        );
        return $message;
    }

    // function for sending pushNotification to android devices
    public function sendPushNotificationToAndroid($registrationIds, $message_data) {
        $APPYKEY = 'AAAAXhOTpEU:APA91bGC-gV0_iVJiI154LAz84aqWR-kq0FTQN6o7PSS047qp8MhlhtojHrCPU_Cb4BvPF5tSVU1M9IYd_A7BUEkri3-aqJOJ1cWqiJvlr9pEoXwathBOJa0rojQZi7BoE7RTvoGjJan';
        try {
            $fields = array
                (
                'registration_ids' => array($registrationIds),
                'data' => $message_data
            );
            $headers = array(
                'Authorization: key=' . $APPYKEY,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (Exception $ex) {
            return true;
        }
    }

    /**
     * sendPushNotificationToIOS sends notification to IOS users
     * @param type $registrationId
     * @param type $message_data
     * @return boolean
     */
    public function sendPushNotificationToIOS($registrationId, $message_data) {
//        $pemFile = public_path('barq_carrier_dev.pem');
        $pemFile = public_path('BarqCarrier.pem');
        $deviceToken = str_replace(array(' ', '<', '>'), '', $registrationId);
        $message = self::setIosNotificationDataParameters($message_data, $badgeCount = 0);
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $pemFile);
        stream_context_set_option($ctx, 'ssl', 'passphrase', 'push');
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx
//                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx
        );
        $payload = json_encode($message);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));
        fclose($fp);
        return true;
    }

    /**
     * refineDeviceTokens method removes extra spaces
     * @param type $deviceTokens
     * @return type
     */
    public function refineDeviceTokens($deviceTokens) {
        $refinedTokens = array();
        $index = 0;
        foreach ($deviceTokens as $key => $value) {
            if (!empty($value)) {
                $refinedTokens[$index] = str_replace(array(' ', '<', '>'), '', $value);
                $index++;
            }
        }
        return $refinedTokens;
    }

}
