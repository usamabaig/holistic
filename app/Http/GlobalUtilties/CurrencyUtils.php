<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CurrencyUtils
 *
 * @author qadeer
 */

namespace App\Http\GlobalUtilties;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilties\BaseUtility;
use Request;
 
class CurrencyUtils extends BaseUtility {

    /**
     * convertCurrency method covert currency as per user need
     * @return type
     */
    public function convertCurrency() {

        $request_params = Request::all();

        $validation = Validator::make($request_params, $this->getRulesUtils()->currency_conversion, $this->getRulesUtils()->selectLanguageForMessages($rules = 'currency_conversion', $request_params['lang']));

        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }

        $response = $this->getCommonUtils()->selectConversionMethod($request_params['amount'], $request_params['from_cur'], $request_params['to_cur']);
        
        if ($response['success'] == true) {
            $data['converted_currency_amount'] = $response['converted_amount'];
            $data['amount'] = $request_params['amount'];
            $data['from_cur'] = $request_params['from_cur'];
            $data['to_cur'] = $request_params['to_cur'];

            return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['general_success'], $data);
        }

        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['currency_not_converted']);
    }

}
