@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ranking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.rankings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ranking.fields.id') }}
                        </th>
                        <td>
                            {{ $ranking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ranking.fields.name_en') }}
                        </th>
                        <td>
                            {{ $ranking->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ranking.fields.name_zh') }}
                        </th>
                        <td>
                            {{ $ranking->name_zh }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ranking.fields.point') }}
                        </th>
                        <td>
                            {{ $ranking->point }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.rankings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection