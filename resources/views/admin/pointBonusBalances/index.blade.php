@extends('layouts.admin')
@section('content')
@can('point_bonus_balance_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.point-bonus-balances.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pointBonusBalance.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pointBonusBalance.title_singular') }} {{ trans('global.list') }}
    </div>

    <form action="{{ route('admin.point-bonus-balances.export') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="user" name="user" 
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.pointBonusBalance.fields.user')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="amount" name="amount" 
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.pointBonusBalance.fields.amount')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <select class="form-control datatable-input" id="status" name="status">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.pointBonusBalance.fields.status')])}}</option>
                        @foreach(App\Models\PointBonusBalance::STATUS_SELECT as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>>
                        @endforeach
                    </select>
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <select class="form-control datatable-input" id="settlement" name="settlement">
                        <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.pointBonusBalance.fields.settlement')])}}</option>
                        @foreach(App\Models\PointBonusBalance::SETTLEMENT_SELECT as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>>
                        @endforeach
                    </select>
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="remark" name="remark" 
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.pointBonusBalance.fields.remark')])}}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PointBonusBalance">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.pointBonusBalance.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointBonusBalance.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointBonusBalance.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointBonusBalance.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointBonusBalance.fields.settlement') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointBonusBalance.fields.remark') }}
                    </th>
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
@can('point_bonus_balance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.point-bonus-balances.massDestroy') }}",
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
    ajax: {
        url:"{{  route('admin.point-bonus-balances.index') }}",
        data:function(d){
            d.user = $('#user').val();
            d.amount = $('#amount').val();
            d.status = $('#status').val(); 
            d.settlement = $('#settlement').val();
            d.remark = $('#remark').val();
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
        },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' , visible:false},
        { data: 'user_name', name: 'user.name' },
        { data: 'amount', name: 'amount', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
        { data: 'status', name: 'status' },
        { data: 'settlement', name: 'settlement' },
        { data: 'remark', name: 'remark' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-PointBonusBalance').DataTable(dtOverrideGlobals);
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
      $('#user').val(null);
      $('#status').val(null);
      $('#amount').val(null);
      $('#settlement').val(null);
      $('#remark').val(null);
      $('#start_date').val(null);
      $('#end_date').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
