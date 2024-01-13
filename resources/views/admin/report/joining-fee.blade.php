@extends('layouts.admin')
@section('content')
{{--    @can('user_entry_create')--}}
{{--        <div style="margin-bottom: 10px;" class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <a class="btn btn-success" href="{{ route('admin.user-entries.create') }}">--}}
{{--                    {{ trans('global.add') }} {{ trans('cruds.userEntry.title_singular') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endcan--}}
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.report.fields.joining_fee') }} {{ trans('global.list') }}
        </div>

        <form action="{{ route('admin.reports.joining-fee.export') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card-body">
            <div class="row px-5 mb-1 d-flex mt-5">
                <div class="flex-grow-1 input-div col-2">
                    <input type="text" class="form-control datatable-input" id="user"
                           placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.transactionPointPurchase.fields.user')])}}">
                </div>

                <div class="flex-grow-1 input-div col-2">
                    <input type="text" class="form-control datatable-input" name="start_date" id="start_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{trans('global.enter_for', ['value'=>trans('global.start_date')])}}">
                </div>

                <div class="flex-grow-1 input-div col-2">
                    <input type="text" class="form-control datatable-input" name="end_date" id="end_date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="{{trans('global.enter_for', ['value'=>trans('global.end_date')])}}">
                </div>

                <div class="mb-lg-0 mb-4 input-div col-2" >
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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserEntry">
                <thead>
                <tr>
                    {{--                    <th width="10">--}}

                    {{--                    </th>--}}
                    <th>
                        {{ trans('cruds.userEntry.fields.id') }}
                    </th>
                    <th>
                        {{ trans('global.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.invoice') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.user_ic') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.user_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.userEntry.fields.total') }}
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

            let dtOverrideGlobals = {
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                paging: false,
                ajax: {
                    url: "{{ route('admin.reports.joining-fee') }}",
                    data: function (d) {
                        d.user = $('#user').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    },
                },
                columns: [
                    // { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' , visible: false},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'new_invoice_number', name: 'new_invoice_number' },
                    { data: 'user_ic', name: 'user_ic' },
                    { data: 'user_id', name: 'user.id' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'amount', name: 'amount' },
                    { data: 'total', name: 'total'}
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
                $('#start_date').val(null);
                $('#end_date').val(null);
                table.ajax.reload()
            });

        });

    </script>
@endsection
