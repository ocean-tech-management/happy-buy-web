@extends('layouts.admin')
@section('content')
@can('transaction_point_purchase_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-point-purchases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionPointPurchase.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionPointPurchase.fields.newPurchase') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionPointPurchase">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.point_package') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.point') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.receipt') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.payment_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.admin') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.gateway_response') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.gateway_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.gateway_transaction') }}
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
@can('transaction_point_purchase_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-point-purchases.massDestroy') }}",
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
    ajax: "{{ route('admin.transaction-point-purchases.new') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'transaction', name: 'transaction' },
{ data: 'user_name', name: 'user.name' },
{ data: 'point_package_name_en', name: 'point_package.name_en' },
{ data: 'point', name: 'point' },
{ data: 'price', name: 'price' },
{ data: 'payment_method_name', name: 'payment_method.name' },
{ data: 'status', name: 'status' },
{ data: 'receipt', name: 'receipt', sortable: false, searchable: false },
{ data: 'payment_verified_at', name: 'payment_verified_at' },
{ data: 'admin_name', name: 'admin.name' },
{ data: 'gateway_response', name: 'gateway_response' },
{ data: 'gateway_status', name: 'gateway_status' },
{ data: 'gateway_transaction', name: 'gateway_transaction' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionPointPurchase').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection