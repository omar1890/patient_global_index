@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hospital.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.id') }}
                        </th>
                        <td>
                            {{ $hospital->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.admin') }}
                        </th>
                        <td>
                            {{ $hospital->admin->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.name') }}
                        </th>
                        <td>
                            {{ $hospital->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.address') }}
                        </th>
                        <td>
                            {{ $hospital->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.license') }}
                        </th>
                        <td>
                            @foreach($hospital->license as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection