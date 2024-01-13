@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointTransactionLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-transaction-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.id') }}
                        </th>
                        <td>
                            {{ $pointTransactionLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.user') }}
                        </th>
                        <td>
                            {{ $pointTransactionLog->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.date') }}
                        </th>
                        <td>
                            {{ $pointTransactionLog->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.top_up') }}
                        </th>
                        <td>
                            {{ $pointTransactionLog->top_up }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.redemption') }}
                        </th>
                        <td>
                            {{ $pointTransactionLog->redemption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.shipping') }}
                        </th>
                        <td>
                            {{ $pointTransactionLog->shipping }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-transaction-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection