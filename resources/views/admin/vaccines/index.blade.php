@extends('layouts.admin')
@section('content')
@can('vaccine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vaccines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vaccine.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vaccine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Vaccine">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.vaccine.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaccine.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaccine.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaccine.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaccine.fields.times_vaccinated') }}
                        </th>
                        <th>
                            {{ trans('cruds.vaccine.fields.is_annual') }}
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
                        </td>
                        <td>
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
                    @foreach($vaccines as $key => $vaccine)
                        <tr data-entry-id="{{ $vaccine->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vaccine->id ?? '' }}
                            </td>
                            <td>
                                {{ $vaccine->name ?? '' }}
                            </td>
                            <td>
                                {{ $vaccine->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $vaccine->end_date ?? '' }}
                            </td>
                            <td>
                                {{ $vaccine->times_vaccinated ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $vaccine->is_annual ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vaccine->is_annual ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('vaccine_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vaccines.show', $vaccine->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('vaccine_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.vaccines.edit', $vaccine->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('vaccine_delete')
                                    <form action="{{ route('admin.vaccines.destroy', $vaccine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vaccine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vaccines.massDestroy') }}",
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
  let table = $('.datatable-Vaccine:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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