@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.shippingPackage.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.shipping-packages.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingPackage.fields.id') }}
                        </th>
                        <td>
                            {{ $shippingPackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingPackage.fields.price') }}
                        </th>
                        <td>
                            {{ $shippingPackage->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingPackage.fields.point') }}
                        </th>
                        <td>
                            {{ $shippingPackage->point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingPackage.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ShippingPackage::STATUS_SELECT[$shippingPackage->status] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.shipping-packages.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
