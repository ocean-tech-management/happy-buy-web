@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.material.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.id') }}
                        </th>
                        <td>
                            {{ $material->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.language') }}
                        </th>
                        <td>
                            {{ $material->language->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_title_1') }}
                        </th>
                        <td>
                            {{ $material->file_title_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_1') }}
                        </th>
                        <td>
                            @if($material->file_1)
                                <a href="{{ $material->file_1->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_title_2') }}
                        </th>
                        <td>
                            {{ $material->file_title_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_2') }}
                        </th>
                        <td>
                            @if($material->file_2)
                                <a href="{{ $material->file_2->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_title_3') }}
                        </th>
                        <td>
                            {{ $material->file_title_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_3') }}
                        </th>
                        <td>
                            @if($material->file_3)
                                <a href="{{ $material->file_3->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_title_4') }}
                        </th>
                        <td>
                            {{ $material->file_title_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_4') }}
                        </th>
                        <td>
                            @if($material->file_4)
                                <a href="{{ $material->file_4->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_title_5') }}
                        </th>
                        <td>
                            {{ $material->file_title_5 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.file_5') }}
                        </th>
                        <td>
                            @if($material->file_5)
                                <a href="{{ $material->file_5->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.publish_year') }}
                        </th>
                        <td>
                            {{ $material->publish_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.publish_month') }}
                        </th>
                        <td>
                            {{ $material->publish_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Material::STATUS_SELECT[$material->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.material.fields.role') }}
                        </th>
                        <td>
                            @foreach($material->roles as $key => $role)
                                <span class="badge bg-info">{{ $role->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection