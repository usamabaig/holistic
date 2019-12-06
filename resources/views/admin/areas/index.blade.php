@extends('layouts.admin')
@section('content')
@can('area_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.areas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.area.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.area.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Area">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.area.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.area.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.area.fields.lat') }}
                        </th>
                        <th>
                            {{ trans('cruds.area.fields.lng') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($areas as $key => $area)
                        <tr data-entry-id="{{ $area->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $area->id ?? '' }}
                            </td>
                            <td>
                                {{ $area->name ?? '' }}
                            </td>
                            <td>
                                {{ $area->lat ?? '' }}
                            </td>
                            <td>
                                {{ $area->lng ?? '' }}
                            </td>
                            <td>
                                @can('area_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.areas.show', $area->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('area_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.areas.edit', $area->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('area_delete')
                                    <form action="{{ route('admin.areas.destroy', $area->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('area_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.areas.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Area:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection