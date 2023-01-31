@can('patient_medicine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patient-medicines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patientMedicine.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.patientMedicine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-medicinePatientMedicines">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.medicine') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.dose') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientMedicine.fields.is_continuous') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patientMedicines as $key => $patientMedicine)
                        <tr data-entry-id="{{ $patientMedicine->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $patientMedicine->id ?? '' }}
                            </td>
                            <td>
                                {{ $patientMedicine->medicine->name ?? '' }}
                            </td>
                            <td>
                                @if($patientMedicine->medicine)
                                    {{ $patientMedicine->medicine::TYPE_SELECT[$patientMedicine->medicine->type] ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $patientMedicine->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $patientMedicine->dose ?? '' }}
                            </td>
                            <td>
                                {{ $patientMedicine->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $patientMedicine->end_date ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $patientMedicine->is_continuous ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $patientMedicine->is_continuous ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('patient_medicine_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.patient-medicines.show', $patientMedicine->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('patient_medicine_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.patient-medicines.edit', $patientMedicine->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('patient_medicine_delete')
                                    <form action="{{ route('admin.patient-medicines.destroy', $patientMedicine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('patient_medicine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patient-medicines.massDestroy') }}",
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
  let table = $('.datatable-medicinePatientMedicines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection