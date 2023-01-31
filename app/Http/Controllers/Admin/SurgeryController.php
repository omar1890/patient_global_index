<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurgeryRequest;
use App\Http\Requests\StoreSurgeryRequest;
use App\Http\Requests\UpdateSurgeryRequest;
use App\Models\Patient;
use App\Models\Surgery;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurgeryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('surgery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surgeries = Surgery::with(['patient'])->get();

        $patients = Patient::get();

        return view('admin.surgeries.index', compact('patients', 'surgeries'));
    }

    public function create()
    {
        abort_if(Gate::denies('surgery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.surgeries.create', compact('patients'));
    }

    public function store(StoreSurgeryRequest $request)
    {
        $surgery = Surgery::create($request->all());

        return redirect()->route('admin.surgeries.index');
    }

    public function edit(Surgery $surgery)
    {
        abort_if(Gate::denies('surgery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surgery->load('patient');

        return view('admin.surgeries.edit', compact('patients', 'surgery'));
    }

    public function update(UpdateSurgeryRequest $request, Surgery $surgery)
    {
        $surgery->update($request->all());

        return redirect()->route('admin.surgeries.index');
    }

    public function show(Surgery $surgery)
    {
        abort_if(Gate::denies('surgery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surgery->load('patient');

        return view('admin.surgeries.show', compact('surgery'));
    }

    public function destroy(Surgery $surgery)
    {
        abort_if(Gate::denies('surgery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surgery->delete();

        return back();
    }

    public function massDestroy(MassDestroySurgeryRequest $request)
    {
        Surgery::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
