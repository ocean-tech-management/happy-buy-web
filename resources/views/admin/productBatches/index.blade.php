@extends('layouts.admin')
@section('content')
    @can('product_batch_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.product-batches.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.productBatch.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.productBatch.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">
    
                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="batch_name"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.productBatch.fields.name')])}}">
                </div>
    
                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="product"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.productBatch.fields.product')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="product_variant"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.productBatch.fields.product_variant')])}}">
                </div>
    
                <div class="flex-grow-1 input-div col-lg-3">
                    <select class="form-control datatable-input" id="status">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.productBatch.fields.status')])}}</option>
                        @foreach(App\Models\ProductBatch::STATUS_SELECT as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>>
                        @endforeach
                    </select>
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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductBatch">
                <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.productBatch.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.product_variant') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.cost_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.generated_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBatch.fields.in_stock_at') }}
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
            @can('product_batch_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.product-batches.massDestroy') }}",
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
                    url:"{{ route('admin.product-batches.index') }}",
            
                    data: function(d){
                        d.batch_name = $('#batch_name').val();
                        d.product = $('#product').val();
                        d.product_variant = $('#product_variant').val();
                        d.status = $('#status').val();
                    }},
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id', visible: false },
                    { data: 'name', name: 'name' },
                    { data: 'product_name_en', name: 'product.name_en' },
                    { data: 'product_variant_sku', name: 'product_variant.sku' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'cost_price', name: 'cost_price' },
                    { data: 'status', name: 'status' },
                    { data: 'generated_at', name: 'generated_at' },
                    { data: 'in_stock_at', name: 'in_stock_at' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-ProductBatch').DataTable(dtOverrideGlobals);
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
                $('#batch_name').val(null);
                $('#product').val(null);
                $('#product_variant').val(null);
                $('#status').val(null);
                table.ajax.reload()
            });

        });

    </script>
@endsection
