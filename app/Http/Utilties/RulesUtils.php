<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

class RulesUtils {

    /**
     * This method select appropriate messages and language for messages 
     *
     * @return $messages
     */
    public function selectLanguageForMessages($rules, $language = 'EN') {
        if (isset($rules) && !empty($language)) {
            $messages_type = $rules . '_' . strtolower($language);
            $messages = self::${$messages_type};
            return $messages;
        }
    }

    /**
     * Login rules and their translation goes here.
     *
     * 
     */
    public $login_rules = [
        'phone_no' => 'required',
        'password' => 'required|min:8',
        'user_role_id' => 'required',
    ];
    public static $login_rules_en = [
        'phone_no.required' => 'phone number field is required',
        'password.required' => 'password field is required',
        'password.min' => 'password should contain at least 8 characters',
        'user_role_id.required' => 'role field is required',
    ];

    /**
     * unique user phone  rules and their translation goes here.
     *
     */
    public $unique_phone_rules = [
        'phone_no' => 'required',
    ];
    public static $unique_phone_rules_en = [
        'phone_no.required' => 'phone number field is required',
    ];

    /**
     * register_user_rules_with_email and their translation goes here.
     *
     */
    public $register_user_rules_with_email = [
        'verification_code' => 'required',
        'full_name' => 'required',
        'password' => 'required|min:8',
        'phone_no' => 'required',
        'user_role_id' => 'required',
        'email' => 'required|email',
        // 'profile_image' => 'required',
    ];
    public static $register_user_rules_with_email_en = [
        'verification_code.required' => 'verfication code field is required',
        'full_name.required' => 'full name field is required',
        'password.required' => 'password field is required',
        'password.min' => 'password should contains atleast 8 letter',
        'phone_no.required' => 'phone number field is required',
        'user_role_id.required' => 'role field is required',
        'email.required' => 'email field is required',
        'email.unique' => 'this email has already been taken',
        'email.email' => 'email format is invalid',
        // 'profile_image.required' => 'please select an image'
    ];

    /**
     * Check verification code rules
     */
    public $check_verification_code = [
        'phone_no' => 'required',
        'verification_code' => 'required',
    ];
    public static $check_verification_code_en = [
        'phone_no.required' => 'phone number field is required',
        'verification_code.required' => 'verification field is required',
    ];

    /**
     * forgot password  rules and their translation goes here.
     *
     */
    public $forgot_password_rules = [
        'recovery_type' => 'required|in:Email,Phone',
        'user_role_id' => 'required|in:1'
    ];
    public static $forgot_password_rules_en = [
        'recovery_type.required' => 'recovery type feild is required',
        'recovery_type.in' => 'recovery type should be email or phone',
        'user_role_id.required' => 'role field is required',
        'user_role_id.in' => 'selected role is not valid'
    ];
    /**
     * check reset code rules  and their translation goes here.
     *
     */
    public $check_code_rules = [
        'reset_code' => 'required'
    ];
    public static $check_code_rules_en = [
        'reset_code.required' => 'reset code field is required'
    ];
    /**
     * update password  rules  and their translation goes here.
     *
     */
    public $update_password_rules = [
        'reset_code' => 'required',
        'password' => 'required|',
    ];
    public static $update_password_rules_en = [
        'reset_code.required' => 'reset code field is required',
        'password.required' => 'password field is required',
    ];
    /**
     * update password  rules  and their translation goes here.
     *
     */
    public $edit_password_rules = [
        'old_password' => 'required',
        'new_password' => 'required',
    ];
    public static $edit_password_rules_en = [
        'old_password.required' => 'old password field is required',
        'new_password.required' => 'new password field is required',
    ];
    
    public $get_trips_rules = [
        'to_lat' => 'required',
        'to_lng' => 'required',
        'from_lat' => 'required',
        'from_lng' => 'required',
        'to_city' => 'required',
        'from_city' => 'required',
        'departure_timezone' => 'required',
//        'method_id' => 'required',
//        'pickup_preference_id' => 'required',
//        'dropoff_preference_id' => 'required',
    ];
    public static $get_trips_rules_en = [
        'to_lat.required' => 'to lattitude field is required',
        'to_lng.required' => 'to longitude field is required',
        'from_lat.required' => 'from lattitude field is required',
        'from_lng.required' => 'from longitude field is required',
        'to_city.required' => 'to city field is required',
        'from_city.required' => 'from city field is required',
        'departure_timezone.required' => 'departure timezone field is required',
        'method_id.required' => 'please select your preferred travelling method',
        'pickup_preference_id.required' => 'please select your pick-up preference',
        'dropoff_preference_id.required' => 'please select your drop-off preference',
    ];
    
    public $rate_trip_rules = [
        'trip_id' => 'required',
        'order_id' => 'required',
        'rate' => 'required|numeric|min:0|max:5',
    ];
    public static $rate_trip_rules_en = [
        'trip_id.required' => 'trip id field is required',
        'user_id.required' => 'user id field is required',
        'order_id.required' => 'order id field is required',
        'rate.required' => 'rate field is required',
        'rate.max' => 'rate field should be less than 5',
        'rate.min' => 'rate field should be greater than 0',
        'rate.numeric' => 'rate field should be numeric',
    ];
    

    /**
     * get  trip rules  and their translation goes here.
     *
     */
    public $change_status_rules = [
        'order_id' => 'required',
        'status' => 'required',
    ];
    public static $change_status_rules_en = [
        'order_id.required' => 'order id field is required',
        'status.required' => 'status field is required',
    ];
   

    /**
     * add order rules  and their translation goes here.
     *
     */
    public $edit_order_rules = [
        'lat' => 'required',
        'lng' => 'required',
        'city' => 'required',
        'full_address' => 'required',
    ];
    public static $edit_order_rules_en = [
        'lat.required' => 'System is unable to verify your location. Please enable and set your location.',
        'lng.required' => 'System is unable to verify your location. Please enable and set your location.',
        'city.required' => 'System is unable to verify your location. Please enable and set your location.',
        'full_address.required' => 'System is unable to verify your location. Please enable and set your location.',
    ];
    
    public $add_order_rules = [
        'size_id' => 'required',
        'category_id' => 'required',
        'order_images.0' => 'required',
        'recipient_phone' => 'required',
        'recipient_name' => 'required',
        'to_lat' => 'required',
        'to_lng' => 'required',
        'from_lat' => 'required',
        'from_lng' => 'required',
        'to_city' => 'required|different:from_city',
        'from_city' => 'required||different:to_city',
        'converted_price' => 'required',
        'converted_currency_code' => 'required',
        'converted_currency_datetime' => 'required|date_format:Y-m-d H:i:s',
//        'method_id' => 'required',
//        'pickup_preference_id' => 'required',
//        'dropoff_preference_id' => 'required',
    ];
    public static $add_order_rules_en = [
        'size_id.required' => 'size id field is required',
        'category_id.required' => 'category id field is required',
        'order_images.0.required' => 'shipment image is required',
        'recipient_phone.required' => 'recipoent phone number field is required',
        'recipient_name.required' => 'recipient name field is required',
        'to_lat.required' => 'System is unable to verify your arrival location. Please enable and set your location.',
        'to_lng.required' => 'System is unable to verify your arrival location. Please enable and set your location.',
        'from_lat.required' => 'System is unable to verify your departure location. Please enable and set your location.',
        'from_lng.required' => 'System is unable to verify your departure location. Please enable and set your location.',
        'to_city.required' => 'System is unable to verify your arrival location. Please enable and set your location.',
        'from_city.required' => 'System is unable to verify your departure location. Please enable and set your location.',
        'to_country.required' => 'System is unable to verify your arrival location. Please enable and set your location.',
        'from_country.required' => 'System is unable to verify your departure location. Please enable and set your location.',
        'converted_price.required' => 'converted price field is required',
        'converted_currency_code.required' => 'converted currency code field is required',
        'converted_currency_datetime.required' => 'converted currency datetime field is required|datetime',
        'converted_currency_datetime.date_format' => 'converted currency datetime should be a valid date time',
        'method_id.required' => 'please select a travelling method for package',
        'pickup_preference_id.required' => 'please select a pickup preference',
        'dropoff_preference_id.required' => 'please select a drop off preference',
        'to_city.different' => 'You can not make a shipment with same pickup and dropoff city.',
        'from_city.different' => 'You can not make a shipment with same pickup and dropoff city.'
    ];
    public $order_dtatils = [
        'id' => 'required',
    ];
    public static $order_dtatils_en = [
        'id.required' => 'id field is required',
    ];
    public $update_setting = [
        'push_notification' => 'required|in:0, 1',
    ];
    public static $update_setting_en = [
        'push_notification.required' => 'push notification status field is required',
        'push_notification.in' => 'selected status is invalid',
    ];
    public $card_address = [
        'address_1' => 'required',
        'state' => 'required',
        'city' => 'required',
        'zip_code' => 'required',
        'country' => 'required',
    ];
    public static $card_address_en = [
        'address_1.required' => 'address1 field is required',
        'address_2.required' => 'address2 field is required',
        'state.required' => 'state field is required',
        'city.required' => 'city field is required',
        'zip_code.required' => 'zip code field is required',
        'country.required' => 'country field is required',
    ];
    public $currency_conversion = [
        'to_cur' => 'required|max:3|alpha',
        'from_cur' => 'required|max:3|alpha',
        'amount' => 'required|numeric',
    ];
    public static $currency_conversion_en = [
        'to_cur.required' => 'base currency code is required',
        'to_cur.max' => 'base currency code should have only three letters',
        'to_cur.alpha' => 'base must be entirely alphabetic characters',
        'from_cur.required' => 'local currency code is required',
        'from_cur.max' => 'local currency code should have only three letters',
        'from_cur.alpha' => 'local must be entirely alphabetic characters',
        'amount.required' => 'amount must be entirely number'
    ];
    public $upload_id = [
        'image' => 'required'
    ];
    public static $upload_id_en = [
        'image.required' => 'please select an ID document to upload',
    ];
    public $delete_id = [
        'id' => 'required'
    ];
    public static $delete_id_en = [
        'id.required' => 'please select an ID document to delete',
    ];
    public $feed_back = [
        'type' => 'required',
        'title' => 'required',
        'description' => 'required',
    ];
    public static $feed_back_en = [
        'type.required' => 'type field is required',
        'title.required' => 'title field is required',
        'decription.required' => 'description field is required',
    ];


}
