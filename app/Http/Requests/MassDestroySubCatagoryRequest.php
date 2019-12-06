<?php

namespace App\Http\Requests;

use App\SubCatagory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubCatagoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_catagory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sub_catagories,id',
        ];
    }
}
