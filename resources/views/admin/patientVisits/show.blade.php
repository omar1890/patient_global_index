@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patientVisit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patient-visits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.id') }}
                        </th>
                        <td>
                            {{ $patientVisit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.hospital') }}
                        </th>
                        <td>
                            {{ $patientVisit->hospital->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.patient') }}
                        </th>
                        <td>
                            {{ $patientVisit->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.doctor_name') }}
                        </th>
                        <td>
                            {{ $patientVisit->doctor_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.diagnosis') }}
                        </th>
                        <td>
                            {{ $patientVisit->diagnosis }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.date') }}
                        </th>
                        <td>
                            {{ $patientVisit->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.division') }}
                        </th>
                        <td>
                            {{ $patientVisit->division }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patientVisit.fields.documents') }}
                        </th>
                        <td>
                            @foreach($patientVisit->documents as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patient-visits.index') }}">
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
            <a class="nav-link" href="#patient_visit_patient_medicines" role="tab" data-toggle="tab">
                {{ trans('cruds.patientMedicine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="patient_visit_patient_medicines">
            @includeIf('admin.patientVisits.relationships.patientVisitPatientMedicines', ['patientMedicines' => $patientVisit->patientVisitPatientMedicines])
        </div>
    </div>
</div>

@endsection