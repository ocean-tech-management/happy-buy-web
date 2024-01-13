@extends('layouts.admin')
@section('content')
    @can('user_entry_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.user-entries.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userEntry.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userEntry.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="user"
                           placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointPurchase.fields.user')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="invoice"
                           placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.userEntry.fields.invoice')])}}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="receipt"
                           placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.userEntry.fields.receipt')])}}">
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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserEntry">
                <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.userEntry.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.user_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.deposit') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.fee') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.top_up') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.invoice') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.receipt') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.created_at') }}
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
            @can('user_entry_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.user-entries.massDestroy') }}",
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
                    url: "{{ route('admin.user-entries.index') }}",
                    data: function (d) {
                        d.user = $('#user').val();
                        d.invoice = $('#invoice').val();
                        d.receipt = $('#receipt').val();
                    },
                },
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' , visible: false},
                    { data: 'user_name', name: 'user.name' },
                    { data: 'user_type', name: 'user_type' },
                    { data: 'deposit', name: 'deposit' },
                    { data: 'fee', name: 'fee' },
                    { data: 'top_up', name: 'top_up' },
                    { data: 'new_invoice_number', name: 'new_invoice_number' },
                    { data: 'new_receipt_number', name: 'new_receipt_number' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-UserEntry').DataTable(dtOverrideGlobals);
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
                $('#invoice').val(null);
                $('#receipt').val(null);
                table.ajax.reload()
            });

        });

    </script>
@endsection
