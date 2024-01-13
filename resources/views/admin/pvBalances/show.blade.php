@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pvBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.pv-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pvBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $pvBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pvBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $pvBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pvBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $pvBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pvBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PvBalance::STATUS_SELECT[$pvBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pvBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\PvBalance::SETTLEMENT_SELECT[$pvBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pvBalance.fields.remark') }}
                        </th>
                        <td>
                            {{ $pvBalance->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.pv-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection