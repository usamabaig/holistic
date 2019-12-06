<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\Admin\SliderResource;
use App\Slider;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SliderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
       
    }

    public function sliderImages()
    {
        $result = Slider::get();
        return new SliderResource($result);    
    }


}
