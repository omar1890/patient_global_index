@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.allergy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.allergies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.allergy.fields.id') }}
                        </th>
                        <td>
                            {{ $allergy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allergy.fields.name') }}
                        </th>
                        <td>
                            {{ $allergy->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allergy.fields.description') }}
                        </th>
                        <td>
                            {{ $allergy->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allergy.fields.patient') }}
                        </th>
                        <td>
                            {{ $allergy->patient->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.allergies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection