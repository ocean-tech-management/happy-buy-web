@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.depositBank.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.deposit-banks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.depositBank.fields.id') }}
                        </th>
                        <td>
                            {{ $depositBank->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.depositBank.fields.bank') }}
                        </th>
                        <td>
                            {{ $depositBank->bank->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.depositBank.fields.bank_account_name') }}
                        </th>
                        <td>
                            {{ $depositBank->bank_account_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.depositBank.fields.bank_account_number') }}
                        </th>
                        <td>
                            {{ $depositBank->bank_account_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.depositBank.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\DepositBank::STATUS_SELECT[$depositBank->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.deposit-banks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection