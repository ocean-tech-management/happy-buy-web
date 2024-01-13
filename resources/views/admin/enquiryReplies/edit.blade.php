@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.enquiryReply.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.enquiry-replies.update", [$enquiryReply->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="enquiry_id">{{ trans('cruds.enquiryReply.fields.enquiry') }}</label>
                <select class="form-control select2 {{ $errors->has('enquiry') ? 'is-invalid' : '' }}" name="enquiry_id" id="enquiry_id" required>
                    @foreach($enquiries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('enquiry_id') ? old('enquiry_id') : $enquiryReply->enquiry->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('enquiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('enquiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.enquiryReply.fields.enquiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="admin_id">{{ trans('cruds.enquiryReply.fields.admin') }}</label>
                <select class="form-control select2 {{ $errors->has('admin') ? 'is-invalid' : '' }}" name="admin_id" id="admin_id" required>
                    @foreach($admins as $id => $entry)
                        <option value="{{ $id }}" {{ (old('admin_id') ? old('admin_id') : $enquiryReply->admin->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('admin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.enquiryReply.fields.admin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message">{{ trans('cruds.enquiryReply.fields.message') }}</label>
                <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" type="text" name="message" id="message" value="{{ old('message', $enquiryReply->message) }}" required>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.enquiryReply.fields.message_helper') }}</span>
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