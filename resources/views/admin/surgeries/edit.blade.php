@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.surgery.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.surgeries.update", [$surgery->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="reason">{{ trans('cruds.surgery.fields.reason') }}</label>
                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason" id="reason" required>{{ old('reason', $surgery->reason) }}</textarea>
                @if($errors->has('reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surgery.fields.reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.surgery.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $surgery->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surgery.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.surgery.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $surgery->type) }}" required>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surgery.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="doctor_name">{{ trans('cruds.surgery.fields.doctor_name') }}</label>
                <input class="form-control {{ $errors->has('doctor_name') ? 'is-invalid' : '' }}" type="text" name="doctor_name" id="doctor_name" value="{{ old('doctor_name', $surgery->doctor_name) }}" required>
                @if($errors->has('doctor_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surgery.fields.doctor_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.surgery.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $surgery->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surgery.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.surgery.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $surgery->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surgery.fields.patient_helper') }}</span>
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