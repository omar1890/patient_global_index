@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surgery.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surgeries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.id') }}
                        </th>
                        <td>
                            {{ $surgery->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.reason') }}
                        </th>
                        <td>
                            {{ $surgery->reason }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.description') }}
                        </th>
                        <td>
                            {{ $surgery->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.type') }}
                        </th>
                        <td>
                            {{ $surgery->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.doctor_name') }}
                        </th>
                        <td>
                            {{ $surgery->doctor_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.date') }}
                        </th>
                        <td>
                            {{ $surgery->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surgery.fields.patient') }}
                        </th>
                        <td>
                            {{ $surgery->patient->smoking ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.surgeries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection