@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ranking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rankings.update", [$ranking->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.ranking.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', $ranking->name_en) }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ranking.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_zh">{{ trans('cruds.ranking.fields.name_zh') }}</label>
                <input class="form-control {{ $errors->has('name_zh') ? 'is-invalid' : '' }}" type="text" name="name_zh" id="name_zh" value="{{ old('name_zh', $ranking->name_zh) }}">
                @if($errors->has('name_zh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_zh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ranking.fields.name_zh_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="point">{{ trans('cruds.ranking.fields.point') }}</label>
                <input class="form-control {{ $errors->has('point') ? 'is-invalid' : '' }}" type="text" name="point" id="point" value="{{ old('point', $ranking->point) }}" required>
                @if($errors->has('point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ranking.fields.point_helper') }}</span>
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