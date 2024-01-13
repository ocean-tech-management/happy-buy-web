@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transactionIdLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-id-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.id') }}
                        </th>
                        <td>
                            {{ $transactionIdLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TransactionIdLog::TYPE_SELECT[$transactionIdLog->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.name') }}
                        </th>
                        <td>
                            {{ $transactionIdLog->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.user') }}
                        </th>
                        <td>
                            {{ $transactionIdLog->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.transaction-id-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection