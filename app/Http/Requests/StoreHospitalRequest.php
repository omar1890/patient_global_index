<?php

namespace App\Http\Requests;

use App\Models\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHospitalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hospital_create');
    }

    public function rules()
    {
        return [
            'admin_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'max:50',
                'required',
                'unique:hospitals',
            ],
            'address' => [
                'string',
                'max:250',
                'required',
            ],
            'license' => [
                'array',
            ],
        ];
    }
}
