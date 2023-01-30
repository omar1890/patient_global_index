<?php

namespace App\Http\Requests;

use App\Models\PatientMedicine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientMedicineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_medicine_edit');
    }

    public function rules()
    {
        return [
            'medicine_id' => [
                'required',
                'integer',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
            'dose' => [
                'string',
                'nullable',
            ],
            'start_date' => [
                'string',
                'nullable',
            ],
            'end_date' => [
                'string',
                'nullable',
            ],
        ];
    }
}
