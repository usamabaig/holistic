<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;

class StripeService extends BaseService {

    function __construct() {
        \Stripe\Stripe::setApiKey(config('paths.stripe_key'));
    }

    /**
     * createStripCustomer method
     * @param type $email
     * @return stripe customer
     */
    public function createStripCustomer($email) {
        try {
            $customer = \Stripe\Customer::create(array(
                        'email' => $email,
            ));
            return $customer;
        } catch (\Stripe\Error\Base $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        } catch (Exception $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        }
    }

    public function createCharge($ammount, $token, $cus_token) {
        try {
            $charge = \Stripe\Charge::create(array(
                        "amount" => $ammount * 100,
                        "currency" => "SAR",
                        "source" => $token,
                        'customer' => $cus_token,
            ));
            return $charge;
        } catch (\Stripe\Error\RateLimit $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        } catch (\Stripe\Error\InvalidRequest $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        } catch (\Stripe\Error\Authentication $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        } catch (\Stripe\Error\ApiConnection $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        } catch (\Stripe\Error\Base $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        } catch (Exception $e) {
            return $this->getCommonUtils()->jsonErrorResponse($e->getMessage());
        }
    }

}
