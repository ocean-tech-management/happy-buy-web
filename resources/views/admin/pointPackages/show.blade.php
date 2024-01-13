@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointPackage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.id') }}
                        </th>
                        <td>
                            {{ $pointPackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.name_en') }}
                        </th>
                        <td>
                            {{ $pointPackage->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.name_zh') }}
                        </th>
                        <td>
                            {{ $pointPackage->name_zh }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.package_photo') }}
                        </th>
                        <td>
                            @if($pointPackage->package_photo)
                                <a href="{{ $pointPackage->package_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $pointPackage->package_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.point') }}
                        </th>
                        <td>
                            {{ $pointPackage->point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.price') }}
                        </th>
                        <td>
                            {{ $pointPackage->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.role') }}
                        </th>
                        <td>
                            @foreach($pointPackage->roles as $key => $role)
                                <span class="label label-info">{{ $role->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointPackage.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PointPackage::STATUS_SELECT[$pointPackage->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.point-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
