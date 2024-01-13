@extends('layouts.admin')
@section('content')
{{--@can('transaction_bonus_given_create')--}}
{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('admin.transaction-bonus-givens.create') }}">--}}
{{--                {{ trans('global.add') }} {{ trans('cruds.transactionBonusGiven.title_singular') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}
<div class="card">
    <div class="card-header">
        @if(Route::is("admin.transaction-bonus-givens.index"))
            {{ trans('cruds.transactionBonusGiven.title_singular') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-bonus-givens.referral"))
            {{ trans('cruds.transactionBonusGiven.fields.referral_bonus') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-bonus-givens.personal-topup"))
            {{ trans('cruds.transactionBonusGiven.fields.personal_topup_bonus') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-bonus-givens.team-topup"))
            {{ trans('cruds.transactionBonusGiven.fields.team_topup_bonus') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-bonus-givens.personal-annual"))
            {{ trans('cruds.transactionBonusGiven.fields.personal_annual_bonus') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.transaction-bonus-givens.team-annual"))
            {{ trans('cruds.transactionBonusGiven.fields.team_annual_bonus') }} {{ trans('global.list') }}
        @endif
    </div>

    <form action="{{ route('admin.transaction-bonus-givens.export') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">
                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="transaction" name="transaction"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionBonusGiven.fields.transaction')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="admin" name="admin"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionBonusGiven.fields.admin')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="user" name="user"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionBonusGiven.fields.user')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="title" name="title"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionBonusGiven.fields.title')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <select class="form-control datatable-input" id="status" name="status">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.transactionBonusGiven.fields.status')])}}</option>
                        @foreach(App\Models\TransactionBonusGiven::STATUS_SELECT as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>>
                        @endforeach
                    </select>
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" name="start_date" id="start_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{trans('global.enter_for', ['value'=>trans('global.start_date')])}}">
                </div>
                
                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" name="end_date" id="end_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{trans('global.enter_for', ['value'=>trans('global.end_date')])}}">
                </div>

                <div class="mb-lg-0 mb-4 input-div col-lg-3" >
                    <button type="button" id="search-btn" name="search" value="Search" class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">
                        <i class="fa fa-search"></i> {{trans('global.search')}}
                    </button>

                    <button type="reset" id="reset-btn" name="reset" value="Reset" class="btn btn-secondary btn-secondary--icon tw-rounded">
                        <i class="fa fa-times"></i> {{trans('global.reset')}}
                    </button>

                    <button id="export-btn" type="submit" value="Export" class="btn btn-secondary btn-secondary--icon tw-rounded" style="background-color:rgb(40, 151, 199)">
                        <i class="fas fa-file-export"></i> {{trans('global.export')}}
                    </button>
                </div>

            </div>
        </div>
    </form>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionBonusGiven">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.transaction') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionBonusGiven.fields.admin') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.user') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.transactionBonusGiven.fields.title') }}--}}
{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.remark') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.transactionBonusGiven.fields.given_at') }}
                    </th>
{{--                    <th>--}}
{{--                        &nbsp;--}}
{{--                    </th>--}}
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
@can('transaction_bonus_given_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-bonus-givens.massDestroy') }}",
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
    ajax: {url:
        @if(Route::is("admin.transaction-bonus-givens.index")) "{{ route('admin.transaction-bonus-givens.index') }}"
        @elseif(Route::is("admin.transaction-bonus-givens.referral")) "{{ route('admin.transaction-bonus-givens.referral') }}"
        @elseif(Route::is("admin.transaction-bonus-givens.personal-topup")) "{{ route('admin.transaction-bonus-givens.personal-topup') }}"
        @elseif(Route::is("admin.transaction-bonus-givens.team-topup")) "{{ route('admin.transaction-bonus-givens.team-topup') }}"
        @elseif(Route::is("admin.transaction-bonus-givens.personal-annual")) "{{ route('admin.transaction-bonus-givens.personal-annual') }}"
        @elseif(Route::is("admin.transaction-bonus-givens.team-annual")) "{{ route('admin.transaction-bonus-givens.team-annual') }}"
        @endif,

        data: function (d) {
            d.transaction = $('#transaction').val();
            d.admin = $('#admin').val();
            d.user =$('#user').val();
            d.title = $('#title').val();
            d.status = $('#status').val();
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
        },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id', visible: false },
        { data: 'transaction', name: 'transaction' },
        // { data: 'admin_name', name: 'admin.name' },
        { data: 'user_name', name: 'user.name' },
        // { data: 'title', name: 'title' },
        { data: 'remark', name: 'remark' },
        { data: 'amount', name: 'amount' },
        { data: 'type', name: 'type' },
        { data: 'status', name: 'status' },
        { data: 'given_at', name: 'given_at' },
{{--        { data: 'actions', name: '{{ trans('global.actions') }}' }--}}
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-TransactionBonusGiven').DataTable(dtOverrideGlobals);
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
      $('#admin').val(null);
      $('#user').val(null);
      $('#title').val(null);
      $('#status').val(null);
      $('#start_date').val(null);
      $('#end_date').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
