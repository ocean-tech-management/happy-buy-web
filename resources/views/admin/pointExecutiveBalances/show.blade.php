@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointExecutiveBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-executive-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointExecutiveBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $pointExecutiveBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointExecutiveBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $pointExecutiveBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointExecutiveBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $pointExecutiveBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointExecutiveBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PointExecutiveBalance::STATUS_SELECT[$pointExecutiveBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointExecutiveBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\PointExecutiveBalance::SETTLEMENT_SELECT[$pointExecutiveBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointExecutiveBalance.fields.remark') }}
                        </th>
                        <td>
                            {{ $pointExecutiveBalance->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-executive-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection