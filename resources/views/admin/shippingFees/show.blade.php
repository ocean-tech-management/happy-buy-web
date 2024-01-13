@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shippingFee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.shipping-fees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingFee.fields.id') }}
                        </th>
                        <td>
                            {{ $shippingFee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingFee.fields.name') }}
                        </th>
                        <td>
                            {{ $shippingFee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingFee.fields.price') }}
                        </th>
                        <td>
                            {{ $shippingFee->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingFee.fields.state') }}
                        </th>
                        <td>
                            @foreach($shippingFee->states as $key => $state)
                                <span class="label label-info">{{ $state->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingFee.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ShippingFee::STATUS_SELECT[$shippingFee->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.shipping-fees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection