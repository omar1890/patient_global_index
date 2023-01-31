<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePatientVisitRequest;
use App\Http\Requests\UpdatePatientVisitRequest;
use App\Http\Resources\Admin\PatientVisitResource;
use App\Models\PatientVisit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientVisitApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_visit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientVisitResource(PatientVisit::with(['hospital', 'patient'])->get());
    }

    public function store(StorePatientVisitRequest $request)
    {
        $patientVisit = PatientVisit::create($request->all());

        foreach ($request->input('documents', []) as $file) {
            $patientVisit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        return (new PatientVisitResource($patientVisit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PatientVisit $patientVisit)
    {
        abort_if(Gate::denies('patient_visit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientVisitResource($patientVisit->load(['hospital', 'patient']));
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

        return (new PatientVisitResource($patientVisit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PatientVisit $patientVisit)
    {
        abort_if(Gate::denies('patient_visit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientVisit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
