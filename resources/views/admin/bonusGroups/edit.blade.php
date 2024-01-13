@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bonusGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bonus-groups.update", [$bonusGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="point">{{ trans('cruds.bonusGroup.fields.point') }}</label>
                <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="text" name="point" id="point" value="{{ old('point', $bonusGroup->point) }}" required>
                @if($errors->has('point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusGroup.fields.point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="percent">{{ trans('cruds.bonusGroup.fields.percent') }}</label>
                <input class="form-control {{ $errors->has('percent') ? 'is-invalid' : '' }}" type="text" name="percent" id="percent" value="{{ old('percent', $bonusGroup->percent) }}" required>
                @if($errors->has('percent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('percent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusGroup.fields.percent_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="after_point">{{ trans('cruds.bonusGroup.fields.after_point') }}</label>
                <input class="form-control {{ $errors->has('after_point') ? 'is-invalid' : '' }}" type="text" name="after_point" id="after_point" value="{{ old('after_point', $bonusGroup->after_point) }}" required>
                @if($errors->has('after_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('after_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusGroup.fields.after_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="after_percent">{{ trans('cruds.bonusGroup.fields.after_percent') }}</label>
                <input class="form-control {{ $errors->has('after_percent') ? 'is-invalid' : '' }}" type="text" name="after_percent" id="after_percent" value="{{ old('after_percent', $bonusGroup->after_percent) }}" required>
                @if($errors->has('after_percent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('after_percent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusGroup.fields.after_percent_helper') }}</span>
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