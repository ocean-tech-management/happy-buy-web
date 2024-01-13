@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bonusPersonal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bonus-personals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusPersonal.fields.id') }}
                        </th>
                        <td>
                            {{ $bonusPersonal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusPersonal.fields.point') }}
                        </th>
                        <td>
                            {{ $bonusPersonal->point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusPersonal.fields.percent') }}
                        </th>
                        <td>
                            {{ $bonusPersonal->percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusPersonal.fields.after_point') }}
                        </th>
                        <td>
                            {{ $bonusPersonal->after_point }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusPersonal.fields.after_percent') }}
                        </th>
                        <td>
                            {{ $bonusPersonal->after_percent }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bonus-personals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection