@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.enquiryReply.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.enquiry-replies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiryReply.fields.id') }}
                        </th>
                        <td>
                            {{ $enquiryReply->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiryReply.fields.enquiry') }}
                        </th>
                        <td>
                            {{ $enquiryReply->enquiry->message ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiryReply.fields.admin') }}
                        </th>
                        <td>
                            {{ $enquiryReply->admin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enquiryReply.fields.message') }}
                        </th>
                        <td>
                            {{ $enquiryReply->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.enquiry-replies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection