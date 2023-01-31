<?php

namespace App\Http\Requests;

use App\Models\PatientMedicine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPatientMedicineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:patient_medicines,id',
        ];
    }
}
