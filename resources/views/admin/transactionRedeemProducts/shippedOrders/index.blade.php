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
            {{ trans('cruds.transactionRedeemProduct.fields.shippedOrder') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionRedeemProduct">
                <thead>
                <tr>
                    <th width="10">

                    </th>
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
                        {{ trans('cruds.transactionRedeemProduct.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.purchase_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.purchase_quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.pre_point_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.post_point_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.collect_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.shipped_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.completed_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.refund_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.shipping_company') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.tracking_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.refund_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.pickup_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.shipout_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionRedeemProduct.fields.completed_at') }}
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
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.transaction-redeem-products.shipped') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'transaction', name: 'transaction' },
                    { data: 'product_code', name: 'product.code' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'purchase_price', name: 'purchase_price' },
                    { data: 'purchase_quantity', name: 'purchase_quantity' },
                    { data: 'pre_point_balance', name: 'pre_point_balance' },
                    { data: 'post_point_balance', name: 'post_point_balance' },
                    { data: 'status', name: 'status' },
                    { data: 'collect_type', name: 'collect_type' },
                    { data: 'address_user', name: 'address.user' },
                    { data: 'shipped_by_name', name: 'shipped_by.name' },
                    { data: 'completed_by_name', name: 'completed_by.name' },
                    { data: 'refund_by_name', name: 'refund_by.name' },
                    { data: 'shipping_company_name', name: 'shipping_company.name' },
                    { data: 'tracking_code', name: 'tracking_code' },
                    { data: 'refund_at', name: 'refund_at' },
                    { data: 'pickup_at', name: 'pickup_at' },
                    { data: 'shipout_at', name: 'shipout_at' },
                    { data: 'completed_at', name: 'completed_at' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-TransactionRedeemProduct').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
