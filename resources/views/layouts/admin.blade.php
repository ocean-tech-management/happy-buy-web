<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/erya_logo.png')}}">
{{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />--}}
{{--    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />--}}

{{--    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />--}}

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />--}}
{{--    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />--}}

    <link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin_assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin_assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('admin_assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <link href="{{ asset('admin_assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <link href="{{ asset('admin_assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <link href="{{ asset('admin_assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link rel="stylesheet" href="{{ asset('admin_assets/libs/@chenfengyuan/datepicker/datepicker.min.css')}}">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

    <!-- Sweet Alert-->
    <link href="{{ asset('admin_assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Admin Custom Css-->
    <link href="{{ asset('admin_assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .form-group{
            margin-bottom: 20px;
        }
        .required:after {
            content:" *";
            color: red;
        }
        .datatable-input:focus{
	        border: 1px solid #4458b8;
        }
        .input-div{
            margin-bottom:0.75rem !important;
            flex-basis: 33%;
            max-width: 33%;
        }

    </style>
    @livewireStyles

    @yield('styles')
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('partials.header')
        @include('partials.menu')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © {{ trans('panel.site_title') }}.
                        </div>
{{--                        <div class="col-sm-6">--}}
{{--                            <div class="text-sm-end d-none d-sm-block">--}}
{{--                                Design & Develop by Themesbrand--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <form id="logoutform" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
{{--    <div class="c-wrapper">--}}
{{--        <header class="c-header c-header-fixed px-3">--}}
{{--            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">--}}
{{--                <i class="fas fa-fw fa-bars"></i>--}}
{{--            </button>--}}

{{--            <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>--}}

{{--            <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">--}}
{{--                <i class="fas fa-fw fa-bars"></i>--}}
{{--            </button>--}}

{{--            <ul class="c-header-nav ml-auto">--}}
{{--                @if(count(config('panel.available_languages', [])) > 1)--}}
{{--                    <li class="c-header-nav-item dropdown d-md-down-none">--}}
{{--                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                            {{ strtoupper(app()->getLocale()) }}--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            @foreach(config('panel.available_languages') as $langLocale => $langName)--}}
{{--                                <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endif--}}


{{--            </ul>--}}
{{--        </header>--}}

{{--        <div class="c-body">--}}
{{--            <main class="c-main">--}}


{{--                <div class="container-fluid">--}}
{{--                    @if(session('message'))--}}
{{--                        <div class="row mb-2">--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if($errors->count() > 0)--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul class="list-unstyled">--}}
{{--                                @foreach($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @yield('content')--}}

{{--                </div>--}}


{{--            </main>--}}

{{--        </div>--}}
{{--    </div>--}}


{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>--}}
{{--    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>--}}
{{--    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
{{--    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>--}}
{{--    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>--}}


{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>--}}
    <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js')}}"></script>

    <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('admin_assets/libs/apexcharts/apexcharts.min.js')}}"></script>

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

    <!-- Sweet Alerts js -->
    <script src="{{ asset('admin_assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Magnific Popup-->
    <script src="{{ asset('admin_assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- lightbox init js-->
    <script src="{{ asset('admin_assets/js/pages/lightbox.init.js')}}"></script>

    <!-- dashboard init -->
    <script src="{{ asset('admin_assets/js/pages/datatables.init.js')}}"></script>
{{--    <script src="{{ asset('admin_assets/js/pages/dashboard.init.js')}}"></script>--}}

    <script src="{{ asset('admin_assets/libs/select2/js/select2.min.js')}}"></script>
{{--    <script src="{{ asset('admin_assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>--}}
   <script src="{{ asset('admin_assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
   <script src="{{ asset('admin_assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
   <script src="{{ asset('admin_assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
{{--    <script src="{{ asset('admin_assets/libs/ckeditor/ckeditor.js') }}"></script>--}}
   <script src="{{ asset('admin_assets/libs/@chenfengyuan/datepicker/datepicker.min.js')}}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    <!-- form advanced init -->
{{--    <script src="{{ asset('admin_assets/js/pages/form-editor.init.js')}}"></script>--}}
    <script src="{{ asset('admin_assets/js/pages/form-advanced.init.js')}}"></script>
    <!-- init js -->
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>

    <!-- App js -->
    <script src="{{ asset('admin_assets/js/app.js')}}"></script>
    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
        'zh-Hans': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Chinese.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        // orderable: false,
        // className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 10,
    bAutoWidth: false,
    lengthChange: false,
    dom: 'lBfrtip<"actions">',
    buttons: [
      // {
      //   extend: 'selectAll',
      //   className: 'btn-primary',
      //   text: selectAllButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   },
      //   action: function(e, dt) {
      //     e.preventDefault()
      //     dt.rows().deselect();
      //     dt.rows({ search: 'applied' }).select();
      //   }
      // },
      // {
      //   extend: 'selectNone',
      //   className: 'btn-primary',
      //   text: selectNoneButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'copy',
      //   className: 'btn-default',
      //   text: copyButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'csv',
      //   className: 'btn-default',
      //   text: csvButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'excel',
      //   className: 'btn-default',
      //   text: excelButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'pdf',
      //   className: 'btn-default',
      //   text: pdfButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'print',
      //   className: 'btn-default',
      //   text: printButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'colvis',
      //   className: 'btn-default',
      //   text: colvisButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
{{--    <script>--}}
{{--        var allEditors = document.querySelectorAll('.ckeditor');--}}

{{--        for (var i = 0; i < allEditors.length; ++i) {--}}

{{--            ClassicEditor--}}
{{--                .create( allEditors[i], {--}}
{{--                    toolbar: {--}}
{{--                        items: [--}}
{{--                            'heading',--}}
{{--                            '|',--}}
{{--                            'bold',--}}
{{--                            'italic',--}}
{{--                            'link',--}}
{{--                            'bulletedList',--}}
{{--                            'numberedList',--}}
{{--                            '|',--}}
{{--                            'fontColor',--}}
{{--                            'fontBackgroundColor',--}}
{{--                            'fontFamily',--}}
{{--                            'fontSize',--}}
{{--                            'highlight',--}}
{{--                            '|',--}}
{{--                            'outdent',--}}
{{--                            'indent',--}}
{{--                            '|',--}}
{{--                            'ckfinder',--}}
{{--                            'imageUpload',--}}
{{--                            'blockQuote',--}}
{{--                            'insertTable',--}}
{{--                            'mediaEmbed',--}}
{{--                            'undo',--}}
{{--                            'redo'--}}
{{--                        ]--}}
{{--                    },--}}
{{--                    language: 'en',--}}
{{--                    image: {--}}
{{--                        toolbar: [--}}
{{--                            'imageTextAlternative',--}}
{{--                            'imageStyle:inline',--}}
{{--                            'imageStyle:block',--}}
{{--                            'imageStyle:side'--}}
{{--                        ]--}}
{{--                    },--}}
{{--                    table: {--}}
{{--                        contentToolbar: [--}}
{{--                            'tableColumn',--}}
{{--                            'tableRow',--}}
{{--                            'mergeTableCells'--}}
{{--                        ]--}}
{{--                    },--}}
{{--                    licenseKey: '',--}}
{{--                } )--}}
{{--                // .then( editor => {--}}
{{--                //     window.editor = editor;--}}
{{--                // } )--}}
{{--                .catch( error => {--}}
{{--                    console.error( 'Oops, something went wrong!' );--}}
{{--                    console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );--}}
{{--                    console.warn( 'Build id: fhwq1psboncn-jxvn22q4evyq' );--}}
{{--                    console.error( error );--}}
{{--                } );--}}
{{--        }--}}
{{--    </script>--}}
    @livewireScripts
    @yield('scripts')
</body>

</html>
