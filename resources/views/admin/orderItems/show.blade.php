@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.order-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.id') }}
                        </th>
                        <td>
                            {{ $orderItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.order') }}
                        </th>
                        <td>
                            {{ $orderItem->order->order_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_name_en') }}
                        </th>
                        <td>
                            {{ $orderItem->product_name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_name_zh') }}
                        </th>
                        <td>
                            {{ $orderItem->product_name_zh }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_desc_en') }}
                        </th>
                        <td>
                            {{ $orderItem->product_desc_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_desc_zh') }}
                        </th>
                        <td>
                            {{ $orderItem->product_desc_zh }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_quantity') }}
                        </th>
                        <td>
                            {{ $orderItem->product_quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_color') }}
                        </th>
                        <td>
                            {{ $orderItem->product_color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_size') }}
                        </th>
                        <td>
                            {{ $orderItem->product_size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.product_sku') }}
                        </th>
                        <td>
                            {{ $orderItem->product_sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.sales_price') }}
                        </th>
                        <td>
                            {{ $orderItem->sales_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.merchant_president_price') }}
                        </th>
                        <td>
                            {{ $orderItem->merchant_president_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.agent_director_price') }}
                        </th>
                        <td>
                            {{ $orderItem->agent_director_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.agent_executive_price') }}
                        </th>
                        <td>
                            {{ $orderItem->agent_executive_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderItem.fields.price_add_on') }}
                        </th>
                        <td>
                            {{ $orderItem->price_add_on }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.order-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
