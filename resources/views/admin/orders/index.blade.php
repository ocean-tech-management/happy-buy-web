@extends('layouts.admin')
@section('content')
@can('order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        @if(Route::is("admin.orders.index"))
            {{ trans('cruds.order.fields.all_order') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.orders.new"))
            {{ trans('cruds.order.fields.new_order') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.orders.shipped"))
            {{ trans('cruds.order.fields.shipped_order') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.orders.picked-up"))
            {{ trans('cruds.order.fields.picked_up_order') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.orders.completed"))
            {{ trans('cruds.order.fields.completed_order') }} {{ trans('global.list') }}
        @elseif(Route::is("admin.orders.cancelled"))
            {{ trans('cruds.order.fields.cancelled_order') }} {{ trans('global.list') }}
        @endif
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="order_number"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.order.fields.order_number')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.order.fields.user')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="collect_type">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.order.fields.collect_type')])}}</option>
                    @foreach(App\Models\Order::COLLECT_TYPE_SELECT as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.order.fields.status')])}}</option>
                    @foreach(App\Models\Order::STATUS_SELECT as $key => $item)
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Order">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.order.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.order_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.user') }}
                    </th>

                    <th>
                        {{ trans('cruds.order.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.collect_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.status') }}
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
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
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
        @if(Route::is("admin.orders.index")) "{{ route('admin.orders.index') }}"
        @elseif(Route::is("admin.orders.new")) "{{ route('admin.orders.new') }}"
        @elseif(Route::is("admin.orders.shipped")) "{{ route('admin.orders.shipped') }}"
        @elseif(Route::is("admin.orders.picked-up")) "{{ route('admin.orders.picked-up') }}"
        @elseif(Route::is("admin.orders.completed")) "{{ route('admin.orders.completed') }}"
        @elseif(Route::is("admin.orders.cancelled")) "{{ route('admin.orders.cancelled') }}"
      @endif,

      data: function (d) {
            d.order_number = $('#order_number').val();
            d.user = $('#user').val();
            d.collect_type = $('#collect_type').val();
            d.status = $('#status').val();
        },
    },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id', visible: false },
{ data: 'order_number', name: 'order_number' },
        { data: 'user_name', name: 'user.name' },
{ data: 'amount', name: 'amount', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
{ data: 'collect_type', name: 'collect_type' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 0, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Order').DataTable(dtOverrideGlobals);
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
        $('#order_number').val(null);
        $('#user').val(null);
        $('#collect_type').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
