<?php

namespace App\Http\Requests;

use App\SubCatagory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSubCatagoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_catagory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
