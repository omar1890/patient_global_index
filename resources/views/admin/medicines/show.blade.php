@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.id') }}
                        </th>
                        <td>
                            {{ $medicine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.name') }}
                        </th>
                        <td>
                            {{ $medicine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Medicine::TYPE_SELECT[$medicine->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#medicine_patient_medicines" role="tab" data-toggle="tab">
                {{ trans('cruds.patientMedicine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="medicine_patient_medicines">
            @includeIf('admin.medicines.relationships.medicinePatientMedicines', ['patientMedicines' => $medicine->medicinePatientMedicines])
        </div>
    </div>
</div>

@endsection