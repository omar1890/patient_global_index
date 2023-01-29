<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHospitalRequest;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Models\Hospital;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::with(['admin', 'media'])->get();

        $users = User::get();

        return view('admin.hospitals.index', compact('hospitals', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('hospital_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hospitals.create', compact('admins'));
    }

    public function store(StoreHospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());

        foreach ($request->input('license', []) as $file) {
            $hospital->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('license');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hospital->id]);
        }

        return redirect()->route('admin.hospitals.index');
    }

    public function edit(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->load('admin');

        return view('admin.hospitals.edit', compact('hospital'));
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

        return redirect()->route('admin.hospitals.index');
    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->load('admin');

        return view('admin.hospitals.show', compact('hospital'));
    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return back();
    }

    public function massDestroy(MassDestroyHospitalRequest $request)
    {
        Hospital::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hospital_create') && Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Hospital();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
