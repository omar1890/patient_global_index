<?php

namespace App\Http\Requests;

use App\Models\PatientVisit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientVisitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_visit_edit');
    }

    public function rules()
    {
        return [
            'hospital_id' => [
                'required',
                'integer',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
            'doctor_name' => [
                'string',
                'required',
            ],
            'diagnosis' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'division' => [
                'string',
                'nullable',
            ],
            'documents' => [
                'array',
            ],
        ];
    }
}
