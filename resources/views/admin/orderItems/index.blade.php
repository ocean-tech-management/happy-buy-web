@extends('layouts.admin')
@section('content')
@can('order_item_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.order-items.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.orderItem.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.orderItem.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OrderItem">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.order') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_name_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_name_zh') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_desc_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_desc_zh') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_color') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_size') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.product_sku') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.sales_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.merchant_president_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.agent_director_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.agent_executive_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderItem.fields.price_add_on') }}
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
@can('order_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.order-items.massDestroy') }}",
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
    ajax: "{{ route('admin.order-items.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'order_order_number', name: 'order.order_number' },
{ data: 'product_name_en', name: 'product_name_en' },
{ data: 'product_name_zh', name: 'product_name_zh' },
{ data: 'product_desc_en', name: 'product_desc_en' },
{ data: 'product_desc_zh', name: 'product_desc_zh' },
{ data: 'product_quantity', name: 'product_quantity' },
{ data: 'product_color', name: 'product_color' },
{ data: 'product_size', name: 'product_size' },
{ data: 'product_sku', name: 'product_sku' },
{ data: 'sales_price', name: 'sales_price' },
{ data: 'merchant_president_price', name: 'merchant_president_price' },
{ data: 'agent_director_price', name: 'agent_director_price' },
{ data: 'agent_executive_price', name: 'agent_executive_price' },
{ data: 'price_add_on', name: 'price_add_on' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-OrderItem').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
