@extends('layouts.admin')
@section('content')
@can('sub_service_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.sub-services.create") }}">
                Add Package
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Packages List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SubService">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.subService.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.subService.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.subService.fields.charges') }}
                        </th>
                        <th>
                            {{ trans('cruds.subService.fields.description') }}
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            {{ trans('cruds.subService.fields.picture') }}
                        </th>            
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subServices as $key => $subService)
                        <tr data-entry-id="{{ $subService->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $subService->id ?? '' }}
                            </td>
                            <td>
                                {{ $subService->name ?? '' }}
                            </td>
                            <td>
                                {{ $subService->charges ?? '' }}
                            </td>
                            <td>
                                {{ $subService->description ?? '' }}
                            </td>
                            <td>
                                @foreach($subService->services as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($subService->picture)
                                    @foreach($subService->picture as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('sub_service_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sub-services.show', $subService->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sub_service_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sub-services.edit', $subService->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sub_service_delete')
                                    <form action="{{ route('admin.sub-services.destroy', $subService->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sub_service_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sub-services.massDestroy') }}",
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
  $('.datatable-SubService:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection