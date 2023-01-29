<?php

namespace App\Http\Requests;

use App\Models\Surgery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurgeryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('surgery_create');
    }

    public function rules()
    {
        return [
            'reason' => [
                'required',
            ],
            'type' => [
                'string',
                'required',
            ],
            'doctor_name' => [
                'string',
                'max:50',
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
