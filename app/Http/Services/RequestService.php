<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Exception\RequestException;
use \GuzzleHttp\Psr7\Request;
use \GuzzleHttp\Psr7\MultipartStream;
use \Illuminate\Support\Str;
use App\Http\Services\BaseService;

class RequestService extends BaseService {

    public function ghuzzleRequest($baseUri, $type, $api_name, $request_data) { 
        try {
            $client = new Client(['base_uri' => $baseUri]);
            $res = $client->request($type, $api_name, $request_data);
            $status = $res->getStatusCode();
            if ($status == 200) {
                $resBodyContents = $res->getBody()->getContents();
                $resBodyContents_ecoded = json_decode($resBodyContents, true);
                if (empty($resBodyContents_ecoded)) {
                    $resBodyContents_ecoded = json_decode(str_replace('null', ' ', $resBodyContents), true);
                    return $resBodyContents_ecoded;
                }
                return $resBodyContents_ecoded;
            }
        } catch (RequestException $ex) {
            return false;
        }
    }

    /**
     * prepareFormData method prepare form parameters for payment
     * @param type $request_params
     * @return assosiative array
     */
    public function prepareFormData($request_params, $order, $card) {
        $reqData['form_params'] = [
            'merchant_email' => config('paths.merchant_email'),
            'secret_key' => config('paths.paytabs_secret_key'),
            'title' => $order['order_id'],
            'cc_first_name' => $card['user']['full_name'],
            'cc_last_name' => $card['user']['full_name'],
            'cc_phone_number' => $card['user']['phone_no'],
            'phone_number' => $card['user']['phone_no'],
            'customer_email' => $card['tokenized_customer_email'],
            'product_name' => 'Package',
            'order_id' => $order['order_id'],
            'amount' => $this->prepareOrderAmountData($order),
            'currency' => 'SAR',
            'ip_customer' => $this->getLocationService()->getIP(),
            'ip_merchant' => $this->getLocationService()->getServerIP(),
            //BILLING ADDRESS 
            'address_billing' => $card['billing_address']['address_1'],
            'state_billing' => $card['billing_address']['state'],
            'city_billing' => $card['billing_address']['city'],
            'postal_code_billing' => $card['billing_address']['zip_code'],
            'country_billing' => $card['billing_address']['country_iso'],
            //SHIPPING ADDRESS
            'shipping_first_name' => $card['user']['full_name'],
            'shipping_last_name' => $card['user']['full_name'],
            'address_shipping' => $card['shipping_address']['address_1'],
            'city_shipping' => $card['shipping_address']['city'],
            'state_shipping' => $card['shipping_address']['state'],
            'postal_code_shipping' => $card['shipping_address']['zip_code'],
            'country_shipping' => $card['shipping_address']['country_iso'],
            //CARD INFORMATION
            'pt_token' => $card['card_token'],
            'pt_customer_email' => $card['tokenized_customer_email'],
            'pt_customer_password' => $card['tokenized_customer_password'],
        ];
        return $reqData;
    }

    /**
     * prepareOrder method is responsible for calculating total amount of the order
     * @param type $order
     * @return double
     */
    public function prepareOrderAmountData($order) {
        if (!empty($order['offer_amount'])) {
            $order_total = $order['price'] + $order['offer_amount'];
        } else {
            $order_total = $order['price'];
        }
        return $order_total;
    }

}
