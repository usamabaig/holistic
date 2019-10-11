<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Utilties\CommonUtils;
use App\Http\GlobalUtilties\LocationUtils;
use App\Http\GlobalUtilties\ImageUtils;
use App\Http\GlobalUtilties\TimeCoversionUtils;
use App\Http\Utilties\MessageUtils;
use App\Http\Utilties\RulesUtils;
use App\Http\Models\User;
use App\Http\Models\Order;
use App\Http\Models\Trip;
use App\Http\Models\Size;
use App\Http\Models\Category;
use App\Http\Models\PackagePrice;
use App\Http\Models\Address;
use App\Http\Models\UserProfile;
use App\Http\Models\UserDevice;
use App\Http\Responses\UserResponse;
use App\Http\Models\OrderStatusLog;
use App\Http\Models\NotificationSetting;
use App\Http\Models\PaytabsCard;
use App\Http\Utilties\PushNotificationUtils;
use App\Http\Models\Notification;
use App\Http\Models\ShippingBillingAddress;
use App\Http\Models\IpnResponse;
use App\Http\Models\Increment;
use App\Http\Models\RefundResponse;
use App\Http\Services\RequestService;
use App\Http\Responses\CardsResponse;

class BaseService {

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getMessageUtils() {
        return new MessageUtils();
    }

    public function getImageUtils() {
        return new ImageUtils();
    }

    public function getRulesUtils() {
        return new RulesUtils();
    }

    public function getUserModel() {
        return new User();
    }

    public function getSizeModel() {
        return new Size();
    }

    public function getCategoryModel() {
        return new Category();
    }

    public function getTripModel() {
        return new Trip();
    }

    public function getOrderModel() {
        return new Order();
    }

    public function getUserProfileModel() {
        return new UserProfile();
    }

    public function getLocationService() {
        return new LocationUtils();
    }

    public function getUserDeviceModel() {
        return new UserDevice();
    }

    public function getUserResponse() {
        return new UserResponse();
    }

    public function getTimeCoversionUtils() {
        return new TimeCoversionUtils();
    }

    public function getPackagePriceModel() {
        return new PackagePrice();
    }

    public function getAddressModel() {
        return new Address();
    }

    public function getOrderStatusLogModel() {
        return new OrderStatusLog();
    }

    public function getNotificationModel() {
        return new NotificationSetting();
    }

    public function getNotificationsModel() {
        return new Notification();
    }

    public function getIpnModel() {
        return new IpnResponse();
    }
    public function getIncrementModel() {
        return new Increment();
    }

    public function getShippingBillingAddress() {
        return new ShippingBillingAddress();
    }

    public function getCardModel() {
        return new PaytabsCard();
    }

    public function getPushNotificationUtils() {
        return new PushNotificationUtils();
    }

    public function getRequestService() {
        return new RequestService();
    }

    public function getCardResponse() {
        return new CardsResponse();
    }

    public function getRefundResponseModel() {
        return new RefundResponse();
    }

}
