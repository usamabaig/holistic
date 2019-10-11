<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

/**
 * Description of CallUtils
 *
 * @author qadeer
 */
use App\Http\Utilties\BaseUtility;

class CallUtils extends BaseUtility {

    /**
     * makeXMLFile method made XML file for twillio
     * @param type $message
     * @return string
     */
    public function makeXMLFile($request_params) {
        //CREATING XML FILE FOR TWILLIO
        $file_name = str_replace('+', '0', $request_params['phone_no']) . '.xml';
        $file_path = base_path('public') . '/callxmls/' . $file_name;
        //PREPARING TWIML RESPONSE(XML CONTENT)
        $response = $this->makeCodeTwiml($request_params['verification_code']);
        //WRITTING XML INTO IT
        $fp = fopen($file_path, 'w');
        fwrite($fp, $response);
        fclose($fp);
        //GIVING 777 PERMISSION SO THAT TWILLIO CAN READ IT 
        chmod($file_path, 0777);
        $localPath = base_path('public') . '/callxmls/' . $file_name;
        $s3_destination = $this->getCommonUtils()->call_paths['s3_path'] . $file_name;
        $upload = \Storage::disk('s3')->put($s3_destination, file_get_contents($localPath));
        if ($upload) {
            unlink($localPath);
        }
        return $file_name;
    }

    /**
     * makeTWIML method is responsible for making TWiml syntax for twillio
     * @param type $message
     * @return \Twilio\Twiml
     */
    public function makeCodeTwiml($code) {
        $arr = [];
        $dotted_code = str_split($code);
        foreach ($dotted_code as $key => $c_digit) {
            $c_digit = $c_digit . '. ';
            $arr[$key] = $c_digit;
        }
        $final_message = implode($arr);
        $response = new \Twilio\Twiml();
        $response->say('Your Barq verification code is.');
        $response->say($final_message);
        $response->say('This will expire in two hours.');
        $response->say('I repeat. Your Barq verification code is.');
        $response->say($final_message);
        $response->say('This will expire in two hours.');
        $response->hangup();
        return $response;
    }

}
