@can('surgery_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.surgeries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.surgery.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.surgery.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-patientSurgeries">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.surgery.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.surgery.fields.reason') }}
                        </th>
                        <th>
                            {{ trans('cruds.surgery.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.surgery.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.surgery.fields.doctor_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.surgery.fields.date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surgeries as $key => $surgery)
                        <tr data-entry-id="{{ $surgery->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $surgery->id ?? '' }}
                            </td>
                            <td>
                                {{ $surgery->reason ?? '' }}
                            </td>
                            <td>
                                {{ $surgery->description ?? '' }}
                            </td>
                            <td>
                                {{ $surgery->type ?? '' }}
                            </td>
                            <td>
                                {{ $surgery->doctor_name ?? '' }}
                            </td>
                            <td>
                                {{ $surgery->date ?? '' }}
                            </td>
                            <td>
                                @can('surgery_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.surgeries.show', $surgery->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('surgery_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.surgeries.edit', $surgery->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('surgery_delete')
                                    <form action="{{ route('admin.surgeries.destroy', $surgery->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('surgery_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.surgeries.massDestroy') }}",
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
  let table = $('.datatable-patientSurgeries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection