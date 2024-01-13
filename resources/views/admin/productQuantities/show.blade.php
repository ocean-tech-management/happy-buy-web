@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productQuantity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.product-quantities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.id') }}
                        </th>
                        <td>
                            {{ $productQuantity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.product') }}
                        </th>
                        <td>
                            {{ $productQuantity->product->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.batch') }}
                        </th>
                        <td>
                            {{ $productQuantity->batch->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ProductQuantity::STATUS_SELECT[$productQuantity->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.transaction') }}
                        </th>
                        <td>
                            {{ $productQuantity->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.sold_to_user') }}
                        </th>
                        <td>
                            {{ $productQuantity->sold_to_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.qr_code') }}
                        </th>
                        <td>
                            {{ $productQuantity->qr_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.qr_generate_at') }}
                        </th>
                        <td>
                            {{ $productQuantity->qr_generate_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.in_stock_at') }}
                        </th>
                        <td>
                            {{ $productQuantity->in_stock_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.sold_at') }}
                        </th>
                        <td>
                            {{ $productQuantity->sold_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productQuantity.fields.first_scan_at') }}
                        </th>
                        <td>
                            {{ $productQuantity->first_scan_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.product-quantities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection