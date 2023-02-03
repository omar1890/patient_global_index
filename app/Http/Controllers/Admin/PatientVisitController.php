<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPatientVisitRequest;
use App\Http\Requests\StorePatientVisitRequest;
use App\Http\Requests\UpdatePatientVisitRequest;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\PatientVisit;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PatientVisitController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_visit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientVisitsQuery = PatientVisit::with(['hospital', 'patient', 'media']);
        if(Auth::user()->isHospital()) {
            $patientVisitsQuery->where('hospital_id',Auth::user()->hospital->id);
        }else if(Auth::user()->isPatient()) {
            $patientVisitsQuery->where('patient_id',Auth::user()->patient->id);
        }
        $patientVisits = $patientVisitsQuery->get();
        $hospitals = Hospital::get();

        $patients = Patient::get();

        return view('admin.patientVisits.index', compact('hospitals', 'patientVisits', 'patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_visit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.patientVisits.create', compact('hospitals', 'patients'));
    }

    public function store(StorePatientVisitRequest $request)
    {
        $patientVisit = PatientVisit::create($request->all());

        foreach ($request->input('documents', []) as $file) {
            $patientVisit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $patientVisit->id]);
        }

        return redirect()->route('admin.patient-visits.index');
    }

    public function edit(PatientVisit $patientVisit)
    {
        abort_if(Gate::denies('patient_visit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patientVisit->load('hospital', 'patient');

        return view('admin.patientVisits.edit', compact('hospitals', 'patientVisit', 'patients'));
    }

    public function update(UpdatePatientVisitRequest $request, PatientVisit $patientVisit)
    {
        $patientVisit->update($request->all());

        if (count($patientVisit->documents) > 0) {
            foreach ($patientVisit->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }
            }
        }
        $media = $patientVisit->documents->pluck('file_name')->toArray();
        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $patientVisit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
            }
        }

        return redirect()->route('admin.patient-visits.index');
    }

    public function show(PatientVisit $patientVisit)
    {
        abort_if(Gate::denies('patient_visit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientVisit->load('hospital', 'patient');

        return view('admin.patientVisits.show', compact('patientVisit'));
    }

    public function destroy(PatientVisit $patientVisit)
    {
        abort_if(Gate::denies('patient_visit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientVisit->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientVisitRequest $request)
    {
        PatientVisit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('patient_visit_create') && Gate::denies('patient_visit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PatientVisit();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
