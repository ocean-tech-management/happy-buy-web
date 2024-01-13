@extends('layouts.admin')
@section('content')
@can('transaction_shipping_purchase_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-shipping-purchases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionShippingPurchase.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionShippingPurchase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="transaction"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionShippingPurchase.fields.transaction')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionShippingPurchase.fields.user')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="shipping_package"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionShippingPurchase.fields.shipping_package')])}}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionShippingPurchase">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.shipping_package') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.point') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionShippingPurchase.fields.status') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionShippingPurchase.fields.receipt') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionShippingPurchase.fields.payment_verified_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionShippingPurchase.fields.admin') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionShippingPurchase.fields.gateway_response') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionShippingPurchase.fields.gateway_status') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionShippingPurchase.fields.gateway_transaction') }}--}}
{{--                    </th>--}}
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
@can('transaction_shipping_purchase_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-shipping-purchases.massDestroy') }}",
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
    // searching:false;
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {url: 
        @if(Route::is('admin.transaction-shipping-purchases.index')) "{{ route('admin.transaction-shipping-purchases.index') }}"
        @elseif(Route::is('admin.transaction-shipping-purchases.new')) "{{ route('admin.transaction-shipping-purchases.new') }}"
        @elseif(Route::is('admin.transaction-shipping-purchases.verified')) "{{ route('admin.transaction-shipping-purchases.verified') }}"
        @elseif(Route::is('admin.transaction-shipping-purchases.failed')) "{{ route('admin.transaction-shipping-purchases.failed') }}"
        @endif,

        data: function (d) {
            d.transaction = $('#transaction').val();
            d.user = $('#user').val();
            d.shipping_package = $('shipping_package').val();
        },
    },
    columns: [
        // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id', visible: false},
        { data: 'transaction', name: 'transaction' },
        { data: 'user_name', name: 'user.name' },
        { data: 'shipping_package_price', name: 'shipping_package.price' },
        { data: 'point', name: 'point' },
        { data: 'price', name: 'price' },
        { data: 'payment_method_name', name: 'payment_method.name' },
        { data: 'status', name: 'status' },
        // { data: 'receipt', name: 'receipt', sortable: false, searchable: false },
        // { data: 'payment_verified_at', name: 'payment_verified_at' },
        // { data: 'admin_name', name: 'admin.name' },
        // { data: 'gateway_response', name: 'gateway_response' },
        // { data: 'gateway_status', name: 'gateway_status' },
        // { data: 'gateway_transaction', name: 'gateway_transaction' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionShippingPurchase').DataTable(dtOverrideGlobals);
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
        $('#transaction').val(null);
        $('#user').val(null);
        $('#shipping_package').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
