@extends('layouts.admin')
@section('content')
@can('point_package_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.point-packages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pointPackage.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pointPackage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PointPackage">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.pointPackage.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointPackage.fields.package_photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointPackage.fields.name_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointPackage.fields.name_zh') }}
                    </th>

                    <th>
                        {{ trans('cruds.pointPackage.fields.point') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointPackage.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointPackage.fields.role') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointPackage.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('point_package_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.point-packages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    // buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.point-packages.index') }}",
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id', visible:false },
        { data: 'package_photo', name: 'package_photo', sortable: false, searchable: false },
        { data: 'name_en', name: 'name_en' },
        { data: 'name_zh', name: 'name_zh' },
        { data: 'point', name: 'point' },
        { data: 'price', name: 'price' },
        { data: 'role', name: 'roles.name' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-PointPackage').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
