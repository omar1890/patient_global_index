<?php

namespace App\Http\Requests;

use App\Models\Disease;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDiseaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('disease_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'patient_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
