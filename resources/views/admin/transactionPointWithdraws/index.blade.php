@extends('layouts.admin')
@section('content')
@can('transaction_point_withdraw_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-point-withdraws.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionPointWithdraw.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionPointWithdraw.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="transaction"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointWithdraw.fields.transaction')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointWithdraw.fields.user')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="ba_name"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointWithdraw.fields.bank_account_name')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="ba_number"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointWithdraw.fields.bank_account_number')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.transactionPointPurchase.fields.status')])}}</option>
                    @foreach(App\Models\TransactionPointWithdraw::STATUS_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            {{-- <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="admin"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointWithdraw.fields.admin')])}}">
            </div>  --}}

            <div class="mb-lg-0 mb-4 input-div col-lg-3" >
                <button type="button" id="search-btn" name="search" value="Search" class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">
                    <i class="fa fa-search"></i> {{trans('global.search')}}
                </button>

                <button type="reset" id="reset-btn" name="reset" value="Reset" class="btn btn-secondary btn-secondary--icon tw-rounded">
                    <i class="fa fa-times"></i> {{trans('global.reset')}}
                </button>
            </div>

        </div>
        @can('transaction_point_withdraw_export')
            @if(Route::is('admin.transaction-point-withdraws.pending'))
                @if(getNewWithdrawCount() > 0  )
                    <div style="text-align: right">
                        <form action="{{ route('admin.transaction-point-withdraws.export') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-sm btn-info" value="{{ trans('global.export') }}">
                        </form>
                    </div>
                @endif
            @endif
        @endcan
    </div>



    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionPointWithdraw">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.bank_account_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.bank_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.bank_account_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionPointWithdraw.fields.status') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointWithdraw.fields.admin') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointWithdraw.fields.receipt') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionPointWithdraw.fields.remark') }}--}}
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
@can('transaction_point_withdraw_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-point-withdraws.massDestroy') }}",
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
      drawCallback: function(settings, json) {
          $(".btn-reject").click(function (e) {
              var id = $(this).data('id');
              console.log(id);
              Swal.fire({
                  title: '{{ trans('global.reject_request', ['value' => strtolower(trans('cruds.transactionPointWithdraw.title'))]) }}',
                  input: 'text',
                  inputLabel: '{{ trans('cruds.transactionPointWithdraw.fields.reject_reason') }}',
                  inputAttributes: {
                      autocapitalize: 'off'
                  },
                  showCancelButton: true,
                  confirmButtonText: '{{trans('global.confirm')}}',
                  cancelButtonText: '{{trans('global.cancel')}}',
                  showLoaderOnConfirm: true,
                  inputValidator: (value) => {
                      if (!value) {
                          return '{{ trans('global.enter_for', ['value' => strtolower(trans('cruds.transactionPointWithdraw.fields.reject_reason'))]) }}'
                      }
                  },
                  // preConfirm: (login) => {
                  //     return fetch(`//api.github.com/users/${login}`)
                  //         .then(response => {
                  //             if (!response.ok) {
                  //                 throw new Error(response.statusText)
                  //             }
                  //             return response.json()
                  //         })
                  //         .catch(error => {
                  //             Swal.showValidationMessage(
                  //                 `Request failed: ${error}`
                  //             )
                  //         })
                  // },
                  // allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                  console.log(result.value);
                  if (result.isConfirmed) {

                      $.post('{{ route("admin.transaction-point-withdraws.confirm-reject") }}', {reason: result.value, id: id, _token: $('meta[name="csrf-token"]').attr('content')})
                          .done(function (params) {
                              console.log(params.status);
                              if(params.status == 1){
                                  Swal.fire({
                                      icon: 'success',
                                      title: '{{trans('global.success')}}',
                                      text: '{{ trans('global.reject_success', ['value' => trans('cruds.transactionPointWithdraw.title')]) }}',
                                      timer: 2000,
                                  })
                                  location.reload();
                              }
                              {{--swal({--}}
                              {{--    text: "{{ trans('global.success') }}",--}}
                              {{--    icon: "success",--}}
                              {{--});--}}
                              //
                          })
                          .fail(function(error) {
                              console.log(error);
                              {{--swal({--}}
                              {{--    text: "{{ trans('global.failed') }}",--}}
                              {{--    icon: "error",--}}
                              {{--});--}}
                          });
                      // Swal.fire({
                      //     title: `${result.value.login}'s avatar`,
                      //     imageUrl: result.value.avatar_url
                      // })
                  }
              })
          });
      },
    // buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {url:
        @if(Route::is('admin.transaction-point-withdraws.index')) "{{ route('admin.transaction-point-withdraws.index') }}"
        @elseif(Route::is('admin.transaction-point-withdraws.pending')) "{{ route('admin.transaction-point-withdraws.pending') }}"
        @elseif(Route::is('admin.transaction-point-withdraws.processing')) "{{ route('admin.transaction-point-withdraws.processing') }}"
        @elseif(Route::is('admin.transaction-point-withdraws.completed')) "{{ route('admin.transaction-point-withdraws.completed') }}"
        @elseif(Route::is('admin.transaction-point-withdraws.rejected')) "{{ route('admin.transaction-point-withdraws.rejected') }}"
        @endif,

        data: function (d) {
                d.transaction = $('#transaction').val();
                d.user = $('#user').val();
                d.ba_name = $('#ba_name').val();
                d.ba_number = $('#ba_number').val();
                d.status = $('#status').val();
            },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' , visible: false},
        { data: 'bank_account_name', name: 'bank_account_name' },
        { data: 'bank_name', name: 'bank_name' },
        { data: 'bank_account_number', name: 'bank_account_number' },
        { data: 'amount', name: 'amount', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
{ data: 'transaction', name: 'transaction' },
{ data: 'user_name', name: 'user.name' },

{ data: 'status', name: 'status' },
// { data: 'admin_name', name: 'admin.name' },
// { data: 'receipt', name: 'receipt', sortable: false, searchable: false },
// { data: 'remark', name: 'remark' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionPointWithdraw').DataTable(dtOverrideGlobals);
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
      $('#ba_name').val(null);
      $('#ba_number').val(null);
      $('#status').val(null);
      table.ajax.reload()
  });

});

</script>

@endsection
