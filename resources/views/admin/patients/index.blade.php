@extends('layouts.admin')
@section('content')
@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.patient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Patient">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.height') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.smoking') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.blood_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.avg_blood_pressure') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.identity_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.documents') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Patient::BLOOD_TYPE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->email }}">{{ $item->email }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $key => $patient)
                        <tr data-entry-id="{{ $patient->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $patient->id ?? '' }}
                            </td>
                            <td>
                                {{ $patient->weight ?? '' }}
                            </td>
                            <td>
                                {{ $patient->height ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $patient->smoking ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $patient->smoking ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ App\Models\Patient::BLOOD_TYPE_SELECT[$patient->blood_type] ?? '' }}
                            </td>
                            <td>
                                {{ $patient->avg_blood_pressure ?? '' }}
                            </td>
                            <td>
                                {{ $patient->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->identity_number ?? '' }}
                            </td>
                            <td>
                                @foreach($patient->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('patient_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.patients.show', $patient->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('patient_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.patients.edit', $patient->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('patient_delete')
                                    <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patients.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Patient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection