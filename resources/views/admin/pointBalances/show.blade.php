@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $pointBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBalance.fields.user') }}
                        </th>
                        <td>
                            {{ $pointBalance->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBalance.fields.amount') }}
                        </th>
                        <td>
                            {{ $pointBalance->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBalance.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PointBalance::STATUS_SELECT[$pointBalance->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointBalance.fields.settlement') }}
                        </th>
                        <td>
                            {{ App\Models\PointBalance::SETTLEMENT_SELECT[$pointBalance->settlement] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection