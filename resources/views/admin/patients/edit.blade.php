@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            @if(\Auth::user()->isPatient())
                {{ 'Continue your profile' }}
            @else
                {{ trans('global.edit') }} {{ trans('cruds.patient.title_singular') }}
            @endif
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.patients.update", [$patient->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="weight">{{ trans('cruds.patient.fields.weight') }}</label>
                    <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number"
                           name="weight" id="weight" value="{{ old('weight', $patient->weight) }}" step="0.01">
                    @if($errors->has('weight'))
                        <div class="invalid-feedback">
                            {{ $errors->first('weight') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patient.fields.weight_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="height">{{ trans('cruds.patient.fields.height') }}</label>
                    <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number"
                           name="height" id="height" value="{{ old('height', $patient->height) }}" step="0.01">
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
                        <input class="form-check-input" type="checkbox" name="smoking" id="smoking"
                               value="1" {{ $patient->smoking || old('smoking', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label"
                               for="smoking">{{ trans('cruds.patient.fields.smoking') }}</label>
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
                    <select class="form-control {{ $errors->has('blood_type') ? 'is-invalid' : '' }}" name="blood_type"
                            id="blood_type">
                        <option value
                                disabled {{ old('blood_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Patient::BLOOD_TYPE_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('blood_type', $patient->blood_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                    <input class="form-control {{ $errors->has('avg_blood_pressure') ? 'is-invalid' : '' }}" type="text"
                           name="avg_blood_pressure" id="avg_blood_pressure"
                           value="{{ old('avg_blood_pressure', $patient->avg_blood_pressure) }}">
                    @if($errors->has('avg_blood_pressure'))
                        <div class="invalid-feedback">
                            {{ $errors->first('avg_blood_pressure') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patient.fields.avg_blood_pressure_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.patient.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $patient->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patient.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="identity_number">{{ trans('cruds.patient.fields.identity_number') }}</label>
                    <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text"
                           name="identity_number" id="identity_number"
                           value="{{ old('identity_number', $patient->identity_number) }}">
                    @if($errors->has('identity_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identity_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patient.fields.identity_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="documents">{{ trans('cruds.patient.fields.documents') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}"
                         id="documents-dropzone">
                    </div>
                    @if($errors->has('documents'))
                        <div class="invalid-feedback">
                            {{ $errors->first('documents') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patient.fields.documents_helper') }}</span>
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

@section('scripts')
    <script>
        var uploadedDocumentsMap = {}
        Dropzone.options.documentsDropzone = {
            url: '{{ route('admin.patients.storeMedia') }}',
            maxFilesize: 1000, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 1000
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="documents[]" value="' + response.name + '">')
                uploadedDocumentsMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentsMap[file.name]
                }
                $('form').find('input[name="documents[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($patient) && $patient->documents)
                var files =
                    {!! json_encode($patient->documents) !!}
                    for(
                var i
            in
                files
            )
                {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="documents[]" value="' + file.file_name + '">')
                }
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
