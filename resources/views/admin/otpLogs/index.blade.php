@extends('layouts.admin')
@section('content')
{{--@can('otp_log_create')--}}
{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('admin.otp-logs.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.otpLog.title_singular') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.otpLog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OtpLog">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.otpLog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.content') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.api_response') }}
                    </th>
                    <th>
                        {{ trans('cruds.otpLog.fields.used_at') }}
                    </th>
{{--                    <th>--}}
{{--                        &nbsp;--}}
{{--                    </th>--}}
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
@can('otp_log_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.otp-logs.massDestroy') }}",
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
    ajax: "{{ route('admin.otp-logs.index') }}",
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' , visible: false},
        { data: 'user_name', name: 'user.name' },
        { data: 'phone', name: 'phone' },
        { data: 'code', name: 'code' },
        { data: 'content', name: 'content' },
        { data: 'status', name: 'status' },
        { data: 'api_response', name: 'api_response' },
        { data: 'used_at', name: 'used_at' },
        {{--{ data: 'actions', name: '{{ trans('global.actions') }}' }--}}
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-OtpLog').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
