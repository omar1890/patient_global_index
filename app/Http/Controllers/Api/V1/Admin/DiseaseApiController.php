<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiseaseRequest;
use App\Http\Requests\UpdateDiseaseRequest;
use App\Http\Resources\Admin\DiseaseResource;
use App\Models\Disease;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiseaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('disease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DiseaseResource(Disease::with(['patient'])->get());
    }

    public function store(StoreDiseaseRequest $request)
    {
        $disease = Disease::create($request->all());

        return (new DiseaseResource($disease))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Disease $disease)
    {
        abort_if(Gate::denies('disease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DiseaseResource($disease->load(['patient']));
    }

    public function update(UpdateDiseaseRequest $request, Disease $disease)
    {
        $disease->update($request->all());

        return (new DiseaseResource($disease))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Disease $disease)
    {
        abort_if(Gate::denies('disease_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disease->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
