@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userAgreement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.user-agreements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreement.fields.id') }}
                        </th>
                        <td>
                            {{ $userAgreement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreement.fields.agreement_content') }}
                        </th>
                        <td>
                            {!! $userAgreement->agreement_content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreement.fields.name') }}
                        </th>
                        <td>
                            {{ $userAgreement->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAgreement.fields.role') }}
                        </th>
                        <td>
                            {{ $userAgreement->role->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.user-agreements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection