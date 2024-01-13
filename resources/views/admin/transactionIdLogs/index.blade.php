@extends('layouts.admin')
@section('content')
    @can('transaction_id_log_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.transaction-id-logs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.transactionIdLog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transactionIdLog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">
                <div class="flex-grow-1 input-div col-lg-3">
                    <select class="form-control datatable-input" id="type">
                        <option value="">
                            {{ trans('global.select_for', ['value' => trans('cruds.transactionIdLog.fields.type')]) }}
                        </option>
                        @foreach (App\Models\TransactionIdLog::TYPE_SELECT as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>>
                        @endforeach
                    </select>
                </div>

                <div class="flex-grow-1 input-div col-lg-3">
                    <input type="text" class="form-control datatable-input" id="name"
                        placeholder="{{ trans('global.enter_for', ['value' => trans('cruds.transactionIdLog.fields.name')]) }}">
                </div>

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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TransactionIdLog">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionIdLog.fields.user') }}
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
            @can('transaction_id_log_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.transaction-id-logs.massDestroy') }}",
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
                    url: "{{ route('admin.transaction-id-logs.index') }}",
                    data: function(d) {
                        d.type = $('#type').val();
                        d.name = $('#name').val();
                        d.user = $('#user').val();
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
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'user_name',
                        name: 'user.name'
                    },
                    {{-- { data: 'actions', name: '{{ trans('global.actions') }}' } --}}
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
            };
            let table = $('.datatable-TransactionIdLog').DataTable(dtOverrideGlobals);
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
                $('#type').val(null);
                $('#name').val(null);
                $('#user').val(null);
                table.ajax.reload()
            });

        });
    </script>
@endsection
