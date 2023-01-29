@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.patients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="weight">{{ trans('cruds.patient.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', '') }}" step="0.01">
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="height">{{ trans('cruds.patient.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', '') }}" step="0.01">
                @if($errors->has('height'))
                    <div class="invalid-feedback">
                        {{ $errors->first('height') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('smoking') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="smoking" value="0">
                    <input class="form-check-input" type="checkbox" name="smoking" id="smoking" value="1" {{ old('smoking', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="smoking">{{ trans('cruds.patient.fields.smoking') }}</label>
                </div>
                @if($errors->has('smoking'))
                    <div class="invalid-feedback">
                        {{ $errors->first('smoking') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.smoking_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.patient.fields.blood_type') }}</label>
                <select class="form-control {{ $errors->has('blood_type') ? 'is-invalid' : '' }}" name="blood_type" id="blood_type">
                    <option value disabled {{ old('blood_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Patient::BLOOD_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('blood_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('blood_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('blood_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.blood_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="avg_blood_pressure">{{ trans('cruds.patient.fields.avg_blood_pressure') }}</label>
                <input class="form-control {{ $errors->has('avg_blood_pressure') ? 'is-invalid' : '' }}" type="text" name="avg_blood_pressure" id="avg_blood_pressure" value="{{ old('avg_blood_pressure', '') }}">
                @if($errors->has('avg_blood_pressure'))
                    <div class="invalid-feedback">
                        {{ $errors->first('avg_blood_pressure') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.avg_blood_pressure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.patient.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identity_number">{{ trans('cruds.patient.fields.identity_number') }}</label>
                <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', '') }}">
                @if($errors->has('identity_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.identity_number_helper') }}</span>
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