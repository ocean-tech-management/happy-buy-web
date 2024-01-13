@extends('layouts.admin')
@section('content')
@can('material_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.materials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.material.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.material.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Material">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.material.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.language') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_title_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_title_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_title_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_title_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_4') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_title_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.file_5') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.publish_year') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.publish_month') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.material.fields.role') }}
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
@can('material_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.materials.massDestroy') }}",
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
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.materials.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'language_name', name: 'language.name' },
        { data: 'file_title_1', name: 'file_title_1' },
        { data: 'file_1', name: 'file_1', sortable: false, searchable: false },
        { data: 'file_title_2', name: 'file_title_2' },
        { data: 'file_2', name: 'file_2', sortable: false, searchable: false },
        { data: 'file_title_3', name: 'file_title_3' },
        { data: 'file_3', name: 'file_3', sortable: false, searchable: false },
        { data: 'file_title_4', name: 'file_title_4' },
        { data: 'file_4', name: 'file_4', sortable: false, searchable: false },
        { data: 'file_title_5', name: 'file_title_5' },
        { data: 'file_5', name: 'file_5', sortable: false, searchable: false },
        { data: 'publish_year', name: 'publish_year' },
        { data: 'publish_month', name: 'publish_month' },
        { data: 'status', name: 'status' },
        { data: 'role', name: 'roles.name', sortable: false },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Material').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection