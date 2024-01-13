@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cashVoucherBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.cash-voucher-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cashVoucherBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $cashVoucherBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashVoucherBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $cashVoucherBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashVoucherBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $cashVoucherBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashVoucherBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CashVoucherBalance::STATUS_SELECT[$cashVoucherBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashVoucherBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\CashVoucherBalance::SETTLEMENT_SELECT[$cashVoucherBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cashVoucherBalance.fields.remark') }}
                        </th>
                        <td>
                            {{ $cashVoucherBalance->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.cash-voucher-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection