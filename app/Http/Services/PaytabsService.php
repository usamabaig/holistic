<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PaytabsService extends BaseService {

    /**
     * storeTransactionData prepares and save IPN data to database
     * @param type $request
     * @return type
     */
    public function storeTransactionData($request) {
        $request_params = $request->all();
        $transaction_data = $this->prepareTransactionData($request_params);
        $card = $this->getCardModel()->getSignleCardByColumnValue('transaction_id', $request_params['transaction_id']);
        $save_response = $this->getIpnModel()->saveTransactoinData($transaction_data);
        $save_refund_response = $this->prepareAndSaveResponseData($card, $request_params);
        if ($request_params['response_code'] == 5003 && isset($request_params['refund_req_amount'])) {
            return $this->getCardModel()->where('id', $card['id'])->update(['refund_status' => 1]);
        }
        return 'ok';
    }

    /**
     * prepareAndSaveResponseData method
     * @param type $card
     * @param type $request_params
     * @return type
     */
    public function prepareAndSaveResponseData($card, $request_params) {
        $response_data = [];
        $response_data['card_id'] = !empty($card['id']) ? $card['id'] : NULL;
        $response_data['refund_req_amount'] = $request_params['refund_req_amount'];
        $response_data['transaction_id'] = !empty($request_params['transaction_id']) ? $request_params['transaction_id'] : NULL;
        $response_data['response_message'] = !empty($request_params['detail']) ? $request_params['detail'] : NULL;
        $response_data['response_code'] = $request_params['response_code'];
        $response_data['refund_status'] = $this->prepareRefundStatus($request_params);
        return $this->getRefundResponseModel()->createCardResponse($response_data);
    }

    /**
     * prepareRefundStatus method
     * @param type $request_params
     * @return string
     */
    public function prepareRefundStatus($request_params) {
        $status = '';
        if ($request_params['response_code'] == 5003) {
            $status = 'refunded';
        } elseif ($request_params['response_code'] == 5000) {
            $status = 'rejected';
        } elseif ($request_params['response_code'] == 5002) {
            $status = 'force_accepted';
        }
        return $status;
    }

    /**
     * prepareTransactionData method prepares IPN response array to save on EC2
     * @param type $request_params
     * @return array
     */
    public function prepareTransactionData($request_params) {
        $data = [];
        $data['transaction_id'] = !empty($request_params['transaction_id']) ? $request_params['transaction_id'] : NULL;
        $data['shipping_address'] = !empty($request_params['shipping_address']) ? $request_params['shipping_address'] : NULL;
        $data['shipping_city'] = !empty($request_params['shipping_city']) ? $request_params['shipping_city'] : NULL;
        $data['shipping_country'] = !empty($request_params['shipping_country']) ? $request_params['shipping_country'] : NULL;
        $data['shipping_state'] = !empty($request_params['shipping_state']) ? $request_params['shipping_state'] : NULL;
        $data['shipping_postalcode'] = !empty($request_params['shipping_postalcode']) ? $request_params['shipping_postalcode'] : NULL;
        $data['phone_num'] = !empty($request_params['phone_num']) ? $request_params['phone_num'] : NULL;
        $data['email'] = !empty($request_params['email']) ? $request_params['email'] : NULL;
        $data['customer_name'] = !empty($request_params['customer_name']) ? $request_params['customer_name'] : NULL;
        $data = $this->breackDownPrepareData($data, $request_params);
        return $data;
    }

    /**
     * breackDownPrepareData method continue  prepares IPN response array to save on EC2
     * @param type $data
     * @param type $request_params
     * @return array
     */
    public function breackDownPrepareData($data, $request_params) {
        $data['response_code'] = !empty($request_params['response_code']) ? $request_params['response_code'] : NULL;
        $data['detail'] = !empty($request_params['detail']) ? $request_params['detail'] : NULL;
        $data['reference_id'] = !empty($request_params['reference_id']) ? $request_params['reference_id'] : NULL;
        $data['invoice_id'] = !empty($request_params['invoice_id']) ? $request_params['invoice_id'] : NULL;
        $data['amount'] = !empty($request_params['amount']) ? $request_params['amount'] : NULL;
        $data['currency'] = !empty($request_params['currency']) ? $request_params['currency'] : NULL;
        $data['order_id'] = !empty($request_params['order_id']) ? $request_params['order_id'] : NULL;
        $data['customer_email'] = !empty($request_params['customer_email']) ? $request_params['customer_email'] : NULL;
        $data['customer_phone'] = !empty($request_params['customer_phone']) ? $request_params['customer_phone'] : NULL;
        $data['transaction_amount'] = !empty($request_params['transaction_amount']) ? $request_params['transaction_amount'] : NULL;
        $data['transaction_currency'] = !empty($request_params['transaction_currency']) ? $request_params['transaction_currency'] : NULL;
        $data['last_4_digits'] = !empty($request_params['last_4_digits']) ? $request_params['last_4_digits'] : NULL;
        $data['first_4_digits'] = !empty($request_params['first_4_digits']) ? $request_params['first_4_digits'] : NULL;
        $data['card_brand'] = !empty($request_params['card_brand']) ? $request_params['card_brand'] : NULL;
        $data['secure_sign'] = !empty($request_params['secure_sign']) ? $request_params['secure_sign'] : NULL;
        $data['force_accept_datetime'] = !empty($request_params['force_accept_datetime']) ? $request_params['force_accept_datetime'] : NULL;
        $data['refund_req_amount'] = !empty($request_params['refund_req_amount']) ? $request_params['refund_req_amount'] : NULL;
        return $data;
    }

    /**
     * paytabsCards method saves and return response for pay tab cards
     * @return type
     */
    public function paytabsCards() {
        $request_params = Input::all();
        $user_data = $this->getUserModel()->getUserByColumnValue('user_token', $request_params['user_token']);
        if (isset($request_params['transactionID'])) {
            $validation = Validator::make($request_params['shipping'], $this->getRulesUtils()->card_address, $this->getRulesUtils()->selectLanguageForMessages($rules = 'card_address', $request_params['lang']));
            if ($validation->fails()) {
                return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
            }
            return $this->addCards($request_params, $user_data);
        } else {
            $cards = $this->getCardModel()->getCardByColumnValue('user_id', $user_data['id']);
            $response = $this->getCardResponse()->preapreCardsResponse($cards);
            return $this->getCommonUtils()->jsonSuccessResponse('Cards Found successfully', $response);
        }
    }

    /**
     * addCards method add a card to database against a user
     * @param type $request_params
     * @param type $user_data
     * @return type
     */
    public function addCards($request_params, $user_data) {
        if ($request_params['tokenizedCustomerEmail'] == null || $request_params['tokenizedCustomerPassword'] == null || $request_params['token'] == null) {
            return $this->getCommonUtils()->jsonErrorResponse("Please enter correct values");
        }
        return $this->prepareCardData($request_params, $user_data);
    }

    /**
     * prepareCardData method prepares data for card
     * @param type $request_params
     * @param type $user_data
     * @return type
     */
    public function prepareCardData($request_params, $user_data) {
        \DB::beginTransaction();
        $IPN_response = $this->getIpnModel()->getResponeByColumnValue('transaction_id', $request_params['transactionID']);
        if (!empty($IPN_response)) {
            $data = $this->prepareDataFromIPN($request_params, $IPN_response, $user_data);
        } else {
            $data = $this->prepareDataFromPaytabs($request_params, $user_data);
        }
        if (isset($request_params['merchant_id']) && !empty($request_params['merchant_id'])) {
            $data['merchant_id'] = $request_params['merchant_id'];
        } else {
            $data['merchant_id'] = config('paths.merchant_email');
        }
        $save_card = $this->getCardModel()->saveCardData($data);
        $save_address = $this->saveCardAddresses($request_params, $save_card->id);
        if ($save_card && $save_address) {
            \DB::commit();
            $cards = $this->getCardModel()->getCardByColumnValue('user_id', $user_data['id']);
            $response = $this->getCardResponse()->preapreCardsResponse($cards);
            return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['card_found'], $response);
        }
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['card_not_added']);
    }

    /**
     * prepareDataFromIPN method get data from database and prepares data to save in the database
     * @param type $request_params
     * @param type $IPN_response
     * @param type $user_data
     * @return type
     */
    public function prepareDataFromIPN($request_params, $IPN_response, $user_data) {
        $data = [];
        $data['user_id'] = $user_data['id'];
        $data['transaction_id'] = $request_params['transactionID'];
        $data['tokenized_customer_email'] = $request_params['tokenizedCustomerEmail'];
        $data['tokenized_customer_password'] = $request_params['tokenizedCustomerPassword'];
        $data['card_token'] = $request_params['token'];
        $data['first_4_digits'] = $IPN_response['first_4_digits'];
        $data['last_4_digits'] = $IPN_response['last_4_digits'];
        $data['type'] = $IPN_response['card_brand'];
        return $data;
    }

    /**
     * prepareDataFromPaytabs method get data from paytabs API and save database F
     * @param type $request_params
     * @param type $user_data
     * @return type
     */
    public function prepareDataFromPaytabs($request_params, $user_data) {
        $data = [];
        $data['user_id'] = $user_data['id'];
        $data['transaction_id'] = $request_params['transactionID'];
        $data['tokenized_customer_email'] = $request_params['tokenizedCustomerEmail'];
        $data['tokenized_customer_password'] = $request_params['tokenizedCustomerPassword'];
        $data['card_token'] = $request_params['token'];
        $request_data = $this->prepareRequestParams($request_params);
        $request_response = $this->getRequestService()->ghuzzleRequest('https://www.paytabs.com/apiv2/', 'POST', 'verify_payment_transaction', $request_data);
        if (isset($request_response)) {
            $data['last_4_digits'] = !empty($request_response['card_last_four_digits']) ? $request_response['card_last_four_digits'] : NULL;
        }
        return $data;
    }

    /**
     * prepareRequestParams method
     * @param type $request_params
     * @return string
     */
    public function prepareRequestParams($request_params) {
        $reqData['form_params'] = [
            'merchant_email' => config('paths.merchant_email'),
            'secret_key' => config('paths.paytabs_secret_key'),
            'transaction_id' => $request_params['transactionID'],
        ];
        return $reqData;
    }

    /**
     * saveCardAddresses prepares and save shipping and billing address
     * @param array $request_params
     * @return boolean
     */
    public function saveCardAddresses($request_params, $card_id) {
        $same_addresses = !empty($request_params['same_as_shipping']) ? $request_params['same_as_shipping'] : false;
        $request_params['shipping']['type'] = 'shipping';
        $shippping_address = $this->prepareAddressData($request_params['shipping'], $card_id);
        $save_shipping_address = $this->getShippingBillingAddress()->saveAddress($shippping_address);
        if ($save_shipping_address) {
            if ($same_addresses) {
                $request_params['shipping']['type'] = 'billing';
                $billing_address = $this->prepareAddressData($request_params['shipping'], $card_id, $same_addresses);
            } else {
                $request_params['billing']['type'] = 'billing';
                $billing_address = $this->prepareAddressData($request_params['billing'], $card_id, $same_addresses);
            }
            $save_billing_address = $this->getShippingBillingAddress()->saveAddress($billing_address);
            if ($save_billing_address) {
                return true;
            }
        }
        return false;
    }

    /**
     * prepareAddressData method prepares data for address
     * @param type $request_params
     * @return array
     */
    public function prepareAddressData($request_params, $card_id, $same_addresses = 0) {
        $address = [];
        $address['card_id'] = $card_id;
        $address['address_1'] = $request_params['address_1'];
        $address['address_2'] = !empty($request_params['address_2']) ? $request_params['address_2'] : null;
        $address['state'] = $request_params['state'];
        $address['city'] = $request_params['city'];
        $address['country_iso'] = $request_params['country_iso'];
        $address['zip_code'] = $request_params['zip_code'];
        $address['country'] = $request_params['country'];
        $address['type'] = $request_params['type'];
        $address['same_as_shipping'] = $same_addresses;
        return $address;
    }

}
