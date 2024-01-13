@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pickUpLocation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.pick-up-locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pickUpLocation.fields.id') }}
                        </th>
                        <td>
                            {{ $pickUpLocation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pickUpLocation.fields.name') }}
                        </th>
                        <td>
                            {{ $pickUpLocation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pickUpLocation.fields.address') }}
                        </th>
                        <td>
                            {{ $pickUpLocation->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pickUpLocation.fields.country') }}
                        </th>
                        <td>
                            {{ $pickUpLocation->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pickUpLocation.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PickUpLocation::STATUS_SELECT[$pickUpLocation->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.pick-up-locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection