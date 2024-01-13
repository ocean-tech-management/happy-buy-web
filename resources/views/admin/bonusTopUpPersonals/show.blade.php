@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.bonusTopUpPersonal.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.bonus-top-up-personals.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpPersonal.fields.id') }}
                        </th>
                        <td>
                            {{ $bonusTopUpPersonal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpPersonal.fields.point_package') }}
                        </th>
                        <td>
                            {{ $bonusTopUpPersonal->point_package->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpPersonal.fields.first_upline_bonus') }}
                        </th>
                        <td>
                            {{ $bonusTopUpPersonal->first_upline_bonus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusTopUpPersonal.fields.second_upline_bonus') }}
                        </th>
                        <td>
                            {{ $bonusTopUpPersonal->second_upline_bonus }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.bonus-top-up-personals.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
