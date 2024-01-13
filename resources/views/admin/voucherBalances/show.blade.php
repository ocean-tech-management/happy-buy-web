@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.voucherBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.voucher-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $voucherBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $voucherBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $voucherBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\VoucherBalance::STATUS_SELECT[$voucherBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\VoucherBalance::SETTLEMENT_SELECT[$voucherBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherBalance.fields.remark') }}
                        </th>
                        <td>
                            {{ $voucherBalance->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.voucher-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
