@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.patientVisit.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.patient-visits.store") }}" enctype="multipart/form-data">
                @csrf

                @if(\Auth::user()->isHospital())
                    <input type="hidden" name="hospital_id" value="{{ \Auth::user()->hospital->id }}">
                @else
                    <div class="form-group">
                        <label class="required"
                               for="hospital_id">{{ trans('cruds.patientVisit.fields.hospital') }}</label>
                        <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}"
                                name="hospital_id" id="hospital_id" required>
                            @foreach($hospitals as $id => $entry)
                                <option
                                    value="{{ $id }}" {{ old('hospital_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('hospital'))
                            <div class="invalid-feedback">
                                {{ $errors->first('hospital') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.patientVisit.fields.hospital_helper') }}</span>
                    </div>
                @endif
                <div class="form-group">
                    <label class="required" for="patient_id">{{ trans('cruds.patientVisit.fields.patient') }}</label>
                    <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}"
                            name="patient_id" id="patient_id" required>
                        @foreach($patients as $id => $entry)
                            <option
                                value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('patient'))
                        <div class="invalid-feedback">
                            {{ $errors->first('patient') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patientVisit.fields.patient_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="doctor_name">{{ trans('cruds.patientVisit.fields.doctor_name') }}</label>
                    <input class="form-control {{ $errors->has('doctor_name') ? 'is-invalid' : '' }}" type="text"
                           name="doctor_name" id="doctor_name" value="{{ old('doctor_name', '') }}" required>
                    @if($errors->has('doctor_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('doctor_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patientVisit.fields.doctor_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="diagnosis">{{ trans('cruds.patientVisit.fields.diagnosis') }}</label>
                    <textarea class="form-control {{ $errors->has('diagnosis') ? 'is-invalid' : '' }}" name="diagnosis"
                              id="diagnosis" required>{{ old('diagnosis') }}</textarea>
                    @if($errors->has('diagnosis'))
                        <div class="invalid-feedback">
                            {{ $errors->first('diagnosis') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patientVisit.fields.diagnosis_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.patientVisit.fields.date') }}</label>
                    <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text"
                           name="date" id="date" value="{{ old('date') }}" required>
                    @if($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patientVisit.fields.date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="division">{{ trans('cruds.patientVisit.fields.division') }}</label>
                    <input class="form-control {{ $errors->has('division') ? 'is-invalid' : '' }}" type="text"
                           name="division" id="division" value="{{ old('division', '') }}">
                    @if($errors->has('division'))
                        <div class="invalid-feedback">
                            {{ $errors->first('division') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patientVisit.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="documents">{{ trans('cruds.patientVisit.fields.documents') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}"
                         id="documents-dropzone">
                    </div>
                    @if($errors->has('documents'))
                        <div class="invalid-feedback">
                            {{ $errors->first('documents') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.patientVisit.fields.documents_helper') }}</span>
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
            url: '{{ route('admin.patient-visits.storeMedia') }}',
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
                @if(isset($patientVisit) && $patientVisit->documents)
                var files =
                    {!! json_encode($patientVisit->documents) !!}
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
