<?php

namespace App\Http\Requests;

use App\Models\Vaccine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVaccineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vaccine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vaccines,id',
        ];
    }
}
