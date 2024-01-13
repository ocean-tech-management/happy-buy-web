@extends('landing.app')
@section('css')

    <link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
    @include('user.user-header')
    <div class="cover-background"
         style="background-image: url('{{asset('landing/images/product-details_banner.png')}}')">
        <section>
            <div class="container">
                <div class="row">
                    @component('user.components.left-aside-bar')
                    @endcomponent
                    <div
                        class="col-12 col-lg-8 col-md-8 shopping-content padding-30px-left md-padding-15px-left sm-margin-30px-bottom ">
                        @if(count($request_upgrades) != 0)
                            <div
                                class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom margin-20px-bottom"
                                style="visibility: visible; animation-name: fadeIn;">
                                <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                    <div class="row  align-items-center margin-10px-bottom">
                                        <div class="col-8">
                                            <span class="dark-gold alt-font ">{{ __('user-portal.merchant_upgrade_list') }}</span>
                                        </div>
                                        <div class="col-4 row justify-content-end">

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @foreach($request_upgrades as $pending_upgrade_downline)
                                    <div class="col-12 padding-50px-lr margin-20px-bottom">
                                        <div class="row align-items-center">
                                            <div class="col-3 col-md-2">
                                                <img class="rounded-circle" style="height: 60px;width:60px"
                                                     src="{{ $pending_upgrade_downline->profile_photo ? $pending_upgrade_downline->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                                            </div>
                                            <div class="col-9 col-md-3">
                                                <div class="row align-items-center">
                                                    <div class="pl-3">
                                                        <div class="line-height-16px">
                                                            <span
                                                                class="alt-font text-extra-dark-gray text-small font-weight-700">{{ $pending_upgrade_downline->user->name }}</span>
                                                        </div>
                                                        <div class="line-height-16px">
                                                            <span class="alt-font text-gray text-small font-weight-300">{{ $pending_upgrade_downline->user->personal_code }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3 d-block d-md-none">
                                            </div>
                                            <div class="col-9 col-md-4">
                                                <div class="row pl-3 align-items-center">
                                                    <div class="col-12 line-height-16px">
                                                    <span class="alt-font text-gray text-small font-weight-300">
                                                    @if(($pending_upgrade_downline->status == 2 || $pending_upgrade_downline->status == 3))
                                                            {{ $pending_upgrade_downline->user->roles[0]->name }}
                                                        @else
                                                            @if($pending_upgrade_downline->to_wallet == 1)
                                                                {{ "VIP" }} -> {{ $pending_upgrade_downline->user->roles[0]->name }}
                                                            @else
                                                                {{ $pending_upgrade_downline->user->roles[0]->name }} -> {{ "Manager" }}
                                                            @endif

                                                        @endif

                                                    </span>
                                                    </div>
                                                    <div class="col-12 line-height-16px">
                                                        <span
                                                            class="alt-font text-gray text-small font-weight-300">{{ \App\Models\UserUpgrade::STATUS_SELECT[$pending_upgrade_downline->status] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 d-block d-md-none">
                                            </div>
                                            <div class="col-9 col-md-3 text-md-right">
                                                <div class="row pl-3 justify-content-md-end justify-content-start">
                                                    <div class="line-height-16px">
                                                    <span class="alt-font text-gray text-small font-weight-300 text-uppercase">
                                                        @if(($pending_upgrade_downline->status == 2 || $pending_upgrade_downline->status == 3))
                                                            <div
                                                                class="text-extra-small w-100 alt-font font-weight-500  {{($pending_upgrade_downline->status == 2) ?"text-success" : "text-red" }}  text-uppercase mr-1"
                                                                style="padding: 3px 10px;">

                                                                {{($pending_upgrade_downline->status == 2) ? __('user-portal.completed'): __('global.reject') }}<br>
                                                                <span class="text-medium-gray"> {{  $pending_upgrade_downline->updated_at}} </span>
                                                            </div>
                                                        @else
                                                            <a class="text-extra-small w-100 alt-font font-weight-500 btn btn-very-small btn-shadow bg-dark-gray text-uppercase text-white mr-1"
                                                               style="padding: 3px 10px;"
                                                               href="{{ route('user.view-upgrade-account', ['id' => $pending_upgrade_downline->id]) }}">
                                                            {{ __('user-portal.view') }}
                                                        </a>

                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        @endif
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom margin-30px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">{{ __('user-portal.merchant') }}</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">
                                    </div>
                                </div>
                            </div>
                            <hr style="margin: 0px">
                            <div class="col-12 padding-40px-lr" style="margin-top: -7px;">
                                <table class=" table  table-hover ajaxTable datatable datatable-User">
                                    <thead>
                                        <tr>
                                            <th >
                                                {{ trans('cruds.user.fields.id') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.user.fields.name') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.user.fields.roles') }}
                                            </th>
                                            <th>
                                                {{ "Code" }}
                                            </th>
                                            <th>
{{--                                                {{ trans('user-portal.monthly_sales') }}--}}
                                                 Monthly<br>Sales
                                            </th>
{{--                                            <th>--}}
{{--                                                {{ trans('user-portal.total_sales') }}--}}
{{--                                                Total<br>Sales--}}
{{--                                            </th>--}}
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('js')
    <!-- Required datatable js -->
    <script src="{{ asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/pages/datatables.init.js')}}"></script>
    <script>
        $(function () {
            let dtOverrideGlobals = {
                processing: true,
                serverSide: true,
                retrieve: true,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false,
                aaSorting: [],
                ajax: {
                    url: "{{ route('user.downline') }}",
                    data: function (d) {
                        d.name = $('#name').val();
                        // d.email = $('#email').val();
                        d.role = $('#role').val();
                        // d.identity_no = $('#identity_no').val();
                        // d.gender = $('#gender').val();
                        // d.status = $('#status').val();
                        // d.user_type = $('#user_type').val();
                    },
                },
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {
                        data : "name",
                        width: "30%",
                        render: function ( data, type, row, meta ) {
                            return '<div class="flex">' + row.profile_photo + '<div class="pl-2" ><div >' + data + '</div><div class="text-medium-gray">' + row.status + '</div></div></div>';
                        },sortable: false, searchable: false
                    },
                    // { data: 'profile_photo', name: 'profile_photo', sortable: false, searchable: false },
                    {data: 'role', name: 'role', sortable: false, searchable: false},
                    {data: 'personal_code', name: 'personal_code', sortable: false, searchable: false},

                    {data: 'monthly_sales', name: 'monthly_sales',sortable: false, searchable: false},
                    // {data: 'total_sales', name: 'total_sales',sortable: false, searchable: false},
                    {{--{data: 'email', name: 'email'},--}}
                    {{--{data: 'user_type', name: 'user_type'},--}}
                    {{--{data: 'status', name: 'status'},--}}
                    {{--{data: 'profile_photo', name: 'profile_photo', sortable: false, searchable: false},--}}
                    {{--{data: 'actions', name: '{{ trans('global.actions') }}'}--}}
                ],
                orderCellsTop: true,
                order: [[0, 'desc']],
                pageLength: 10,
            };
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('.datatable-User tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
{{--                window.location.href = "{{ route('user.downline-details', []) }}"--}}
                // alert( 'You clicked on '+data.id+'\'s row' );

                var url = '{{ route('user.downline-details', [ 'id' => ':id']) }}';
                url = url.replace(':id', data.id);
                window.location.href = url;
            } );

        });

    </script>
@endsection
