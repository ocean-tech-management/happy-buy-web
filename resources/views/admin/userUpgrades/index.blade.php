@extends('layouts.admin')
@section('content')
    @can('user_upgrade_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.user-upgrades.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userUpgrade.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userUpgrade.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserUpgrade">
                <thead>
                <tr>
{{--                    <th width="10">--}}

{{--                    </th>--}}
                    <th>
                        {{ trans('cruds.userUpgrade.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.upgrade_role') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.receipt') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.gateway_response') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.gateway_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.gateway_transaction') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.approve_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.approved_by_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userUpgrade.fields.approved_by_admin') }}
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
            @can('user_upgrade_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.user-upgrades.massDestroy') }}",
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
                ajax: "{{ route('admin.user-upgrades.index') }}",
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id', visible: false },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'upgrade_role_title', name: 'upgrade_role.name' },
                    { data: 'amount', name: 'amount' },
                    { data: 'receipt', name: 'receipt', sortable: false, searchable: false },
                    { data: 'payment_method_name', name: 'payment_method.name' },
                    { data: 'status', name: 'status' },
                    { data: 'gateway_response', name: 'gateway_response' },
                    { data: 'gateway_status', name: 'gateway_status' },
                    { data: 'gateway_transaction', name: 'gateway_transaction' },
                    { data: 'approve_at', name: 'approve_at' },
                    { data: 'approved_by_user_name', name: 'approved_by_user.name' },
                    { data: 'approved_by_admin_name', name: 'approved_by_admin.name' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-UserUpgrade').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
