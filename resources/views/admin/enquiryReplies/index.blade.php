@extends('layouts.admin')
@section('content')
@can('enquiry_reply_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.enquiry-replies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.enquiryReply.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.enquiryReply.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">        
        <div class="row px-5 mb-1 d-flex mt-5">                        

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="enquiry"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.enquiryReply.fields.enquiry')])}}">
            </div>   

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="admin"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.enquiryReply.fields.admin')])}}">
            </div>   

            <div class="flex-grow-1 input-div col-lg-3">
                <input type="text" class="form-control datatable-input" id="message"
                placeholder ="{{trans('global.enter_for', ['value'=>trans('cruds.enquiryReply.fields.message')])}}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EnquiryReply">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.enquiryReply.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiryReply.fields.enquiry') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiryReply.fields.admin') }}
                    </th>
                    <th>
                        {{ trans('cruds.enquiryReply.fields.message') }}
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
@can('enquiry_reply_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.enquiry-replies.massDestroy') }}",
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
    buttons: dtButtons,
    // searching:false;
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
            url: "{{ route('admin.enquiry-replies.index') }}",
            data: function (d) {                
                d.enquiry = $('#enquiry').val();    
                d.message = $('#message').val();                                     
                d.admin = $('#admin').val();               
            },
        },
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'enquiry_message', name: 'enquiry.message' },
{ data: 'admin_name', name: 'admin.name' },
{ data: 'message', name: 'message' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-EnquiryReply').DataTable(dtOverrideGlobals);
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
      $('#enquiry').val(null);  
      $('#message').val(null);   
      $('#admin').val(null);       
      table.ajax.reload()
  });
  
});

</script>
@endsection