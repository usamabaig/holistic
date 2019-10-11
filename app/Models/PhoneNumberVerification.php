<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneNumberVerification extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    protected $table = 'phone_number_verfication';
    protected $primaryKey = 'id';
    protected $fillable = ['phone_no', 'verification_code'];

    /**
     * All the database relations goes here
     *
     * 
     */
    public function saveConformationCode($data = null) {
        $phone_number_verifications = new PhoneNumberVerification($data);
        if ($phone_number_verifications->save()) {
            return true;
        }
    }

    public function getConfirmationCode($data = null) {
        $phone_data = PhoneNumberVerification::where("phone_no", "=", $data['phone_no'])
                ->where("verification_code", "=", $data['verification_code'])
                ->where("status", "=", 1)
                ->first();
        return !empty($phone_data) ? $phone_data->toArray() : NULL;
    }

    public function updatePhoneVerification($inputs) {
        return PhoneNumberVerification::where('phone_no', '=', $inputs['phone_no'])->update($inputs);
    }

    public function getPhoneByCode($data = null) {
        $phone_data = PhoneNumberVerification::where("verification_code", "=", $data['verification_code'])->first(['phone']);
        return $phone_data['attributes']['phone'];
    }

    public function chechkPhoneExistance($inputs) {
        $data = PhoneNumberVerification::where('phone_no', '=', $inputs['phone_no'])->first();
        return !empty($data) ? $data->toArray() : [];
    }

    public function deleteRecordById($id) {
        return PhoneNumberVerification::where('id', '=', $id)->delete();
    }

}
