@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="card-title mb-3">{{ trans('cruds.productBatch.fields.batch_information') }} #{{ $productBatch->name }}</h4>
                            <h6 class="mb-0"><i class="fas fa-box fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\ProductBatch::STATUS_SELECT[$productBatch->status] ?? '' }}</h6>
                        </div>
                        <div class="ms-auto">
                            @can('product_batch_generate_qr')
                                <a class="btn btn-sm btn-success" target="_blank" href="{{ route('admin.product-batches.qr-pdf', ['id' => $productBatch->id]) }}">
                                    {{ trans('global.generate_batch_qr') }}
                                </a>
                            @endcan
                        </div>
                    </div>

                    <hr>
                    <div style="padding-left: 45px;">
                        <div class="row">
                            <div class="form-group col-6">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.remark') }}</h5>
                                <p class="text-muted">
                                    {{ $productBatch->remark }}
                                </p>
                            </div>
                            <div class="form-group col-6">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.quantity') }}</h5>
                                <p class="text-muted">
                                    {{ $productBatch->quantity }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.productBatch.fields.batch_was_created', ['value' => $productBatch->created_at, 'value2' => $productBatch->created_by->name]) }}</span>
                        </div>
                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            <i class="fas fa-check fa-2x text-success"></i>
                            &nbsp;
                            <span>{{ trans('cruds.productBatch.fields.batch_was_generated', ['value' => $productBatch->generated_at]) }}</span>
                        </div>

                    </div>
                    <div class="border-top d-flex align-items-center">
                        <div class="p-3">
                            @if($productBatch->status == 1)
                                <i class="fas fa-question fa-2x text-warning"></i>
                                &nbsp;
                                <span>{{ trans('cruds.productBatch.fields.batch_already_arrive') }}</span>
                            @elseif($productBatch->status == 2)
                                <i class="fas fa-check fa-2x text-success"></i>
                                &nbsp;
                                <span>{{ trans('cruds.productBatch.fields.batch_was_in_stock', ['value' => $productBatch->in_stock_at, 'value2' => $productBatch->various_in_stock_by ?? '']) }}</span>
                            @endif
                        </div>
                        <div class="ms-auto">
                            @can('product_batch_in_stock')
                                @if($productBatch->status == 1)
                                    <form action="{{ route('admin.product-batches.to-in-stock') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $productBatch->id }}">
                                        <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.batch_in_stock') }}">
                                    </form>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.productBatch.fields.product') }}</h4>
                    <h6 class="mb-3"><a href="{{ route('admin.products.edit', $productBatch->product->id) }}">{{ $productBatch->product->name ?? '' }}</a></h6>
                    <h6 class="mb-3"><a href="{{ route('admin.products.edit', $productBatch->product->id) }}">{{ $productBatch->product->name_zh ?? '' }}</a></h6>
                    @if($productBatch->product->image_1)
                        <a class="image-popup-vertical-fit" href="{{ $productBatch->product->image_1->getUrl() }}" style="display: inline-block">
                            <img class="img-fluid" src="{{ $productBatch->product->image_1->getUrl() }}" style="width: 50px;">
                        </a>
                    @endif
                    <hr/>
                    <h4 class="card-title mb-3">{{ trans('cruds.productBatch.fields.product_variant') }}</h4>
                    <h6 class="mb-1">{{ trans('global.color') }}: {{ $productBatch->product_variant->color->name ?? '' }}</h6>
                    <h6 class="mb-1">{{ trans('global.size') }}: {{ $productBatch->product_variant->size->name ?? '' }}</h6>
                    <h6 class="mb-1">{{ trans('global.sku') }}: {{ $productBatch->product_variant->sku ?? '' }}</h6>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ trans('cruds.productBatch.fields.product_list') }}</h4>
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductQuantity">
                        <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.productQuantity.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.productQuantity.fields.qr_code') }}
                            </th>

                            <th>
                                {{ trans('cruds.productQuantity.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.productQuantity.fields.order_item') }}
                            </th>
                            <th>
                                {{ trans('cruds.productQuantity.fields.sold_to_user') }}
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
        </div>
        <div class="col-1"></div>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtOverrideGlobals = {
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.product-quantities.index') }}",
                    data: {
                        batch_id: "{{ $productBatch->id }}",
                    },
                },
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id', visible:false},
                    { data: 'qr_code', name: 'qr_code' },
                    { data: 'status', name: 'status' },
                    { data: 'order_item_product_name_en', name: 'order_item.product_name_en' },
                    { data: 'sold_to_user_name', name: 'sold_to_user.name' },
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
