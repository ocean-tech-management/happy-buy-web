@extends('layouts.admin')
@section('content')
{{-- @can('transaction_agent_top_up_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-agent-top-ups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionAgentTopUp.title_singular') }}
            </a>
        </div>
    </div>
@endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionAgentTopUp.fields.approvedTopUp') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionAgentTopUp">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.merchant') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.merchant_pre_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.merchant_post_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.user_pre_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.user_post_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.receipt_photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.approved_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.rejected_at') }}
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
@can('transaction_agent_top_up_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-agent-top-ups.massDestroy') }}",
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
    ajax: "{{ route('admin.transaction-agent-top-ups.approved') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'transaction', name: 'transaction' },
{ data: 'user_name', name: 'user.name' },
{ data: 'merchant_name', name: 'merchant.name' },
{ data: 'amount', name: 'amount' },
{ data: 'merchant_pre_balance', name: 'merchant_pre_balance' },
{ data: 'merchant_post_balance', name: 'merchant_post_balance' },
{ data: 'user_pre_balance', name: 'user_pre_balance' },
{ data: 'user_post_balance', name: 'user_post_balance' },
{ data: 'status', name: 'status' },
{ data: 'receipt_photo', name: 'receipt_photo', sortable: false, searchable: false },
{ data: 'approved_at', name: 'approved_at' },
{ data: 'rejected_at', name: 'rejected_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionAgentTopUp').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection