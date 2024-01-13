@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shippingCompany.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.shipping-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingCompany.fields.id') }}
                        </th>
                        <td>
                            {{ $shippingCompany->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingCompany.fields.name') }}
                        </th>
                        <td>
                            {{ $shippingCompany->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingCompany.fields.api_name') }}
                        </th>
                        <td>
                            {{ $shippingCompany->api_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingCompany.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ShippingCompany::STATUS_SELECT[$shippingCompany->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.shipping-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection