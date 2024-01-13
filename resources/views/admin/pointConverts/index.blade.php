@extends('layouts.admin')
@section('content')
    @can('point_convert_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.point-converts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.pointConvert.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.pointConvert.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="transaction"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.pointConvert.fields.transaction')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="user"
                    placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.pointConvert.fields.user')])}}">
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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PointConvert">
                <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.pointConvert.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointConvert.fields.transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointConvert.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.pointConvert.fields.amount') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.pointConvert.fields.pre_cp_bonus_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.pointConvert.fields.post_cp_bonus_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.pointConvert.fields.pre_cp_balance') }}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{ trans('cruds.pointConvert.fields.post_cp_balance') }}--}}
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
            @can('point_convert_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.point-converts.massDestroy') }}",
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
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.point-converts.index') }}",
                    data: function (d) {
                        d.transaction = $('#transaction').val();
                        d.user = $('#user').val();
                    },
                },
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' , visible: false},
                    { data: 'transaction', name: 'transaction' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'amount', name: 'amount', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
                    // { data: 'pre_cp_bonus_balance', name: 'pre_cp_bonus_balance', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
                    // { data: 'post_cp_bonus_balance', name: 'post_cp_bonus_balance', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
                    // { data: 'pre_cp_balance', name: 'pre_cp_balance', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
                    // { data: 'post_cp_balance', name: 'post_cp_balance', render: $.fn.dataTable.render.number( ',', '.', 0, '' ) },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-PointConvert').DataTable(dtOverrideGlobals);
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
                $('user').val(null);
                table.ajax.reload()
            });

        });

    </script>
@endsection
