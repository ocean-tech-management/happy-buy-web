@extends('layouts.admin')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="row" style='margin-bottom: 1rem;'>
    <form id="form" action="{{ route('admin.total-point-balances.getdate') }}" method="POST" style="display: inline-block;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
        <div class="col-lg-12" style=" display: flex; justify-content: flex-end">
            <i class="fa fa-calendar" style="position:absolute; margin:11px 220px"></i>&nbsp;
            <input id="daterange" name="daterange" style="cursor: pointer; padding: 7px 10px 5px 30px; border:1px solid #ccc;">                
            <button type="submit" class="btn btn-secondary btn-secondary--icon tw-rounded" id='go'><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>

<div class="card">
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Daily Purchases</h4>
                    <div id="dailyPurchase" class="apex-charts" dir="ltr"></div>    
                                      
                </div>
            </div><!--end card-->
        </div>
        <!-- end col -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Status</h4>
                        <div id="donut" class="apex-charts"  dir="ltr">
                        </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Recent Purchases</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.transaction') }}</th>
                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.user') }}</th>
                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.point_package') }}</th>
                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.price') }}</th>
                                    <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.payment_verified_at') }}</th>
                                </tr>
                            </thead>
                            @php $i = 1; @endphp
                            @foreach ($recent_purchase as $item)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$item->transaction}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->point_package->name_en}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->payment_verified_at}}</td>
                                    <?php $i++; ?>                                                   
                                </tr>
                            @endforeach                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- end col -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Top Selling Packages</h4>  
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('cruds.transactionPointPurchase.fields.point_package') }}</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        @php $i = 1; @endphp
                        @foreach ($purchase as $item)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$item->name_en}}</td>
                                <td>{{$item->total}}</td>   
                                <?php $i++; ?>   
                            </tr>
                        @endforeach                            
                    </table>
                </div>           
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

</div>
@endsection
@section('scripts')
@parent
    <script src="{{asset('admin_assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        
    <script> 
        // function for datepicker
        $(function() {
            var start = {!! json_encode($start) !!};
            var end = {!! json_encode($end) !!};
            start = moment(start);
            end = moment(end);

            function cb(start, end) {
                $('#daterange').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            };

            $('#daterange').daterangepicker({
                startDate: start,
                endDate: end,
                maxDate:moment(),
                ranges: {
                'Last 30 Days':[moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "alwaysShowCalendars": true,
            }, cb);

            cb(start, end);             
        });       
        
        var status = {!! json_encode($status, JSON_HEX_TAG) !!};  
        var status_arr=[];
        for (let i=0; i<status.length; i++){
            if(status[i]==1){
                status_arr.push('Failed');
            }else if(status[i]==2){
                status_arr.push('Success Paid');
            }else if(status[i]==3){
                status_arr.push('Complete Topup');
            }
        }
        
        //area chart -- daily purchases
        var options={
            chart:{height:350,type:"area",toolbar:{show:!1}},
            dataLabels:{enabled:false},
            stroke:{curve:"smooth",width:3},
            series:[{
                name:"daily purchases",
                data:{!! json_encode($sum_arr, JSON_HEX_TAG) !!}}],
            colors:["#556ee6"],
            xaxis:{
                type:"datetime",                     
                categories:{!! json_encode($date_arr, JSON_HEX_TAG) !!},
                tickAmount: 10},
            yaxis: {opposite: true},
            legend: {horizontalAlign: 'left'},
            grid:{borderColor:"#f1f1f1"},
            tooltip:{x:{format:"dd MMM yyyy"}},
            noData: {
                text: 'No completed purchases in last ten days!',
                align:'center',verticalAlign:'middle',offsetX:0,offsetY:0,}
            };
        var chart = new ApexCharts(document.querySelector("#dailyPurchase"), options);
        chart.render();
            
        // donut chart -- status
        options = {
            chart:{height:350,type:"donut"},
            series:{!! json_encode($status_count, JSON_HEX_TAG) !!},
            labels:status_arr,
            colors:["#f46a6a","#34c38f","#556ee6","#50a5f1","#f1b44c"],
            legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0},
            responsive:[{breakpoint:600,options:{chart:{height:240},legend:{show:!1}}}],
            noData: {
                text: 'No order has been processed today!',
                align:'center',verticalAlign:'middle',offsetX:0,offsetY:0,}
            };
        chart = new ApexCharts(document.querySelector("#donut"),options).render();
        
    </script>   

@endsection