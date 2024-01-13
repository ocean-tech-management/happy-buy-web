@extends('layouts.admin')
@section('content')
{{--@can('transaction_agent_top_up_create')--}}
{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('admin.transaction-agent-top-ups.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.transactionAgentTopUp.title_singular') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        @if(Route::is('admin.transaction-agent-top-ups.index'))
            {{ trans('cruds.transactionAgentTopUp.title_singular') }} {{ trans('global.list') }}
        @elseif(Route::is('admin.transaction-agent-top-ups.new'))
            {{ trans('cruds.transactionAgentTopUp.fields.newTopUp') }} {{ trans('global.list') }}
        @elseif(Route::is('admin.transaction-agent-top-ups.approved'))
            {{ trans('cruds.transactionAgentTopUp.fields.approvedTopUp') }} {{ trans('global.list') }}
        @elseif(Route::is('admin.transaction-agent-top-ups.rejected'))
            {{ trans('cruds.transactionAgentTopUp.fields.rejectedTopUp') }} {{ trans('global.list') }}
        @endif
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="transaction"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionAgentTopUp.fields.transaction')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionAgentTopUp.fields.user')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="merchant"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionAgentTopUp.fields.merchant')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.transactionAgentTopUp.fields.status')])}}</option>
                    @foreach(App\Models\TransactionAgentTopUp::STATUS_SELECT as $key => $item)
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionAgentTopUp">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.upline') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.amount') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.merchant_pre_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.merchant_post_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.user_pre_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.user_post_balance') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionAgentTopUp.fields.status') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.receipt_photo') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.approved_at') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionAgentTopUp.fields.rejected_at') }}--}}
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
@can('transaction_agent_top_up_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-agent-top-ups.massDestroy') }}",
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
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax:{ url:
        @if(Route::is('admin.transaction-agent-top-ups.index')) "{{ route('admin.transaction-agent-top-ups.index') }}"
        @elseif(Route::is('admin.transaction-agent-top-ups.new')) "{{ route('admin.transaction-agent-top-ups.new') }}"
        @elseif(Route::is('admin.transaction-agent-top-ups.approved')) "{{ route('admin.transaction-agent-top-ups.approved') }}"
        @elseif(Route::is('admin.transaction-agent-top-ups.rejected')) "{{ route('admin.transaction-agent-top-ups.rejected') }}"
      @endif,

      data: function (d) {
            d.transaction = $('#transaction').val();
            d.user = $('#user').val();
            d.merchant = $('#merchant').val();
            d.status = $('#status').val();
        },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id', visible: false },
        { data: 'transaction', name: 'transaction' },
        { data: 'user_name', name: 'user.name' },
        { data: 'merchant_name', name: 'merchant.name' },
        { data: 'amount', name: 'amount' },
        // { data: 'merchant_pre_balance', name: 'merchant_pre_balance' },
        // { data: 'merchant_post_balance', name: 'merchant_post_balance' },
        // { data: 'user_pre_balance', name: 'user_pre_balance' },
        // { data: 'user_post_balance', name: 'user_post_balance' },
        { data: 'status', name: 'status' },
        // { data: 'receipt_photo', name: 'receipt_photo', sortable: false, searchable: false },
        // { data: 'approved_at', name: 'approved_at' },
        // { data: 'rejected_at', name: 'rejected_at' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionAgentTopUp').DataTable(dtOverrideGlobals);
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
        $('#merchant').val(null);
        $('#status').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
