@extends('layouts.admin')
@section('content')
@can('sub_catagory_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.sub-catagories.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.subCatagory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.subCatagory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SubCatagory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.subCatagory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.subCatagory.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.subCatagory.fields.picture') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCatagories as $key => $subCatagory)
                        <tr data-entry-id="{{ $subCatagory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $subCatagory->id ?? '' }}
                            </td>
                            <td>
                                {{ $subCatagory->name ?? '' }}
                            </td>
                            <td>
                                @if($subCatagory->picture)
                                    @foreach($subCatagory->picture as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('sub_catagory_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sub-catagories.show', $subCatagory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sub_catagory_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sub-catagories.edit', $subCatagory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sub_catagory_delete')
                                    <form action="{{ route('admin.sub-catagories.destroy', $subCatagory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sub_catagory_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sub-catagories.massDestroy') }}",
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
  $('.datatable-SubCatagory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection