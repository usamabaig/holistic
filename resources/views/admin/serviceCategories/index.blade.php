@extends('layouts.admin')
@section('content')
@can('service_category_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.service-categories.create") }}">
        Add Service
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.serviceCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ServiceCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.serviceCategory.fields.id') }}
                        </th>
                        <th>
                            Banner Image
                        </th>
                        <th>
                            Service Name
                        </th>
                        
                        <th>
                            Service Icon
                        </th>
                        <th>
                            Service Picture
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            Current Status
                        </th>
                        <th>
                            Change Status
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceCategories as $key => $serviceCategory)
                    <tr data-entry-id="{{ $serviceCategory->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $serviceCategory->id ?? '' }}
                        </td>

                        <td>
                            @if($serviceCategory->banner_image)
                                <a href="{{ $serviceCategory->banner_image->getUrl() }}" target="_blank">
                                    <img src="{{ $serviceCategory->banner_image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                            </td>
                        <td>
                            {{ $serviceCategory->name ?? '' }}
                        </td>
                        <td>
                            @if($serviceCategory->picture)
                            <a href="{{ $serviceCategory->picture->getUrl() }}" target="_blank">
                                <img src="{{ $serviceCategory->picture->getUrl('thumb') }}" width="50px" height="50px">
                            </a>
                            @endif
                        </td>

                        <td>
                            @if($serviceCategory->category_picture)
                                <a href="{{ $serviceCategory->category_picture->getUrl() }}" target="_blank">
                                    <img src="{{ $serviceCategory->category_picture->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>

                        <td>
                            @can('service_category_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.service-categories.show', $serviceCategory->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('service_category_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.service-categories.edit', $serviceCategory->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('service_category_delete')
                            <form action="{{ route('admin.service-categories.destroy', $serviceCategory->id) }}"
                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan

                        </td>

                        <td>
                            @if($serviceCategory->status == 0)
                            <b>Deactive</b>
                            @elseif($serviceCategory->status == 1)
                            <b>Active</b>
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('admin.service-categories-update', [$serviceCategory->id]) }}"
                                method="POST"
                                onsubmit="return confirm('Revert process will Enable/Disable Our Services. Continue?');">
                                @csrf
                                <input type="hidden" name="id" value="{{ $serviceCategory->id }}" />
                                <button type="submit" class="btn btn-sm btn-info action_btn">Revert</button>


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
@can('service_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.service-categories.massDestroy') }}",
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
  $('.datatable-ServiceCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
