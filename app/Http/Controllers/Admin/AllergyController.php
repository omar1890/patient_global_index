<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAllergyRequest;
use App\Http\Requests\StoreAllergyRequest;
use App\Http\Requests\UpdateAllergyRequest;
use App\Models\Allergy;
use App\Models\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllergyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('allergy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allergies = Allergy::with(['patient'])->get();

        $patients = Patient::get();

        return view('admin.allergies.index', compact('allergies', 'patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('allergy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('smoking', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.allergies.create', compact('patients'));
    }

    public function store(StoreAllergyRequest $request)
    {
        $allergy = Allergy::create($request->all());

        return redirect()->route('admin.allergies.index');
    }

    public function edit(Allergy $allergy)
    {
        abort_if(Gate::denies('allergy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('smoking', 'id')->prepend(trans('global.pleaseSelect'), '');

        $allergy->load('patient');

        return view('admin.allergies.edit', compact('allergy', 'patients'));
    }

    public function update(UpdateAllergyRequest $request, Allergy $allergy)
    {
        $allergy->update($request->all());

        return redirect()->route('admin.allergies.index');
    }

    public function show(Allergy $allergy)
    {
        abort_if(Gate::denies('allergy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allergy->load('patient');

        return view('admin.allergies.show', compact('allergy'));
    }

    public function destroy(Allergy $allergy)
    {
        abort_if(Gate::denies('allergy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allergy->delete();

        return back();
    }

    public function massDestroy(MassDestroyAllergyRequest $request)
    {
        Allergy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
