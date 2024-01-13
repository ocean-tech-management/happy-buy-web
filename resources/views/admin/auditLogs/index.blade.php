@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.auditLog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user_id"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.auditLog.fields.user_id')])}}">
            </div>
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="host"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.auditLog.fields.host')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" name="start_date" id="start_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{trans('global.enter_for', ['value'=>trans('global.start_date')])}}">
            </div>
            
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" name="end_date" id="end_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{trans('global.enter_for', ['value'=>trans('global.end_date')])}}">
            </div>


            <div class="mb-lg-0 mb-4 input-div col-lg-3" >
                <button type="button" id="search-btn" name="search" value="Search" class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">
                    <i class="fa fa-search"></i> {{trans('global.search')}}
                </button>

                <button type="reset" id="reset-btn" name="reset" value="Reset" class="btn btn-secondary btn-secondary--icon tw-rounded">
                    <i class="fa fa-times"></i> {{trans('global.reset')}}
                </button>
            </div>

        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AuditLog">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.subject_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.subject_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.user_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.host') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditLog.fields.created_at') }}
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
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.audit-logs.index') }}",
        data: function (d) {
            d.user_id = $('#user_id').val();
            d.host = $('#host').val();
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
        },
    },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'description', name: 'description' },
      { data: 'subject_id', name: 'subject_id' },
      { data: 'subject_type', name: 'subject_type' },
      { data: 'user_id', name: 'user_id' },
      { data: 'host', name: 'host' },
      { data: 'created_at', name: 'created_at' },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AuditLog').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      $("#search-btn").click();
    }
  });

  $("#search-btn").click(function(){
      table.ajax.reload();
  });

  $("#reset-btn").click(function(){
      $('#user_id').val(null);
      $('#host').val(null);
      $('#start_date').val(null);
      $('#end_date').val(null);
      table.ajax.reload()
  });
  
});

</script>
@endsection