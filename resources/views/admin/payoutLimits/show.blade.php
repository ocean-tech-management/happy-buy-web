@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.payoutLimit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.payout-limits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.payoutLimit.fields.id') }}
                        </th>
                        <td>
                            {{ $payoutLimit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payoutLimit.fields.role') }}
                        </th>
                        <td>
                            {{ $payoutLimit->role->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payoutLimit.fields.min_amount') }}
                        </th>
                        <td>
                            {{ $payoutLimit->min_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.payoutLimit.fields.max_amount') }}
                        </th>
                        <td>
                            {{ $payoutLimit->max_amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.payout-limits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
