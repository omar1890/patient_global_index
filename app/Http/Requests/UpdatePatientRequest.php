<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UpdatePatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_edit');
    }

    public function rules()
    {
        $isPatient = Auth::user()->isPatient();
        return [
            'weight' => [
                'numeric',
            ],
            'height' => [
                'nullable',
                'numeric',
            ],
            'avg_blood_pressure' => [
                'string',
                'max:20',
                'nullable',
            ],
            'user_id' => !$isPatient ? [
                'required',
                'integer',
            ] : [
                'nullable',
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
            'documents' => [
                'array',
            ],
        ];
    }
}
