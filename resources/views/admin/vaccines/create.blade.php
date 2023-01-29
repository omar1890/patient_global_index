@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vaccine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vaccines.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.vaccine.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaccine.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.vaccine.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaccine.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.vaccine.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaccine.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="times_vaccinated">{{ trans('cruds.vaccine.fields.times_vaccinated') }}</label>
                <input class="form-control {{ $errors->has('times_vaccinated') ? 'is-invalid' : '' }}" type="text" name="times_vaccinated" id="times_vaccinated" value="{{ old('times_vaccinated', '') }}" required>
                @if($errors->has('times_vaccinated'))
                    <div class="invalid-feedback">
                        {{ $errors->first('times_vaccinated') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaccine.fields.times_vaccinated_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_annual') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_annual" value="0">
                    <input class="form-check-input" type="checkbox" name="is_annual" id="is_annual" value="1" {{ old('is_annual', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_annual">{{ trans('cruds.vaccine.fields.is_annual') }}</label>
                </div>
                @if($errors->has('is_annual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_annual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vaccine.fields.is_annual_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.vaccine.fields.patient') }}</label>
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
                <span class="help-block">{{ trans('cruds.vaccine.fields.patient_helper') }}</span>
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