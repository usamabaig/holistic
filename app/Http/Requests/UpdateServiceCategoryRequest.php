<?php

namespace App\Http\Requests;

use App\ServiceCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateServiceCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('service_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            // 'name' => [
            //     'required',
            // ],
        ];
    }
}
