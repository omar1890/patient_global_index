@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patientMedicine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patient-medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.id') }}
                        </th>
                        <td>
                            {{ $patientMedicine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.medicine') }}
                        </th>
                        <td>
                            {{ $patientMedicine->medicine->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.patient') }}
                        </th>
                        <td>
                            {{ $patientMedicine->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.dose') }}
                        </th>
                        <td>
                            {{ $patientMedicine->dose }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.start_date') }}
                        </th>
                        <td>
                            {{ $patientMedicine->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.end_date') }}
                        </th>
                        <td>
                            {{ $patientMedicine->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.is_continuous') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $patientMedicine->is_continuous ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patient-medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection