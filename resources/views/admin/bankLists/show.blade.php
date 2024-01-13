@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bankList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bank-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bankList.fields.id') }}
                        </th>
                        <td>
                            {{ $bankList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankList.fields.code') }}
                        </th>
                        <td>
                            {{ $bankList->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankList.fields.bank_name') }}
                        </th>
                        <td>
                            {{ $bankList->bank_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankList.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\BankList::STATUS_SELECT[$bankList->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bank-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection