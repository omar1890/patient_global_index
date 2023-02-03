<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatientMedicineRequest;
use App\Http\Requests\StorePatientMedicineRequest;
use App\Http\Requests\UpdatePatientMedicineRequest;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientMedicine;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PatientMedicineController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientMedicines = PatientMedicine::with(['medicine', 'patient'])->get();

        if(Auth::user()->isPatient()) {
            $patientMedicines = PatientMedicine::where('patient_id',Auth::user()->patient->id)->with(['medicine','patient'])->get();
        }

        $medicines = Medicine::get();

        $patients = Patient::get();

        return view('admin.patientMedicines.index', compact('medicines', 'patientMedicines', 'patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicines = Medicine::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.patientMedicines.create', compact('medicines', 'patients'));
    }

    public function store(StorePatientMedicineRequest $request)
    {
        $patientMedicine = PatientMedicine::create($request->all());

        return redirect()->route('admin.patient-medicines.index');
    }

    public function edit(PatientMedicine $patientMedicine)
    {
        abort_if(Gate::denies('patient_medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicines = Medicine::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patientMedicine->load('medicine', 'patient');

        return view('admin.patientMedicines.edit', compact('medicines', 'patientMedicine', 'patients'));
    }

    public function update(UpdatePatientMedicineRequest $request, PatientMedicine $patientMedicine)
    {
        $patientMedicine->update($request->all());

        return redirect()->route('admin.patient-medicines.index');
    }

    public function show(PatientMedicine $patientMedicine)
    {
        abort_if(Gate::denies('patient_medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientMedicine->load('medicine', 'patient');

        return view('admin.patientMedicines.show', compact('patientMedicine'));
    }

    public function destroy(PatientMedicine $patientMedicine)
    {
        abort_if(Gate::denies('patient_medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientMedicine->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientMedicineRequest $request)
    {
        PatientMedicine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
