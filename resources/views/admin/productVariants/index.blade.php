@extends('layouts.admin')
@section('content')
@can('product_variant_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-variants.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productVariant.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productVariant.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductVariant">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.color') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.size') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.sku') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.sales_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.merchant_president_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.agent_director_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.agent_executive_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariant.fields.price_add_on') }}
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
@can('product_variant_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-variants.massDestroy') }}",
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
    ajax: "{{ route('admin.product-variants.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'product_name_en', name: 'product.name_en' },
{ data: 'color_name', name: 'color.name' },
{ data: 'size_name', name: 'size.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'sku', name: 'sku' },
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
  let table = $('.datatable-ProductVariant').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection