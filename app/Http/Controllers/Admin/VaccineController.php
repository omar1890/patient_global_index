<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVaccineRequest;
use App\Http\Requests\StoreVaccineRequest;
use App\Http\Requests\UpdateVaccineRequest;
use App\Models\Patient;
use App\Models\Vaccine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VaccineController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vaccine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccines = Vaccine::with(['patient'])->get();

        $patients = Patient::get();

        return view('admin.vaccines.index', compact('patients', 'vaccines'));
    }

    public function create()
    {
        abort_if(Gate::denies('vaccine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('smoking', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vaccines.create', compact('patients'));
    }

    public function store(StoreVaccineRequest $request)
    {
        $vaccine = Vaccine::create($request->all());

        return redirect()->route('admin.vaccines.index');
    }

    public function edit(Vaccine $vaccine)
    {
        abort_if(Gate::denies('vaccine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('smoking', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vaccine->load('patient');

        return view('admin.vaccines.edit', compact('patients', 'vaccine'));
    }

    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        $vaccine->update($request->all());

        return redirect()->route('admin.vaccines.index');
    }

    public function show(Vaccine $vaccine)
    {
        abort_if(Gate::denies('vaccine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccine->load('patient');

        return view('admin.vaccines.show', compact('vaccine'));
    }

    public function destroy(Vaccine $vaccine)
    {
        abort_if(Gate::denies('vaccine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vaccine->delete();

        return back();
    }

    public function massDestroy(MassDestroyVaccineRequest $request)
    {
        Vaccine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
