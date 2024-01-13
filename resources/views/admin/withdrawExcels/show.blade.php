@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.withdrawExcel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.withdraw-excels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.withdrawExcel.fields.id') }}
                        </th>
                        <td>
                            {{ $withdrawExcel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdrawExcel.fields.name') }}
                        </th>
                        <td>
                            {{ $withdrawExcel->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdrawExcel.fields.admin') }}
                        </th>
                        <td>
                            {{ $withdrawExcel->admin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.withdrawExcel.fields.file') }}
                        </th>
                        <td>
                            @if($withdrawExcel->file)
                                <a href="{{ $withdrawExcel->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.withdraw-excels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection