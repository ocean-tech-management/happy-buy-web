@extends('layouts.admin')
@section('content')
@can('user_agreement_log_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-agreement-logs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userAgreementLog.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userAgreementLog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user" placeholder="{{trans('global.enter_for', ['value'=>trans('cruds.userAgreementLog.fields.user')])}}">
            </div>
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="signature_name" placeholder="{{trans('global.enter_for', ['value'=>trans('cruds.userAgreementLog.fields.signature_name')])}}">
            </div>
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="signature_ic" placeholder="{{trans('global.enter_for', ['value'=>trans('cruds.userAgreementLog.fields.signature_ic')])}}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserAgreementLog">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.user_agreement') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.signature_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.signature_ic') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.signature_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAgreementLog.fields.remark') }}
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
@can('user_agreement_log_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-agreement-logs.massDestroy') }}",
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
    ajax: {
            url: "{{ route('admin.user-agreement-logs.index') }}",
            data: function (d) {
                d.user = $('#user').val();
                d.signature_name =$('#signature_name').val();
                d.signature_ic = $('#signature_ic').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
        },
    columns: [
        // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id', visible: false },
        { data: 'user_agreement_name', name: 'user_agreement.name' },
        { data: 'user_name', name: 'user.name' },
        { data: 'signature_name', name: 'signature_name' },
        { data: 'signature_ic', name: 'signature_ic' },
        { data: 'signature_at', name: 'signature_at' },
        { data: 'remark', name: 'remark' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-UserAgreementLog').DataTable(dtOverrideGlobals);
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
      $('#user').val(null);
      $('#signature_name').val(null);
      $('#signature_ic').val(null);
      $('#start_date').val(null);
      $('#end_date').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
