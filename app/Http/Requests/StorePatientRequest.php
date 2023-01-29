<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_create');
    }

    public function rules()
    {
        return [
            'weight' => [
                'numeric',
            ],
            'height' => [
                'numeric',
            ],
            'avg_blood_pressure' => [
                'string',
                'max:20',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'identity_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
