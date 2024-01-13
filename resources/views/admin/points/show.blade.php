@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.point.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.id') }}
                        </th>
                        <td>
                            {{ $point->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.user') }}
                        </th>
                        <td>
                            {{ $point->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.point_balance') }}
                        </th>
                        <td>
                            {{ $point->point_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.point_manager_balance') }}
                        </th>
                        <td>
                            {{ $point->point_manager_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.point_executive_balance') }}
                        </th>
                        <td>
                            {{ $point->point_executive_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.point_bonus_balance') }}
                        </th>
                        <td>
                            {{ $point->point_bonus_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.voucher_balance') }}
                        </th>
                        <td>
                            {{ $point->voucher_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.shipping_balance') }}
                        </th>
                        <td>
                            {{ $point->shipping_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.cash_voucher_balance') }}
                        </th>
                        <td>
                            {{ $point->cash_voucher_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.pv_balance') }}
                        </th>
                        <td>
                            {{ $point->pv_balance }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection