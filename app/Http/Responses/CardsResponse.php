<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

use App\Http\Responses\BaseResponse;

class CardsResponse extends BaseResponse {

    public function preapreCardsResponse($cards) {
        $response = [];
        if (!empty($cards) && count($cards) > 0) {
            foreach ($cards as $key => $cards) {
                $response[$key]['card_token'] = $cards['card_token'];
                $response[$key]['first_4_digits'] = !empty($cards['first_4_digits']) ? $cards['first_4_digits'] : '';
                $response[$key]['last_4_digits'] = !empty($cards['last_4_digits']) ? $cards['last_4_digits'] : '';
                $response[$key]['type'] = !empty($cards['type']) ? $cards['type'] : '';
            }
        }
        return $response;
    }

}
