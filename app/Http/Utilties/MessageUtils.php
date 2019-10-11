<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

class MessageUtils extends BaseUtility {

    /**
     * This function selects message language and message type
     *
     */
    public function getMessageData($type, $lang = 'EN') {
        if ($lang == 'AR' && $type == 'error') {
            return $this->error_ar;
        }if ($lang == 'AR' && $type == 'success') {
            return $this->success_ar;
        }
        if ($lang == 'EN' && $type == 'error') {
            return $this->error_en;
        }if ($lang == 'EN' && $type == 'success') {
            return $this->success_en;
        }
    }

    public $success_en = [
        'general_success' => 'Process successfully processed.',
        'login_success' => 'You have logged-in successfully',
        'verifcation_code_sent' => 'Verification code has been sent using your selected medium.',
        'user_found' => 'User exist againts this phone number.',
        'signup_success' => 'You have signed up successfully.',
        'number_confirmation' => 'Phone number verified successfully.',
        'reset_code_sent_to_email' => 'Reset code has been sent to your email.',
        'code_verification_success' => 'Reset code verified successfully.',
        'password_updated' => 'Your password has been updated successfully.',
        'profile_updated' => 'Your profile has been updated successfully.',
        'package_details_found' => 'Package details found successfully.',
        'trips_found' => 'Trips found successfully.',
        'no_order_found' => 'We have not found any package.',
        'shipment_found' => 'Your packages have been found successfully.',
        'shipment_scheduled' => 'Your package is scheduled and waiting for approval.',
        'settings_updated' => 'Your settings are saved successfully',
        'order_status' => 'At the speed of lightning ⚡️your package is on its way ⚡️',
        'logout' => 'You have logged-out successfully',
        'ratting_added' => 'Thank you for your review. It has been submitted to the BARQ',
        'email_verified' => 'Your email has been verified successfully.',
        'email_send' => 'Verification email has been sent to your account.',
        'card_found' => 'Your cards have been found successfully.',
        'package_delivered' => 'Your package has been delivered at destination successfully 💃',
        'package_conflicted' => 'Your package is now in conflicted state. Barq admin will resolve this issue very soon. ⚡️',
        'package_canceled' => 'Your package has been canceled successfully. 👍',
        'package_updated' => 'Your package has been updated successfully.',
        'thanks_for_suggestions' => 'Thank you for your excellent suggestions regarding the process. Please feel free to submit any reasonable suggestion to the suggestion box.',
        'thanks_for_contact' => 'Thank you for contacting us. We try to be as responsive as possible. We will be get back to you soon.'
    ];
    
    /**
     * All the error messages with English translation goes here.
     *
     */
    public $error_en = [
        'general_error' => 'Sorry, something went wrong. We are working on getting this fixed as soon as we can',
        'invalid_login_details' => 'Please provide valid phone number and password',
        'verification_code_invalid' => 'Invalid Verification code',
        'verification_code_expired' => 'Verification code has been expired',
        'user_not_found' => 'User does not exist against these details',
        'reset_code_expired' => 'Reset code has expired',
        'invalid_old_password' => "Your old password is incorrect.",
        'can_not_place' => 'You can not make a package.',
        'order_not_found' => 'No package found.',
        'order_conflicted' => 'package is in conflicted state. Please contact admin for further proceedings',
        'order_canceled' => 'Your package status has been changed now, please refresh your screen',
        'trip_not_found' => 'No trip found',
        'add_rating_error' => 'Sorry, You can not submit rating.',
        'phone_assosiation' => 'Your number is associated with a carrier account. Please login with different phone number',
        'twillio_lookup_error' => 'The phone number you entered is incorrect, please enter a correct phone number',
        'email_link_expired' => 'Your email link has been expired.',
        'invalid_email_link' => 'Your email link is invalid.',
        'email_already_verified' => 'Your email is already verified.',
        'account_suspended' => 'Your account has been suspended. Please contact Barq admin.',
        'status_already_updated' => 'This package status has already updated by you.',
        'card_not_added' => 'Card could not be added. Please verify your information.',
        'card_not_found' => 'Please select valid card information.',
        'no_blocked' => 'This number is already registered and blocked by our system.',
        'trip_archived' => 'You can not place package against this trip because this trip is either canceled or completed by the owner.',
        'can_not_cancel_order' => 'You can not cancel a package once it is accepted by carrier.',
        'api_out_of_order' => 'Currency conversion API request limit is exceeded!',
        'enable_location' => 'The system is not able to verify your location. Please enable your location.',
        'no_search_found' => 'Sorry! No search record found',
        'cannot_submit_id' => 'You can submit more documents for verification.',
        'wrong_method_combination' => 'Please select appropriate travelling method and preference.',
        'currency_not_converted' => 'Currently, we are unable to convert you currency.',
        'email_already_taken' => 'This email is already assosiated with another sender account.',
        'edit_restriction_pickup' => 'You can not update the departure location. Your package is picked by traveller.',
        'edit_restriction_dropoff' => 'You can not update the location information. Your package is delivered by traveller.',
        'edit_restriction_general' => 'You can not update the package information. Your package is either canceled or rejected.',
        'trip_not_active' => 'Trip associated with your package is not active any more. For any query please contact Barq admin. ',
        "can't_right_image" => 'We are unable to write image data for now. Please try again',
    ];

    /**
     * All the error messages with Arabic translation goes here.
     *
     */
    

}
