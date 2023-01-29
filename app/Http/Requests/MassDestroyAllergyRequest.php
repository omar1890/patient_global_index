<?php

namespace App\Http\Requests;

use App\Models\Allergy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAllergyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('allergy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:allergies,id',
        ];
    }
}
