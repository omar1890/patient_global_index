<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVaccineRequest;
use App\Http\Requests\UpdateVaccineRequest;
use App\Http\Resources\Admin\VaccineResource;
use App\Models\Vaccine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VaccineApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vaccine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VaccineResource(Vaccine::with(['patient'])->get());
    }

    public function store(StoreVaccineRequest $request)
    {
        $vaccine = Vaccine::create($request->all());

        return (new VaccineResource($vaccine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Vaccine $vaccine)
    {
        abort_if(Gate::denies('vaccine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VaccineResource($vaccine->load(['patient']));
    }

    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        $vaccine->update($request->all());

        return (new VaccineResource($vaccine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Vaccine $vaccine)
    {
        abort_if(Gate::denies('vaccine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
