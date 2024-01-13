@extends('layouts.admin')
@section('content')
    @can('shipping_fee_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.shipping-fees.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.shippingFee.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.shippingFee.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ShippingFee">
                <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.shippingFee.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingFee.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingFee.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingFee.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingFee.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingFee.fields.add_on') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingFee.fields.status') }}
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
            @can('shipping_fee_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.shipping-fees.massDestroy') }}",
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
                ajax: "{{ route('admin.shipping-fees.index') }}",
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id', visible: false},
                    { data: 'name', name: 'name' },
                    { data: 'state', name: 'states.name', sortable: false },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'price', name: 'price' },
                    { data: 'add_on', name: 'add_on' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-ShippingFee').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
