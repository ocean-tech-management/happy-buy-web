@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.voucherLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.voucher-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherLog.fields.id') }}
                        </th>
                        <td>
                            {{ $voucherLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherLog.fields.user') }}
                        </th>
                        <td>
                            {{ $voucherLog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherLog.fields.amount') }}
                        </th>
                        <td>
                            {{ $voucherLog->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucherLog.fields.remark') }}
                        </th>
                        <td>
                            {{ $voucherLog->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.voucher-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection