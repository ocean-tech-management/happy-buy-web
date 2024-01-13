@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.announcement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.announcements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.announcement.fields.id') }}
                        </th>
                        <td>
                            {{ $announcement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.announcement.fields.title') }}
                        </th>
                        <td>
                            {{ $announcement->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.announcement.fields.desc') }}
                        </th>
                        <td>
                            {!! $announcement->desc !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.announcement.fields.photo') }}
                        </th>
                        <td>
                            @if($announcement->photo)
                                <a href="{{ $announcement->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $announcement->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.announcement.fields.role') }}
                        </th>
                        <td>
                            @foreach($announcement->roles as $key => $role)
                                <span class="badge bg-info">{{ $role->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.announcement.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Announcement::STATUS_SELECT[$announcement->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.announcements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
