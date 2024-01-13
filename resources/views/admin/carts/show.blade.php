@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cart.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.carts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.id') }}
                        </th>
                        <td>
                            {{ $cart->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.user') }}
                        </th>
                        <td>
                            {{ $cart->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.product') }}
                        </th>
                        <td>
                            {{ $cart->product->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.product_variant') }}
                        </th>
                        <td>
                            {{ $cart->product_variant->quantity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.quantity') }}
                        </th>
                        <td>
                            {{ $cart->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Cart::STATUS_SELECT[$cart->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cart.fields.address') }}
                        </th>
                        <td>
                            {{ $cart->address->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.carts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection