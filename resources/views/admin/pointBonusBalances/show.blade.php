@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointBonusBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-bonus-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBonusBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $pointBonusBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBonusBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $pointBonusBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBonusBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $pointBonusBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBonusBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PointBonusBalance::STATUS_SELECT[$pointBonusBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBonusBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\PointBonusBalance::SETTLEMENT_SELECT[$pointBonusBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-bonus-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection