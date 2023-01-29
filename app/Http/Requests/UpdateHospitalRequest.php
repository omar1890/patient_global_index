<?php

namespace App\Http\Requests;

use App\Models\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHospitalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hospital_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:50',
                'required',
                'unique:hospitals,name,' . request()->route('hospital')->id,
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
