@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.addressBook.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.address-books.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.id') }}
                        </th>
                        <td>
                            {{ $addressBook->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.user') }}
                        </th>
                        <td>
                            {{ $addressBook->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.remark') }}
                        </th>
                        <td>
                            {{ $addressBook->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.name') }}
                        </th>
                        <td>
                            {{ $addressBook->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.phone') }}
                        </th>
                        <td>
                            {{ $addressBook->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.address_1') }}
                        </th>
                        <td>
                            {{ $addressBook->address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.address_2') }}
                        </th>
                        <td>
                            {{ $addressBook->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.city') }}
                        </th>
                        <td>
                            {{ $addressBook->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.state') }}
                        </th>
                        <td>
                            {{ $addressBook->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.postcode') }}
                        </th>
                        <td>
                            {{ $addressBook->postcode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.set_default') }}
                        </th>
                        <td>
                            {{ App\Models\AddressBook::SET_DEFAULT_SELECT[$addressBook->set_default] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addressBook.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\AddressBook::STATUS_SELECT[$addressBook->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.address-books.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection