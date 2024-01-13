@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.userEntry.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.user-entries.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userEntry.fields.id') }}
                        </th>
                        <td>
                            {{ $userEntry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userEntry.fields.user') }}
                        </th>
                        <td>
                            {{ $userEntry->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userEntry.fields.user_type') }}
                        </th>
                        <td>
                            {{ App\Models\UserEntry::USER_TYPE_SELECT[$userEntry->user_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userEntry.fields.deposit') }}
                        </th>
                        <td>
                            {{ $userEntry->deposit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userEntry.fields.fee') }}
                        </th>
                        <td>
                            {{ $userEntry->fee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userEntry.fields.top_up') }}
                        </th>
                        <td>
                            {{ $userEntry->top_up }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.user-entries.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
