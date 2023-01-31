@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.patientMedicine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.patient-medicines.update", [$patientMedicine->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="medicine_id">{{ trans('cruds.patientMedicine.fields.medicine') }}</label>
                <select class="form-control select2 {{ $errors->has('medicine') ? 'is-invalid' : '' }}" name="medicine_id" id="medicine_id" required>
                    @foreach($medicines as $id => $entry)
                        <option value="{{ $id }}" {{ (old('medicine_id') ? old('medicine_id') : $patientMedicine->medicine->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('medicine'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medicine') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patientMedicine.fields.medicine_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.patientMedicine.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $patientMedicine->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patientMedicine.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dose">{{ trans('cruds.patientMedicine.fields.dose') }}</label>
                <input class="form-control {{ $errors->has('dose') ? 'is-invalid' : '' }}" type="text" name="dose" id="dose" value="{{ old('dose', $patientMedicine->dose) }}">
                @if($errors->has('dose'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dose') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patientMedicine.fields.dose_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.patientMedicine.fields.start_date') }}</label>
                <input class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $patientMedicine->start_date) }}">
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patientMedicine.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.patientMedicine.fields.end_date') }}</label>
                <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $patientMedicine->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patientMedicine.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_continuous') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_continuous" value="0">
                    <input class="form-check-input" type="checkbox" name="is_continuous" id="is_continuous" value="1" {{ $patientMedicine->is_continuous || old('is_continuous', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_continuous">{{ trans('cruds.patientMedicine.fields.is_continuous') }}</label>
                </div>
                @if($errors->has('is_continuous'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_continuous') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patientMedicine.fields.is_continuous_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection