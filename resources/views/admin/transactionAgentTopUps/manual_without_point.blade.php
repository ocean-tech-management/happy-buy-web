@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transactionAgentTopUp.title_singular') }} - Manual Without Point (One Time Usage)
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transaction-agent-top-ups.manual-topup-without-point") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.transactionAgentTopUp.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $entry)
                        <option value="{{ $entry->id }}" {{ old('user_id') == $entry->id ? 'selected' : '' }}>{{ $entry->name }} - {{ $entry->personal_code }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.transactionAgentTopUp.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', '') }}">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transactionAgentTopUp.fields.amount_helper') }}</span>
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

@endsection
