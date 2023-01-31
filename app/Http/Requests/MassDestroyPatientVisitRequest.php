<?php

namespace App\Http\Requests;

use App\Models\PatientVisit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPatientVisitRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_visit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:patient_visits,id',
        ];
    }
}
