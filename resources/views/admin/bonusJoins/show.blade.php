@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bonusJoin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bonus-joins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusJoin.fields.id') }}
                        </th>
                        <td>
                            {{ $bonusJoin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusJoin.fields.first_upline_bonus') }}
                        </th>
                        <td>
                            {{ $bonusJoin->first_upline_bonus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonusJoin.fields.second_upline_bonus') }}
                        </th>
                        <td>
                            {{ $bonusJoin->second_upline_bonus }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.bonus-joins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection