@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bonusGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bonus-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $bonusGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusGroup.fields.point') }}
                        </th>
                        <td>
                            {{ $bonusGroup->point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusGroup.fields.percent') }}
                        </th>
                        <td>
                            {{ $bonusGroup->percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusGroup.fields.after_point') }}
                        </th>
                        <td>
                            {{ $bonusGroup->after_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusGroup.fields.after_percent') }}
                        </th>
                        <td>
                            {{ $bonusGroup->after_percent }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bonus-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection