@extends('landing.app')
@section('css')

    <link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .table td, .table th {
            border-top: 0;
        }
    </style>
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
                        <div
                            class="bg-white shadow wow animate__fadeIn border-radius-5px  padding-20px-bottom margin-30px-bottom"
                            style="visibility: visible; animation-name: fadeIn;">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">Member Information</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">
                                    </div>
                                </div>
                            </div>
                            <hr style="margin: 0px">
                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="flex">
                                            <img class="rounded-circle h-70px w-70px {{ $this_dl->profile_photo == null ? "cover-img" : ""}} bg-dark-gold"
                                                 src="{{ $this_dl->profile_photo ? $this_dl->profile_photo->url : asset('landing/images/default_profile.png') }}"/>
                                            <div class="pl-2">
                                                <div>{{ $this_dl->name }} </div>
                                                <div class="text-medium-gray">{{ $this_dl->status == 1 ?  'Verified' : "Not Verify" }} </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div>
                                            <div class="text-medium-gray">
                                                {{ $this_dl->roles[0]->name }}
                                            </div>
                                            <div class="text-medium-gray">
                                                {{ $this_dl->personal_code }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div>
                                            <div class="text-medium-gray">
                                                {{ $this_dl->phone }}
                                            </div>
                                            <div class="text-medium-gray">
                                                {{ $this_dl->email }}
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <hr>

{{--                            <div class="col-12 padding-40px-lr">--}}
{{--                                <div class="row">--}}

{{--                                    <div class="col-4">--}}
{{--                                        Total Donline: 12123--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        Monthly Bonus: 12123--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        Total Bonus: 12123--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <hr>--}}

                            <div class="col-12 padding-1-half-rem-top padding-40px-lr">
                                <div class="row  align-items-center margin-10px-bottom">
                                    <div class="col-8">
                                        <span class="dark-gold alt-font ">{{ $this_dl->name }} 's Downline</span>
                                    </div>
                                    <div class="col-4 row justify-content-end">
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="col-12 padding-40px-lr" style="margin-top: -7px;">
                                <table class=" table  table-hover ajaxTable datatable datatable-User">
                                    <thead>
                                    <tr>
                                        <th>
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
{{--                                        <th>--}}
{{--                                            --}}{{--                                                {{ trans('user-portal.total_sales') }}--}}
{{--                                            Total<br>Sales--}}
{{--                                        </th>--}}
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
                    url: "{{ route('user.downline-dl', ['id' => $this_dl->id]) }}",
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
                        data: "name",
                        width: "30%",
                        render: function (data, type, row, meta) {
                            return '<div class="flex">' + row.profile_photo + '<div class="pl-2" ><div >' + data + '</div><div class="text-medium-gray">' + row.status + '</div></div></div>';
                        }, sortable: false, searchable: false
                    },
                    // { data: 'profile_photo', name: 'profile_photo', sortable: false, searchable: false },
                    {data: 'role', name: 'role', sortable: false, searchable: false},
                    {data: 'personal_code', name: 'personal_code', sortable: false, searchable: false},

                    {data: 'monthly_sales', name: 'monthly_sales', sortable: false, searchable: false},
                    // {data: 'total_sales', name: 'total_sales', sortable: false, searchable: false},
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
