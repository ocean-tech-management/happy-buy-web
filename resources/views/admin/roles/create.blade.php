@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.role.fields.guard_name') }}</label>
                <select class="form-control {{ $errors->has('guard_name') ? 'is-invalid' : '' }}" name="guard_name" id="guard_name" required>
                    <option value disabled {{ old('guard_name', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Role::GUARD_NAME_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('guard_name', $role->guard_name) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('guard_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guard_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.guard_name_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $id => $permission)
                        <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission }}</option>
                    @endforeach
                </select> --}}

                <div class="form-group">
                    <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                    <div class="my-3">
                        <input type="checkbox" name="select_all d-inline" id="select_all">
                        <label for="select_all" class="d-inline noselect">{{ trans('permissions.select_all') }} / {{ trans('permissions.deselect_all') }}</label>
                        <br><br>
                    </div>
    
                    <div class="row">
                        @foreach($permission_group as $key => $value)
    
                            @if($value->childs->count() > 0)
                                    <div class="col-lg-12" style="border-bottom: 1px solid rgba(128, 128, 128, 0.322); margin-bottom: 20px;">
                                        <div>
                                            <label for="{{ $value->name }}_title"><h4 class="d-inline noselect" >
                                                {{ trans("permissions.$value->name") }}
                                            </h4></label>
                                        </div>
    
                                        <div class="row">
                                        @foreach($value->childs as $id => $group)
    
                                            @if($group->permissions->where('guard_name', $role->guard_name)->count() > 0)
    
                                                <div class="col-lg-4" style="margin-bottom:30px;">
                                                    <div>
                                                        <input type="checkbox" id="{{ $group->name }}_title" onclick="selectAndDeselect('{{ $group->id }}', '{{ $group->name }}')">
                                                        <label for="{{ $group->name }}_title"><h6 class="d-inline noselect">
                                                            {{ trans("permissions.$group->name") }}
                                                        </h6></label>
                                                    </div>
    
                                                    <div class="ml-3 permissions_option noselect" style="margin-left:2%">
                                                        @foreach($group->permissions->where('guard_name', $role->guard_name) as $id => $permission)
                                                            <label style="font-weight:100;">
                                                                <input type="checkbox" name="permissions[]" class="permissions_{{ $group->id }}" value="{{ $permission->id }}"
                                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} > 
                                                                    {{ trans("permissions.$permission->name") }}
                                                            </label> <br>
                                                        @endforeach
                                                    </div>
                                                </div>
    
                                            @endif
    
                                        @endforeach
                                        </div>
    
                                    </div>
                            @endif
                        @endforeach
                    </div>
                @if($errors->has('permissions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    function selectAndDeselect($id, $groupName) {
        if($("#"+$groupName+"_title").prop("checked") == true) {
            $(".permissions_"+$id+"").prop('checked', true);
            console.log(true);
        } else {
            $(".permissions_"+$id+"").prop('checked', false);
            console.log(false);
        }
    }

    $('#select_all').click(function() {
        if($(this).prop("checked") == true) {
            $("[type=checkbox]").prop('checked', true);
        }else {
            $("[type=checkbox]").prop('checked', false);
        }
    });
</script>
@endsection
