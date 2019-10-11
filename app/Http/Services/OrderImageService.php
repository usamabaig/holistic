<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Services\BaseService;
use App\Http\Models\OrderImage;
use DB;

class OrderImageService extends BaseService {

    public function getOrderImageModel() {
        return new OrderImage();
    }

    /**
     * uploadOrderImages method
     * @param type $inputs
     * @param type $order
     * @return type
     */
    public function uploadOrderImages($inputs, $order) {

        $response = $this->getImageUtils()->uploadImageFiles($inputs);


        foreach ($response['media'] as $key => $order_image) {
            $images_arr[$key] = $this->prepareImageData($order_image, $order);
        }

        $save_images = $this->getOrderImageModel()->insert($images_arr);

        if (($response['images_counter'] == $response['thumnail_counter']) && $save_images) {

            return true;
        }
        return false;
    }

    /**
     * prepareImageData method
     * @param type $order_image
     * @param type $order
     * @return type
     */
    public function prepareImageData($order_image, $order) {
        $image_data = [];
        foreach ($order_image as $image) {
            $image_data['image'] = $image;
            $image_data['order_id'] = $order['id'];
            $image_data['uuid'] = \Uuid::generate()->string;
        }
        return $image_data;
    }

}
