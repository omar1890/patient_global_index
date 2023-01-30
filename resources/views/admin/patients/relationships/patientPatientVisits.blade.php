@can('patient_visit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patient-visits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patientVisit.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.patientVisit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientPatientVisits">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.hospital') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.identity_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.doctor_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.diagnosis') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.division') }}
                        </th>
                        <th>
                            {{ trans('cruds.patientVisit.fields.documents') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patientVisits as $key => $patientVisit)
                        <tr data-entry-id="{{ $patientVisit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $patientVisit->id ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->hospital->name ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->patient->identity_number ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->doctor_name ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->diagnosis ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->date ?? '' }}
                            </td>
                            <td>
                                {{ $patientVisit->division ?? '' }}
                            </td>
                            <td>
                                @foreach($patientVisit->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('patient_visit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.patient-visits.show', $patientVisit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('patient_visit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.patient-visits.edit', $patientVisit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('patient_visit_delete')
                                    <form action="{{ route('admin.patient-visits.destroy', $patientVisit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('patient_visit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patient-visits.massDestroy') }}",
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
  let table = $('.datatable-patientPatientVisits:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection