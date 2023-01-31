<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientMedicineRequest;
use App\Http\Requests\UpdatePatientMedicineRequest;
use App\Http\Resources\Admin\PatientMedicineResource;
use App\Models\PatientMedicine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientMedicineApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientMedicineResource(PatientMedicine::with(['medicine', 'patient'])->get());
    }

    public function store(StorePatientMedicineRequest $request)
    {
        $patientMedicine = PatientMedicine::create($request->all());

        return (new PatientMedicineResource($patientMedicine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PatientMedicine $patientMedicine)
    {
        abort_if(Gate::denies('patient_medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientMedicineResource($patientMedicine->load(['medicine', 'patient']));
    }

    public function update(UpdatePatientMedicineRequest $request, PatientMedicine $patientMedicine)
    {
        $patientMedicine->update($request->all());

        return (new PatientMedicineResource($patientMedicine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PatientMedicine $patientMedicine)
    {
        abort_if(Gate::denies('patient_medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientMedicine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
