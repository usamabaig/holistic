<?php

namespace App\Http\Requests;

use App\SubService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSubServiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'services.*' => [
                'integer',
            ],
            'services'   => [
                'array',
            ],
        ];
    }
}
