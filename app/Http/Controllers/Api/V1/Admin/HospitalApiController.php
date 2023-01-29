<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Http\Resources\Admin\HospitalResource;
use App\Models\Hospital;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HospitalApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HospitalResource(Hospital::with(['admin'])->get());
    }

    public function store(StoreHospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());

        foreach ($request->input('license', []) as $file) {
            $hospital->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('license');
        }

        return (new HospitalResource($hospital))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HospitalResource($hospital->load(['admin']));
    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());

        if (count($hospital->license) > 0) {
            foreach ($hospital->license as $media) {
                if (!in_array($media->file_name, $request->input('license', []))) {
                    $media->delete();
                }
            }
        }
        $media = $hospital->license->pluck('file_name')->toArray();
        foreach ($request->input('license', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $hospital->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('license');
            }
        }

        return (new HospitalResource($hospital))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
