@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productColor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.product-colors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productColor.fields.id') }}
                        </th>
                        <td>
                            {{ $productColor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productColor.fields.name') }}
                        </th>
                        <td>
                            {{ $productColor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productColor.fields.color') }}
                        </th>
                        <td>
                            {{ $productColor->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productColor.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ProductColor::STATUS_SELECT[$productColor->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.product-colors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection