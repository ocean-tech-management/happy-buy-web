@extends('layouts.admin')
@section('content')
@can('transaction_redeem_product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-redeem-products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionRedeemProduct.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        @if(Route::is("admin.transaction-redeem-products.index"))
            {{ trans('cruds.transactionRedeemProduct.fields.allOrder') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-redeem-products.new"))
            {{ trans('cruds.transactionRedeemProduct.fields.newOrder') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-redeem-products.shipped"))
            {{ trans('cruds.transactionRedeemProduct.fields.shippedOrder') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-redeem-products.completed"))
            {{ trans('cruds.transactionRedeemProduct.fields.completedOrder') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-redeem-products.cancel"))
            {{ trans('cruds.transactionRedeemProduct.fields.cancelledOrder') }} {{ trans('global.list') }}
        @endif
    </div>

    <div class="card-body">        
        <div class="row px-5 mb-1 d-flex mt-5">                        

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionRedeemProduct.fields.user')])}}">
            </div>                           
                
            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="collect_type">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.transactionRedeemProduct.fields.collect_type')])}}</option>
                    @foreach(App\Models\TransactionRedeemProduct::COLLECT_TYPE_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>                

            <div class="mb-lg-0 mb-4 input-div  col-lg-3" style="text-align:center; margin-left:auto;">
                <button type="button" id="search-btn" name="search" value="Search" 
                class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">
                    <i class="fa fa-search"></i> Search
                </button>

                <button type="reset" id="reset-btn" name="reset" value="Reset" class="btn btn-secondary btn-secondary--icon tw-rounded">
                    <i class="fa fa-times"></i> Reset
                </button>
            </div>
            
        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionRedeemProduct">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.variant') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.productVariant.fields.sku') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.purchase_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.purchase_quantity') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.pre_point_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.post_point_balance') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.collect_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.status') }}
                    </th>

{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.address') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.shipped_by') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.completed_by') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.refund_by') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.shipping_company') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.tracking_code') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.refund_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.pickup_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.shipout_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionRedeemProduct.fields.completed_at') }}--}}
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
@can('transaction_redeem_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-redeem-products.massDestroy') }}",
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
        @if(Route::is("admin.transaction-redeem-products.index")) "{{ route('admin.transaction-redeem-products.index') }}"
        @elseif(Route::is("admin.transaction-redeem-products.new")) "{{ route('admin.transaction-redeem-products.new') }}"
        @elseif(Route::is("admin.transaction-redeem-products.shipped")) "{{ route('admin.transaction-redeem-products.shipped') }}"
        @elseif(Route::is("admin.transaction-redeem-products.completed")) "{{ route('admin.transaction-redeem-products.completed') }}"
        @elseif(Route::is("admin.transaction-redeem-products.cancel")) "{{ route('admin.transaction-redeem-products.cancel') }}"
      @endif,
        
      data: function (d) {                
                d.user = $('#user').val();                                        
                d.collect_type = $('#collect_type').val();               
            },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id', visible:false },
{ data: 'transaction', name: 'transaction' },
{ data: 'product_name_en', name: 'product.name_en' },
{ data: 'variant_quantity', name: 'variant.quantity', sortable:false },
// { data: 'variant.sku', name: 'variant.sku' },
{ data: 'user_name', name: 'user.name' },
{ data: 'purchase_price', name: 'purchase_price', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
{ data: 'purchase_quantity', name: 'purchase_quantity', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
// { data: 'pre_point_balance', name: 'pre_point_balance' },
// { data: 'post_point_balance', name: 'post_point_balance' },
        { data: 'collect_type', name: 'collect_type' },
{ data: 'status', name: 'status' },

// { data: 'address_user', name: 'address.user' },
// { data: 'shipped_by_name', name: 'shipped_by.name' },
// { data: 'completed_by_name', name: 'completed_by.name' },
// { data: 'refund_by_name', name: 'refund_by.name' },
// { data: 'shipping_company_name', name: 'shipping_company.name' },
// { data: 'tracking_code', name: 'tracking_code' },
// { data: 'refund_at', name: 'refund_at' },
// { data: 'pickup_at', name: 'pickup_at' },
// { data: 'shipout_at', name: 'shipout_at' },
// { data: 'completed_at', name: 'completed_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionRedeemProduct').DataTable(dtOverrideGlobals);
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
      $('#collect_type').val(null);       
      table.ajax.reload()
  });


});

</script>
@endsection
