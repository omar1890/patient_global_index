@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.weight') }}
                        </th>
                        <td>
                            {{ $patient->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.height') }}
                        </th>
                        <td>
                            {{ $patient->height }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.smoking') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $patient->smoking ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.blood_type') }}
                        </th>
                        <td>
                            {{ App\Models\Patient::BLOOD_TYPE_SELECT[$patient->blood_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.avg_blood_pressure') }}
                        </th>
                        <td>
                            {{ $patient->avg_blood_pressure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.user') }}
                        </th>
                        <td>
                            {{ $patient->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.name') }}
                        </th>
                        <td>
                            {{ $patient->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.identity_number') }}
                        </th>
                        <td>
                            {{ $patient->identity_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.documents') }}
                        </th>
                        <td>
                            @foreach($patient->documents as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
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
            <a class="nav-link" href="#patient_surgeries" role="tab" data-toggle="tab">
                {{ trans('cruds.surgery.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_diseases" role="tab" data-toggle="tab">
                {{ trans('cruds.disease.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_vaccines" role="tab" data-toggle="tab">
                {{ trans('cruds.vaccine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_allergies" role="tab" data-toggle="tab">
                {{ trans('cruds.allergy.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_patient_visits" role="tab" data-toggle="tab">
                {{ trans('cruds.patientVisit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="patient_surgeries">
            @includeIf('admin.patients.relationships.patientSurgeries', ['surgeries' => $patient->patientSurgeries])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_diseases">
            @includeIf('admin.patients.relationships.patientDiseases', ['diseases' => $patient->patientDiseases])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_vaccines">
            @includeIf('admin.patients.relationships.patientVaccines', ['vaccines' => $patient->patientVaccines])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_allergies">
            @includeIf('admin.patients.relationships.patientAllergies', ['allergies' => $patient->patientAllergies])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_patient_visits">
            @includeIf('admin.patients.relationships.patientPatientVisits', ['patientVisits' => $patient->patientPatientVisits])
        </div>
    </div>
</div>

@endsection