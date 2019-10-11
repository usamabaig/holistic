<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\GlobalUtilties;

use App\Http\Utilties\BaseUtility;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUtils extends BaseUtility {

    public $local_image_paths = [
        'profile_image' => 'public/uploads/profile_images/',
        'profile_cover_image' => 'public/uploads/profile_images/cover_images/',
    ];
    public $s3_image_paths = [
        'home_url' => 'http://d3n13c09rx6sh4.cloudfront.net/',
        'profile_image' => 'profile_images/',
        'profile_cover_image' => 'profile_images/cover_images/',
        'order_images' => 'order_images/',
        'signature_images' => 'signature_images/',
        'ID_images' => 'ID_images/',
        'category_images' => 'categories/',
    ];
    public $thumbnails_large = [
        'profile_image' => 'thumbnails/large/profile_images/',
        'order_images' => 'thumbnails/large/order_images/',
        'signature_images' => 'thumbnails/large/signature_images/',
        'ID_images' => 'thumbnails/large/ID_images/',
    ];
    public $thumbnails_small = [
        'profile_image' => 'thumbnails/small/profile_images/',
        'order_images' => 'thumbnails/small/order_images/',
        'signature_images' => 'thumbnails/small/signature_images/',
        'ID_images' => 'thumbnails/small/ID_images/',
    ];
    public $thumbnails_medium = [
        'profile_image' => 'thumbnails/medium/profile_images/',
        'order_images' => 'thumbnails/medium/order_images/',
        'signature_images' => 'thumbnails/medium/signature_images/',
        'ID_images' => 'thumbnails/medium/ID_images/',
    ];
    public $admin_info = [
        'admin_email' => 'qadeer.sipra@ilsainteractive.com',
        'support_email' => 'ract541@gmail.com',
        'site_title' => 'BarApp',
    ];
    public $placeholders = [
        'user_placeholder' => 'http://d3n13c09rx6sh4.cloudfront.net/profile_images/user_placeholder.png',
    ];

    /**
     * uploadSingleImage method
     * @param type $file
     * @param type $s3_destination
     * @param type $pre_fix
     * @param type $server
     * @return type
     */
    public function uploadSingleImage($file, $s3_destination, $pre_fix, $server = 's3') {
        $extension = '';
        $filename = $file->getClientOriginalName();
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        list($width, $height) = getimagesize($file);
        $full_name = $pre_fix . uniqid() . time() . '.' . 'jpg';
        $s3destination = $s3_destination;
        $upload = $file->storeAs($s3destination, $full_name, $server);
        if ($upload) {
            return array('success' => true, 'file_name' => $full_name, 'extension' => $extension);
        }
        return ['success' => false, 'file_name' => ''];
    }

    /**
     * uploadImageFiles method
     * @param type $inputs
     * @return type
     */
    public function uploadImageFiles($inputs) {
        $response = [];

        $flag = 0;

        $images = $inputs['order_images'];

        $s3_destination = $this->s3_image_paths['order_images'];

        $pre_fix = 'Order_';

        $media = [];

        foreach ($images as $key => $image) {
            $uploaded_image = $this->uploadSingleImage($image, $s3_destination, $pre_fix);

            $upload_thumbnails = $this->makeThumbnailsUploads($image, $uploaded_image['file_name']);

            if ($upload_thumbnails) {

                $flag ++;
            }
            if ($uploaded_image['success']) {
                $media[$key]['file_name'] = $uploaded_image['file_name'];
            }
        }
        $response['media'] = $media;
        $response['thumnail_counter'] = $flag;
        $response['images_counter'] = count($images);
        return $response;
    }

    public function makeThumbnailsUploads($image, $uploaded_image) {

        $large_image_sourece = Image::make($image)->resize(1242, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");
        $medium_image_sourece = Image::make($image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");
        $small_image_sourece = Image::make($image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");


        $upload_large = Storage::disk('s3')->put($this->thumbnails_large['order_images'] . $uploaded_image, (string) $large_image_sourece);
        $upload_medium = Storage::disk('s3')->put($this->thumbnails_medium['order_images'] . $uploaded_image, (string) $medium_image_sourece);
        $upload_small = Storage::disk('s3')->put($this->thumbnails_small['order_images'] . $uploaded_image, (string) $small_image_sourece);

        if ($upload_large && $upload_medium && $upload_small) {
            return true;
        }

        return false;
    }

    public function makeProfileThumbnailsUploads($image, $uploaded_image) {


        $large_image_sourece = Image::make($image)->resize(1242, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");
        $medium_image_sourece = Image::make($image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");
        $small_image_sourece = Image::make($image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");


        $upload_large = Storage::disk('s3')->put($this->thumbnails_large['profile_image'] . $uploaded_image, (string) $large_image_sourece);
        $upload_medium = Storage::disk('s3')->put($this->thumbnails_medium['profile_image'] . $uploaded_image, (string) $medium_image_sourece);
        $upload_small = Storage::disk('s3')->put($this->thumbnails_small['profile_image'] . $uploaded_image, (string) $small_image_sourece);

        if ($upload_large && $upload_medium && $upload_small) {
            return true;
        }

        return false;
    }

    public function makeIDThumbnailsUploads($image, $uploaded_image) {


        $large_image_sourece = Image::make($image)->resize(1242, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");
        $medium_image_sourece = Image::make($image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");
        $small_image_sourece = Image::make($image)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode("jpg");


        $upload_large = Storage::disk('s3')->put($this->thumbnails_large['ID_images'] . $uploaded_image, (string) $large_image_sourece);
        $upload_medium = Storage::disk('s3')->put($this->thumbnails_medium['ID_images'] . $uploaded_image, (string) $medium_image_sourece);
        $upload_small = Storage::disk('s3')->put($this->thumbnails_small['ID_images'] . $uploaded_image, (string) $small_image_sourece);

        if ($upload_large && $upload_medium && $upload_small) {
            return true;
        }

        return false;
    }

}
