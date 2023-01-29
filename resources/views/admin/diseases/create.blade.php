@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.disease.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.diseases.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.disease.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.disease.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.disease.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.disease.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_chronic') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_chronic" value="0">
                    <input class="form-check-input" type="checkbox" name="is_chronic" id="is_chronic" value="1" {{ old('is_chronic', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_chronic">{{ trans('cruds.disease.fields.is_chronic') }}</label>
                </div>
                @if($errors->has('is_chronic'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_chronic') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.disease.fields.is_chronic_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_from_parents') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_from_parents" value="0">
                    <input class="form-check-input" type="checkbox" name="is_from_parents" id="is_from_parents" value="1" {{ old('is_from_parents', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_from_parents">{{ trans('cruds.disease.fields.is_from_parents') }}</label>
                </div>
                @if($errors->has('is_from_parents'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_from_parents') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.disease.fields.is_from_parents_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.disease.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.disease.fields.patient_helper') }}</span>
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