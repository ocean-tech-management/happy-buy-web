@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.bonusTopUpGroup.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.bonus-top-up-groups.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $bonusTopUpGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpGroup.fields.point_package') }}
                        </th>
                        <td>
                            {{ $bonusTopUpGroup->point_package->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpGroup.fields.first_upline_bonus') }}
                        </th>
                        <td>
                            {{ $bonusTopUpGroup->first_upline_bonus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpGroup.fields.second_upline_bonus') }}
                        </th>
                        <td>
                            {{ $bonusTopUpGroup->second_upline_bonus }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.bonus-top-up-groups.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
