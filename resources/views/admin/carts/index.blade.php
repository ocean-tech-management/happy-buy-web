@extends('layouts.admin')
@section('content')
@can('cart_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.carts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cart.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cart.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row px-5 mb-1 d-flex mt-5">

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="user"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.cart.fields.user')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="product"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.cart.fields.product')])}}">
            </div>

            <div class="flex-grow-1 input-div col-lg-3">
                <select class="form-control datatable-input" id="status">
                    <option value ="">{{trans('global.select_for', ['value'=>trans('cruds.cart.fields.status')])}}</option>
                    @foreach(App\Models\Cart::STATUS_SELECT as $key => $item)
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Cart">
            <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.cart.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.cart.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.cart.fields.product') }}
                    </th>
                     <th>
                        {{ trans('cruds.cart.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.cart.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.cart.fields.status') }}
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
@can('cart_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.carts.massDestroy') }}",
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
            url: "{{ route('admin.carts.index') }}",
            data: function (d) {
                d.user = $('#user').val();
                d.product= $('#product').val();
                d.status = $('#status').val();
            },
        },
    columns: [
      // { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id', visible:false },
{ data: 'user_name', name: 'user.name' },
{ data: 'product_name_en', name: 'product.name_en' },
{ data: 'type', name: 'type' },
{ data: 'quantity', name: 'quantity' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 5, 'asc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Cart').DataTable(dtOverrideGlobals);
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
      $('#product').val(null);
      $('#status').val(null);
      table.ajax.reload()
  });

});

</script>
@endsection
