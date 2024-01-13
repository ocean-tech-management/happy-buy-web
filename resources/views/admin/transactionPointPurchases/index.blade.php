@extends('layouts.admin')
@section('content')
@can('transaction_point_purchase_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @if(Route::is("admin.transaction-point-purchases.user-upgrade") || Route::is("admin.transaction-point-purchases.user-upgrade-new"))

                <a class="btn btn-success" href="{{ route('admin.transaction-point-purchases.user-upgrade-create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userUpgrade.title') }}
                </a>
            @else
                <a class="btn btn-success" href="{{ route('admin.transaction-point-purchases.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.transactionPointPurchase.title_singular') }}
                </a>
            @endif
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        @if(Route::is("admin.transaction-point-purchases.index"))
            {{ trans('cruds.transactionPointPurchase.title_singular') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-point-purchases.new"))
            {{ trans('cruds.transactionPointPurchase.fields.newPurchase') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-point-purchases.verified"))
            {{ trans('cruds.transactionPointPurchase.fields.verifiedPurchase') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-point-purchases.failed"))
            {{ trans('cruds.transactionPointPurchase.fields.failedPurchase') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-point-purchases.user-upgrade"))
            {{ trans('cruds.userUpgrade.title') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-point-purchases.user-upgrade-new"))
            {{ trans('cruds.userUpgrade.fields.pending_upgrade') }} {{ trans('global.list') }}
        @endif

    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="transaction"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointPurchase.fields.transaction')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointPurchase.fields.user')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="admin"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointPurchase.fields.admin')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="pg_status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.transactionPointPurchase.fields.gateway_status')])}}</option>
                    @foreach(App\Models\TransactionPointPurchase::GATEWAY_STATUS_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="payment_method">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.transactionPointPurchase.fields.payment_method')])}}</option>
                    @foreach(App\Models\PaymentMethod::get() as $key => $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>>
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionPointPurchase">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.point_package') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.point') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointPurchase.fields.created_at') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointPurchase.fields.receipt') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointPurchase.fields.payment_verified_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointPurchase.fields.admin') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointPurchase.fields.gateway_response') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointPurchase.fields.gateway_status') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointPurchase.fields.gateway_transaction') }}--}}
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
@can('transaction_point_purchase_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-point-purchases.massDestroy') }}",
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
    // searching:false;
      searching: false,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {url:
        @if(Route::is("admin.transaction-point-purchases.index")) "{{ route('admin.transaction-point-purchases.index') }}"
        @elseif(Route::is("admin.transaction-point-purchases.new")) "{{ route('admin.transaction-point-purchases.new') }}"
        @elseif(Route::is("admin.transaction-point-purchases.verified")) "{{ route('admin.transaction-point-purchases.verified') }}"
        @elseif(Route::is("admin.transaction-point-purchases.failed")) "{{ route('admin.transaction-point-purchases.failed') }}"
        @elseif(Route::is("admin.transaction-point-purchases.user-upgrade")) "{{ route('admin.transaction-point-purchases.user-upgrade') }}"
        @elseif(Route::is("admin.transaction-point-purchases.user-upgrade-new")) "{{ route('admin.transaction-point-purchases.user-upgrade-new') }}"
        @endif,

        data: function (d) {
                d.transaction = $('#transaction').val();
                d.user = $('#user').val();
                d.admin = $('#admin').val();
                d.pg_status = $('#pg_status').val();
                d.payment_method = $('#payment_method').val();
            },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' , visible: false},
{ data: 'transaction', name: 'transaction' },
{ data: 'user_name', name: 'user.name' },
{ data: 'point_package_name_en', name: 'point_package.name_en' },
{ data: 'point', name: 'point' },
{ data: 'price', name: 'price' },
{ data: 'payment_method_name', name: 'payment_method.name' },
{ data: 'status', name: 'status' },
{ data: 'created_at', name: 'created_at' },
// { data: 'receipt', name: 'receipt', sortable: false, searchable: false },
// { data: 'payment_verified_at', name: 'payment_verified_at' },
// { data: 'admin_name', name: 'admin.name' },
// { data: 'gateway_response', name: 'gateway_response' },
// { data: 'gateway_status', name: 'gateway_status' },
// { data: 'gateway_transaction', name: 'gateway_transaction' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionPointPurchase').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      $("#search-btn").click();
    }
  });

  $("#search-btn").click(function(){
      table.ajax.reload();
  });

  $("#reset-btn").click(function(){
      $('#transaction').val(null);
      $('#user').val(null);
      $('#admin').val(null);
      $('#pg_status').val(null);
      $('#payment_method').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
