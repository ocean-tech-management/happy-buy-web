@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointManagerBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-manager-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointManagerBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $pointManagerBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointManagerBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $pointManagerBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointManagerBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $pointManagerBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointManagerBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PointManagerBalance::STATUS_SELECT[$pointManagerBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointManagerBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\PointManagerBalance::SETTLEMENT_SELECT[$pointManagerBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointManagerBalance.fields.remark') }}
                        </th>
                        <td>
                            {{ $pointManagerBalance->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-manager-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection