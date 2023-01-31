@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.disease.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diseases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.id') }}
                        </th>
                        <td>
                            {{ $disease->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.name') }}
                        </th>
                        <td>
                            {{ $disease->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.description') }}
                        </th>
                        <td>
                            {{ $disease->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.is_chronic') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $disease->is_chronic ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.is_from_parents') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $disease->is_from_parents ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.patient') }}
                        </th>
                        <td>
                            {{ $disease->patient->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diseases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection