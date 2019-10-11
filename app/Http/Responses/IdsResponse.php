<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of IdsResponse
 *
 * @author qadeer
 */
use App\Http\Responses\BaseResponse;

class IdsResponse extends BaseResponse {

    /**
     * prepareImagesResponse response method to prepare response of images
     * @param type $ids
     * @return string
     */
    public function prepareImagesResponse($ids) {
        $response = [];
        foreach ($ids as $key => $id) {
            $response[$key]['id'] = $id['uuid'];
            $response[$key]['image'] = $this->getImageUtils()->s3_image_paths['home_url'] . $this->getImageUtils()->s3_image_paths['ID_images'] . $id['image'];
            $response[$key]['status'] = $id['status'] == 1 ? true : false;
        }
        return $response;
    }

}
