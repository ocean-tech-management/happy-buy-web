@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.state.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.states.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.state.fields.id') }}
                        </th>
                        <td>
                            {{ $state->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.state.fields.country') }}
                        </th>
                        <td>
                            {{ $state->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.state.fields.name') }}
                        </th>
                        <td>
                            {{ $state->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.state.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\State::STATUS_SELECT[$state->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.states.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection