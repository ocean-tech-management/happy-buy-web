@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transactionBonusGiven.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-bonus-givens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.id') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.transaction') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.admin') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->admin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.user') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.title') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.remark') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.amount') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TransactionBonusGiven::TYPE_SELECT[$transactionBonusGiven->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\TransactionBonusGiven::STATUS_SELECT[$transactionBonusGiven->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionBonusGiven.fields.given_at') }}
                        </th>
                        <td>
                            {{ $transactionBonusGiven->given_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-bonus-givens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection