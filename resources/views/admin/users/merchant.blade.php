@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.merchants.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.fields.merchant') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.fields.merchant') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">

        <div class="row px-5 mb-1 d-flex mt-5">
            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="name"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.user.fields.name')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="phone"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.user.fields.phone')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="email"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.user.fields.email')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="identity_no"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.user.fields.identity_no')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="gender">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.user.fields.gender')])}}</option>
                    @foreach(App\Models\User::GENDER_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.user.fields.status')])}}</option>
                    @foreach(App\Models\User::STATUS_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="user_type">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.user.fields.user_type')])}}</option>
                    @foreach(App\Models\User::USER_TYPE_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="allow_order_status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.user.fields.order_status')])}}</option>
                    @foreach(App\Models\User::ALLOW_ORDER_STATUS_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            <div class="mb-lg-0 mb-4 input-div col-lg-3" >
                <button type="button" id="search-btn" name="search" value="Search" class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">
                    <i class="fa fa-search"></i> {{trans('global.search')}}
                </button>

                <button type="reset" id="reset-btn" name="reset" value="Reset" class="btn btn-secondary btn-secondary--icon tw-rounded">
                    <i class="fa fa-times"></i> {{trans('global.reset')}}
                </button>
            </div>

        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.profile_photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.identity_type') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.identity_no') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.user.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.date_of_birth') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.gender') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.bank_list') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.bank_name') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.bank_account_name') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.bank_account_number') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.country') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.user.fields.user_type') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.personal_code') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.upline_user') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.upline_user_1') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.user.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.order_status') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.account_verify') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.ssm_verify') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.first_payment') }}--}}
{{--                    </th>--}}

{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.ssm_photo') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.ic_photo') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.first_payment_receipt_photo') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.email_verified_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.user.fields.roles') }}--}}
{{--                    </th>--}}
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    // buttons: dtButtons,
    // searching: false;
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
            url: "{{ route('admin.users.merchants') }}",
            data: function (d) {
                d.name = $('#name').val();
                d.phone =$('#phone').val();
                d.email = $('#email').val();
                d.identity_no = $('#identity_no').val();
                d.gender = $('#gender').val();
                d.status = $('#status').val();
                d.allow_order_status = $('#allow_order_status').val();
                d.user_type = $('#user_type').val();
            },
        },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id', visible:false },
        { data: 'profile_photo', name: 'profile_photo', sortable: false, searchable: false },
{ data: 'name', name: 'name' },
// { data: 'identity_type', name: 'identity_type' },
// { data: 'identity_no', name: 'identity_no' },
{ data: 'phone', name: 'phone' },
{ data: 'email', name: 'email' },
// { data: 'date_of_birth', name: 'date_of_birth' },
// { data: 'gender', name: 'gender' },
// { data: 'bank_list_code', name: 'bank_list.code' },
// { data: 'bank_name', name: 'bank_name' },
// { data: 'bank_account_name', name: 'bank_account_name' },
// { data: 'bank_account_number', name: 'bank_account_number' },
// { data: 'country_name', name: 'country.name' },
{ data: 'user_type', name: 'user_type' },
// { data: 'personal_code', name: 'personal_code' },
// { data: 'upline_user_name', name: 'upline_user.name' },
// { data: 'upline_user_1_name', name: 'upline_user_1.name' },
{ data: 'status', name: 'status' },
{ data: 'allow_order_status', name: 'allow_order_status' },
// { data: 'account_verify', name: 'account_verify' },
// { data: 'ssm_verify', name: 'ssm_verify' },
// { data: 'first_payment', name: 'first_payment' },
// { data: 'ssm_photo', name: 'ssm_photo', sortable: false, searchable: false },
// { data: 'ic_photo', name: 'ic_photo', sortable: false, searchable: false },
// { data: 'first_payment_receipt_photo', name: 'first_payment_receipt_photo', sortable: false, searchable: false },
// { data: 'email_verified_at', name: 'email_verified_at' },
// { data: 'roles', name: 'roles.title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-User').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $("#search-btn").click(function(){
      table.ajax.reload();
  });

  $("#reset-btn").click(function(){
      $('#name').val(null);
      $('#phone').val(null);
      $('#email').val(null);
      $('#identity_no').val(null);
      $('#gender').val(null);
      $('#status').val(null);
      $('#allow_order_status').val(null);
      $('#user_type').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
