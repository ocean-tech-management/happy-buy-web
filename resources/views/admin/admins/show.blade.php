@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.admin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.id') }}
                        </th>
                        <td>
                            {{ $admin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.name') }}
                        </th>
                        <td>
                            {{ $admin->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.phone') }}
                        </th>
                        <td>
                            {{ $admin->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.email') }}
                        </th>
                        <td>
                            {{ $admin->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Admin::STATUS_SELECT[$admin->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.profile_photo') }}
                        </th>
                        <td>
                            @if($admin->profile_photo)
                                <a href="{{ $admin->profile_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $admin->profile_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $admin->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.roles') }}
                        </th>
                        <td>
                            @foreach($admin->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection