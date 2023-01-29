<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllergyRequest;
use App\Http\Requests\UpdateAllergyRequest;
use App\Http\Resources\Admin\AllergyResource;
use App\Models\Allergy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllergyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('allergy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AllergyResource(Allergy::with(['patient'])->get());
    }

    public function store(StoreAllergyRequest $request)
    {
        $allergy = Allergy::create($request->all());

        return (new AllergyResource($allergy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Allergy $allergy)
    {
        abort_if(Gate::denies('allergy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AllergyResource($allergy->load(['patient']));
    }

    public function update(UpdateAllergyRequest $request, Allergy $allergy)
    {
        $allergy->update($request->all());

        return (new AllergyResource($allergy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Allergy $allergy)
    {
        abort_if(Gate::denies('allergy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allergy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
