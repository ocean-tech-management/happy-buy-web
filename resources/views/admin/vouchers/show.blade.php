@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.voucher.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.vouchers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.id') }}
                        </th>
                        <td>
                            {{ $voucher->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.name') }}
                        </th>
                        <td>
                            {{ $voucher->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.code') }}
                        </th>
                        <td>
                            {{ $voucher->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.value') }}
                        </th>
                        <td>
                            {{ $voucher->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Voucher::TYPE_SELECT[$voucher->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.role') }}
                        </th>
                        <td>
                            @foreach($voucher->roles as $key => $role)
                                <span class="label label-info">{{ $role->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.product') }}
                        </th>
                        <td>
                            {{ $voucher->product->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.started_at') }}
                        </th>
                        <td>
                            {{ $voucher->started_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.voucher.fields.ended_at') }}
                        </th>
                        <td>
                            {{ $voucher->ended_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.vouchers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection