@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.point.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.points.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.point.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="point_balance">{{ trans('cruds.point.fields.point_balance') }}</label>
                    <input class="form-control {{ $errors->has('point_balance') ? 'is-invalid' : '' }}" type="text" name="point_balance" id="point_balance" value="{{ old('point_balance', '') }}">
                    @if($errors->has('point_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.point_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="point_manager_balance">{{ trans('cruds.point.fields.point_manager_balance') }}</label>
                    <input class="form-control {{ $errors->has('point_manager_balance') ? 'is-invalid' : '' }}" type="text" name="point_manager_balance" id="point_manager_balance" value="{{ old('point_manager_balance', '') }}">
                    @if($errors->has('point_manager_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point_manager_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.point_manager_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="point_executive_balance">{{ trans('cruds.point.fields.point_executive_balance') }}</label>
                    <input class="form-control {{ $errors->has('point_executive_balance') ? 'is-invalid' : '' }}" type="text" name="point_executive_balance" id="point_executive_balance" value="{{ old('point_executive_balance', '') }}">
                    @if($errors->has('point_executive_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point_executive_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.point_executive_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="point_bonus_balance">{{ trans('cruds.point.fields.point_bonus_balance') }}</label>
                    <input class="form-control {{ $errors->has('point_bonus_balance') ? 'is-invalid' : '' }}" type="text" name="point_bonus_balance" id="point_bonus_balance" value="{{ old('point_bonus_balance', '') }}">
                    @if($errors->has('point_bonus_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point_bonus_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.point_bonus_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="voucher_balance">{{ trans('cruds.point.fields.voucher_balance') }}</label>
                    <input class="form-control {{ $errors->has('voucher_balance') ? 'is-invalid' : '' }}" type="text" name="voucher_balance" id="voucher_balance" value="{{ old('voucher_balance', '') }}">
                    @if($errors->has('voucher_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('voucher_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.voucher_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="shipping_balance">{{ trans('cruds.point.fields.shipping_balance') }}</label>
                    <input class="form-control {{ $errors->has('shipping_balance') ? 'is-invalid' : '' }}" type="text" name="shipping_balance" id="shipping_balance" value="{{ old('shipping_balance', '') }}">
                    @if($errors->has('shipping_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.shipping_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cash_voucher_balance">{{ trans('cruds.point.fields.cash_voucher_balance') }}</label>
                    <input class="form-control {{ $errors->has('cash_voucher_balance') ? 'is-invalid' : '' }}" type="text" name="cash_voucher_balance" id="cash_voucher_balance" value="{{ old('cash_voucher_balance', '') }}">
                    @if($errors->has('cash_voucher_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cash_voucher_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.pv_balance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="pv_balance">{{ trans('cruds.point.fields.pv_balance') }}</label>
                    <input class="form-control {{ $errors->has('pv_balance') ? 'is-invalid' : '' }}" type="text" name="pv_balance" id="pv_balance" value="{{ old('pv_balance', '') }}">
                    @if($errors->has('pv_balance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pv_balance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.point.fields.pv_balance_helper') }}</span>
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
