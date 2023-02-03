<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDiseaseRequest;
use App\Http\Requests\StoreDiseaseRequest;
use App\Http\Requests\UpdateDiseaseRequest;
use App\Models\Disease;
use App\Models\Patient;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DiseaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('disease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diseases = Disease::with(['patient'])->get();

        if(Auth::user()->isPatient()) {
            $diseases = Disease::where('patient_id',Auth::user()->patient->id)->with(['patient'])->get();
        }

        $patients = Patient::get();

        return view('admin.diseases.index', compact('diseases', 'patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('disease_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.diseases.create', compact('patients'));
    }

    public function store(StoreDiseaseRequest $request)
    {
        $disease = Disease::create($request->all());

        return redirect()->route('admin.diseases.index');
    }

    public function edit(Disease $disease)
    {
        abort_if(Gate::denies('disease_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $disease->load('patient');

        return view('admin.diseases.edit', compact('disease', 'patients'));
    }

    public function update(UpdateDiseaseRequest $request, Disease $disease)
    {
        $disease->update($request->all());

        return redirect()->route('admin.diseases.index');
    }

    public function show(Disease $disease)
    {
        abort_if(Gate::denies('disease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disease->load('patient');

        return view('admin.diseases.show', compact('disease'));
    }

    public function destroy(Disease $disease)
    {
        abort_if(Gate::denies('disease_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disease->delete();

        return back();
    }

    public function massDestroy(MassDestroyDiseaseRequest $request)
    {
        Disease::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
