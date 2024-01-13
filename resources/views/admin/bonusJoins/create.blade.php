@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bonusJoin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bonus-joins.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="first_upline_bonus">{{ trans('cruds.bonusJoin.fields.first_upline_bonus') }}</label>
                <input class="form-control {{ $errors->has('first_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="first_upline_bonus" id="first_upline_bonus" value="{{ old('first_upline_bonus', '') }}" step="0.01" required>
                @if($errors->has('first_upline_bonus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_upline_bonus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusJoin.fields.first_upline_bonus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="second_upline_bonus">{{ trans('cruds.bonusJoin.fields.second_upline_bonus') }}</label>
                <input class="form-control {{ $errors->has('second_upline_bonus') ? 'is-invalid' : '' }}" type="number" name="second_upline_bonus" id="second_upline_bonus" value="{{ old('second_upline_bonus', '') }}" step="0.01" required>
                @if($errors->has('second_upline_bonus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('second_upline_bonus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusJoin.fields.second_upline_bonus_helper') }}</span>
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