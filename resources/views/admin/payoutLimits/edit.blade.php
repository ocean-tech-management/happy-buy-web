@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.payoutLimit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payout-limits.update", [$payoutLimit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="role_id">{{ trans('cruds.payoutLimit.fields.role') }}</label>
                <select class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role_id" id="role_id" required>
                    @foreach($roles as $id => $entry)
                        @if($id == $payoutLimit->role->id)
                            <option value="{{ $id }}" {{ (old('role_id') ? old('role_id') : $payoutLimit->role->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payoutLimit.fields.role_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="min_amount">{{ trans('cruds.payoutLimit.fields.min_amount') }}</label>
                <input class="form-control {{ $errors->has('min_amount') ? 'is-invalid' : '' }}" type="number" name="min_amount" id="min_amount" value="{{ old('min_amount', $payoutLimit->min_amount) }}" step="0.01" required>
                @if($errors->has('min_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('min_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payoutLimit.fields.min_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="max_amount">{{ trans('cruds.payoutLimit.fields.max_amount') }}</label>
                <input class="form-control {{ $errors->has('max_amount') ? 'is-invalid' : '' }}" type="number" name="max_amount" id="max_amount" value="{{ old('max_amount', $payoutLimit->max_amount) }}" step="0.01" required>
                @if($errors->has('max_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('max_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payoutLimit.fields.max_amount_helper') }}</span>
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
