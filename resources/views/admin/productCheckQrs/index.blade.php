@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <form method="get" action="{{ route('admin.product-check-qrs.index') }}">
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="required" for="code">{{ trans('cruds.productCheckQr.fields.code') }}</label>
                                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                                <span class="help-block">{{ trans('cruds.productVariant.fields.agent_director_price_helper') }}</span>
                            </div>
                                <div class="form-group col-3">
                                    <label>&nbsp;</label>
                                    <br/>
                                    <button class="btn btn-primary" type="submit">
                                        {{ trans('global.search') }}
                                    </button>
                                </div>
                        </div>
                    </form>
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
                    @if($productQuantity)
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="card-title mb-3">{{ trans('cruds.productCheckQr.fields.code') }} #{{ $productQuantity->qr_code }}</h4>
                                <h6 class="mb-0"><i class="fas fa-box fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\ProductQuantity::STATUS_SELECT[$productQuantity->status] ?? '' }}</h6>
                            </div>

                            <div class="ms-auto">
                                @if($productQuantity->status == 1 || $productQuantity->status == 2)
                                    <form action="{{ route('admin.product-quantities.to-in-stock') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $productQuantity->id }}">
                                        <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.in_stock') }}">
                                    </form>
                                    <form action="{{ route('admin.product-quantities.to-damage') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $productQuantity->id }}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.damage') }}">
                                    </form>
                                @endif
                                <a class="btn btn-sm btn-success" target="_blank" href="{{ route('admin.product-quantities.qr-pdf', ['id' => $productQuantity->id]) }}">
                                    {{ trans('global.generate_qr') }}
                                </a>
                            </div>
                        </div>
                        <hr>
                        <h4 class="card-title mb-3">{{ trans('cruds.productCheckQr.fields.product_action') }} </h4>
                        @if($productQuantity->status == 1 || $productQuantity->status == 2)
                            <form action="{{ route('admin.product-quantities.to-in-stock') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $productQuantity->id }}">
                                <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.in_stock') }}">
                            </form>
                            <form action="{{ route('admin.product-quantities.to-damage') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $productQuantity->id }}">
                                <input type="text" name="remark" value="" placeholder="damage reason">
                                <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.damage') }}">
                            </form>

                            <form action="{{ route('admin.product-quantities.to-sample') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $productQuantity->id }}">
                                <input type="submit" class="btn btn-sm btn-secondary" value="{{ trans('global.sample') }}">
                            </form>

                            <form action="{{ route('admin.product-quantities.to-free') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $productQuantity->id }}">
                                <input type="submit" class="btn btn-sm btn-warning" value="{{ trans('global.free') }}">
                            </form>
                        @endif
                        @if($productQuantity->remark != null)
                            {{ trans('global.remark') }}: {{ $productQuantity->remark }}
                            <br/>
                        @endif
                        <a class="btn btn-sm btn-success" target="_blank" href="{{ route('admin.product-quantities.qr-pdf', ['id' => $productQuantity->id]) }}">
                            {{ trans('global.generate_qr') }}
                        </a>
                        <hr>
                        <h4 class="card-title mb-3">{{ trans('cruds.productCheckQr.fields.product_information') }} </h4>
                        <div class="row">
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.product.fields.product_name') }}</h5>
                                <p class="text-muted">
                                    <a href="{{ route('admin.products.edit', $productQuantity->product->id) }}">{{ $productQuantity->product->name_en }} <small>{{ $productQuantity->product->name_zh ?? ''}}</small></a>
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productVariant.fields.color') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->product_variant->color->name }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productVariant.fields.size') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->product_variant->size->name }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productVariant.fields.sku') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->product_variant->sku }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">In Stock At</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->in_stock_at ?? '-' }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">In Stock By</h5>
                                <p class="text-muted">
                                    @if($productQuantity->in_stock_by != null)
                                        {{ $productQuantity->in_stock_by->name }}
                                    @else
                                        '-'
                                    @endif
                                </p>
                            </div>
                        </div>
                        <hr>
                        <h4 class="card-title mb-3">{{ trans('cruds.productCheckQr.fields.batch_information') }} </h4>
                        <div class="row">
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.name') }}</h5>
                                <p class="text-muted">
                                    <a href="{{ route('admin.product-batches.show', $productQuantity->batch->id) }}">{{ $productQuantity->batch->name }}</a>
                                    &nbsp;
                                    <a class="btn btn-sm btn-success" target="_blank" href="{{ route('admin.product-batches.qr-pdf', ['id' => $productQuantity->batch->id]) }}" target="_blank"> {{ trans('global.generate_batch_qr') }}</i></a>
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.remark') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->batch->remark }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.quantity') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->batch->quantity }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.status') }}</h5>
                                <span class="text-muted">
                                    {{ App\Models\ProductBatch::STATUS_SELECT[$productQuantity->batch->status] ?? '' }}
                                    &nbsp;
                                    @can('product_batch_in_stock')
                                        @if($productQuantity->batch->status == 1)
                                            <form action="{{ route('admin.product-batches.to-in-stock') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{ $productQuantity->batch->id }}">
                                                <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.batch_in_stock') }}">
                                            </form>
                                        @endif
                                    @endcan
                                </span>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.created_at') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->batch->created_at }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.generated_at') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->batch->generated_at }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">{{ trans('cruds.productBatch.fields.in_stock_at') }}</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->batch->in_stock_at ?? '-' }}
                                </p>
                            </div>
                            <div class="form-group col-3">
                                <h5 class="text-truncate font-size-15">In Stock By</h5>
                                <p class="text-muted">
                                    {{ $productQuantity->batch->in_stock_by ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <h4 class="card-title mb-3">{{ trans('cruds.productCheckQr.fields.order_information') }} </h4>
                            <div class="ms-auto">
                                @if($productQuantity->order_item)
                                    <a class="btn btn-sm btn-primary" target="_blank" href="{{ route('admin.orders.show', $productQuantity->order_item->order->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    @if($productQuantity->order_item->order->status == 1)
                                        <form action="{{ route('admin.orders.release-product') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="product_quantity_id" value="{{ $productQuantity->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">{{ trans('global.release_from_order') }}</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>

                        @if($productQuantity->order_item)
                            <h6 class="mb-4"><i class="fas fa-shopping-bag fa-lg"></i>&nbsp;&nbsp;&nbsp;{{ App\Models\Order::STATUS_SELECT[$productQuantity->order_item->order->status] ?? '' }}</h6>
                            <div class="row">
                                <div class="form-group col-3">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.order.fields.order_number') }}</h5>
                                    <p class="text-muted">
                                        <a href="{{ route('admin.orders.show', $productQuantity->order_item->order->id) }}">{{ $productQuantity->order_item->order->order_number }}</a>
                                    </p>
                                </div>
                                <div class="form-group col-3">
                                    <h5 class="text-truncate font-size-15">{{ trans('cruds.productQuantity.fields.sold_to_user') }}</h5>
                                    <p class="text-muted">
                                        @if(str_contains($productQuantity->sold_to_user->roles[0]->name, 'Merchant'))
                                            <a href="{{ route('admin.users.merchants.show', $productQuantity->sold_to_user_id) }}">{{ $productQuantity->sold_to_user->name }}</a>
                                        @else
                                            <a href="{{ route('admin.users.agents.show', $productQuantity->sold_to_user_id) }}">{{ $productQuantity->sold_to_user->name }}</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @else
                            <div style="text-align: center">
                                {{ trans('cruds.productCheckQr.fields.order_not_found') }}
                            </div>
                        @endif
                    @else
                        <div style="text-align: center">
                            {{ trans('cruds.productCheckQr.fields.code_not_found') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

@endsection
