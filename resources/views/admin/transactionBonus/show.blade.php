@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transactionBonu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-bonus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.id') }}
                        </th>
                        <td>
                            {{ $transactionBonu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.transaction') }}
                        </th>
                        <td>
                            {{ $transactionBonu->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.admin') }}
                        </th>
                        <td>
                            {{ $transactionBonu->admin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.user') }}
                        </th>
                        <td>
                            {{ $transactionBonu->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.title') }}
                        </th>
                        <td>
                            {{ $transactionBonu->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.remark') }}
                        </th>
                        <td>
                            {{ $transactionBonu->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.amount') }}
                        </th>
                        <td>
                            {{ $transactionBonu->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TransactionBonu::TYPE_SELECT[$transactionBonu->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\TransactionBonu::STATUS_SELECT[$transactionBonu->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonu.fields.given_at') }}
                        </th>
                        <td>
                            {{ $transactionBonu->given_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-bonus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection