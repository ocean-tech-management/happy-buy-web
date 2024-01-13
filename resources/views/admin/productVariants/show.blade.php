@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productVariant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.product-variants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.id') }}
                        </th>
                        <td>
                            {{ $productVariant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.product') }}
                        </th>
                        <td>
                            {{ $productVariant->product->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.color') }}
                        </th>
                        <td>
                            {{ $productVariant->color->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.size') }}
                        </th>
                        <td>
                            {{ $productVariant->size->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.quantity') }}
                        </th>
                        <td>
                            {{ $productVariant->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.sku') }}
                        </th>
                        <td>
                            {{ $productVariant->sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.sales_price') }}
                        </th>
                        <td>
                            {{ $productVariant->sales_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.merchant_president_price') }}
                        </th>
                        <td>
                            {{ $productVariant->merchant_president_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.agent_director_price') }}
                        </th>
                        <td>
                            {{ $productVariant->agent_director_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.agent_executive_price') }}
                        </th>
                        <td>
                            {{ $productVariant->agent_executive_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariant.fields.price_add_on') }}
                        </th>
                        <td>
                            {{ $productVariant->price_add_on }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.product-variants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection