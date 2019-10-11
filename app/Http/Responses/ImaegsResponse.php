<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

use App\Http\Responses\BaseResponse;

class ImagesResponse extends BaseResponse {

    /**
     * prepareImagesResponse method
     * @param type $images
     * @return string
     */
    public function prepareImagesResponse($images) {
        $response = [];
        $images_jpg_arr = $this->getCommonUtils()->convertPngToJpg($images);
        if (!empty($images_jpg_arr) && count($images_jpg_arr) > 0) {
            foreach ($images_jpg_arr as $key => $image) {
                $response[$key] = $this->getImageUtils()->s3_image_paths['home_url'] . $this->getImageUtils()->thumbnails_small['order_images'] . $image;
            }
        } else {
            $response[] = 'https://image.ibb.co/kLhi3o/ico2.png';
        }
        return $response;
    }

    /**
     * prepareImagesResponse method
     * @param type $images
     * @return string
     */
    public function detailImages($images) {
        $response = [];
        $images_jpg_arr = $this->getCommonUtils()->convertPngToJpg($images);
        if (!empty($images_jpg_arr) && count($images_jpg_arr) > 0) {
            foreach ($images_jpg_arr as $key => $image) {
                $response[$key] = $this->getImageUtils()->s3_image_paths['home_url'] . $this->getImageUtils()->thumbnails_medium['order_images'] . $image;
            }
        } else {
            $response[] = 'https://image.ibb.co/kLhi3o/ico2.png';
        }
        return $response;
    }

}
