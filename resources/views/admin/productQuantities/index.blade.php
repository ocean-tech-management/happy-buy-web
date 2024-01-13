@extends('layouts.admin')
@section('content')
    @can('product_quantity_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.product-quantities.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.productQuantity.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.productQuantity.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductQuantity">
                <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.productQuantity.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.batch') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.product_variant') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.order_item') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.sold_to_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.qr_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.qr_generate_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.in_stock_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.sold_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.productQuantity.fields.first_scan_at') }}
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
            @can('product_quantity_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.product-quantities.massDestroy') }}",
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
                ajax: "{{ route('admin.product-quantities.index') }}",
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id', visible:false},
                    { data: 'batch_name', name: 'batch.name' },
                    { data: 'product_name_en', name: 'product.name_en' },
                    { data: 'product_variant_sku', name: 'product_variant.sku' },
                    { data: 'order_item_product_name_en', name: 'order_item.product_name_en' },
                    { data: 'status', name: 'status' },
                    { data: 'sold_to_user_name', name: 'sold_to_user.name' },
                    { data: 'qr_code', name: 'qr_code' },
                    { data: 'qr_generate_at', name: 'qr_generate_at' },
                    { data: 'in_stock_at', name: 'in_stock_at' },
                    { data: 'sold_at', name: 'sold_at' },
                    { data: 'first_scan_at', name: 'first_scan_at' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-ProductQuantity').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
