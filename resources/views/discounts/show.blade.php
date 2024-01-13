@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.discount.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.discounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.discount.fields.id') }}
                        </th>
                        <td>
                            {{ $discount->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.discount.fields.start_time') }}
                        </th>
                        <td>
                            {{ $discount->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.discount.fields.end_time') }}
                        </th>
                        <td>
                            {{ $discount->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.discount.fields.percent') }}
                        </th>
                        <td>
                            {{ $discount->percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.discount.fields.role') }}
                        </th>
                        <td>
                            @foreach($discount->roles as $key => $role)
                                <span class="label label-info">{{ $role->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.discount.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Discount::STATUS_SELECT[$discount->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.discounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection