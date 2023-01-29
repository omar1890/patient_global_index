<?php

namespace App\Http\Requests;

use App\Models\Allergy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAllergyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('allergy_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
