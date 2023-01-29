<?php

namespace App\Http\Requests;

use App\Models\Vaccine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVaccineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vaccine_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'times_vaccinated' => [
                'string',
                'required',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
