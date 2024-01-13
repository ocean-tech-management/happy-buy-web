@extends('layouts.admin')
@section('content')
    @can('point_transaction_log_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.point-transaction-logs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.pointTransactionLog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.pointTransactionLog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">
                <div class="flex-grow-1 input-div col-lg-3">
                    <select class="form-control datatable-input" id="user">
                        <option value="">
                            {{ trans('global.select_for', ['value' => trans('cruds.transactionIdLog.fields.user')]) }}
                        </option>
                        @foreach (App\Models\User::get() as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>>
                        @endforeach
                    </select>
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" name="start_date" id="start_date"
                        onfocus="(this.type='date')" onblur="(this.type='text')"
                        placeholder="{{ trans('global.enter_for', ['value' => trans('global.start_date')]) }}">
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" name="end_date" id="end_date"
                        onfocus="(this.type='date')" onblur="(this.type='text')"
                        placeholder="{{ trans('global.enter_for', ['value' => trans('global.end_date')]) }}">
                </div>

                <div class="mb-lg-0 mb-4 input-div col-lg-3">
                    <button type="button" id="search-btn" name="search" value="Search"
                        class="btn btn-primary btn-primary--icon tw-mr-2 tw-rounded">
                        <i class="fa fa-search"></i> {{ trans('global.search') }}
                    </button>

                    <button type="reset" id="reset-btn" name="reset" value="Reset"
                        class="btn btn-secondary btn-secondary--icon tw-rounded">
                        <i class="fa fa-times"></i> {{ trans('global.reset') }}
                    </button>
                </div>

            </div>
        </div>

        <div class="card-body">
            <table
                class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PointTransactionLog">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.top_up') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.topup_receipt') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.point_convert') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.redemption') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.stock_invoice') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.shipping') }}
                        </th>
                        <th>
                            {{ trans('cruds.pointTransactionLog.fields.shipping_invoice') }}
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('point_transaction_log_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.point-transaction-logs.massDestroy') }}",
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
                    url: "{{ route('admin.point-transaction-logs.index') }}",
                    data: function(d) {
                        d.user = $('#user').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                },
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'user_name',
                        name: 'user.name'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'top_up',
                        name: 'top_up'
                    },
                    {
                        data: 'topup_receipt',
                        name: 'topup_receipt'
                    },
                    {
                        data: 'point_convert',
                        name: 'point_convert'
                    },
                    {
                        data: 'redemption',
                        name: 'redemption'
                    },
                    {
                        data: 'stock_invoice',
                        name: 'stock_invoice'
                    },
                    {
                        data: 'shipping',
                        name: 'shipping'
                    },
                    {
                        data: 'shipping_invoice',
                        name: 'shipping_invoice'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
            };
            let table = $('.datatable-PointTransactionLog').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    $("#search-btn").click();
                }
            });

            $("#search-btn").click(function() {
                table.ajax.reload();
            });

            $("#reset-btn").click(function() {
                $('#user').val(null);
                $('#start_date').val(null);
                $('#end_date').val(null);
                table.ajax.reload()
            });
        });
    </script>
@endsection
