<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTotalRedemptionRequest;
use App\Http\Requests\StoreTotalRedemptionRequest;
use App\Http\Requests\UpdateTotalRedemptionRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
use Gate;
use DB;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class TotalRedemptionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('total_redemption_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $start = Carbon::today()->subDays(9)->toDateString();
        $end = Carbon::today()->endOfDay()->toDateTimeString();
        
        if($request->has('start_date')){
            $start = $request->start_date;
            $end = $request->end_date.' 23:59:59';
        };    

        $date_arr = array();
        $period = new DatePeriod(new DateTime($start), new DateInterval('P1D'), new DateTime($end));
        foreach ($period as $key => $value) {
            $Store = $value->format('Y-m-d');    
            $date_arr[] = $Store;  
        };
        if(!($request->has('start_date'))) {$end = substr($end,0,10);};

        $sum_arr = array();
        for($i=0; $i<count($date_arr); $i++){
            $sum = Order::whereStatus(5)->whereDate('completed_at', '=', $date_arr[$i])->sum('sub_total');     
            if($sum == null) { $total = 0;} 
            else{ $total = $sum;};
            array_push($sum_arr,$total);
        };

        $recent_redeem = Order::when($request['start_date'], function($query) use ($start, $end){
            return $query->whereBetween('completed_at', [$start, $end]);
        }, function($query) use ($end){
            return $query->whereDate('completed_at', $end);
        })->whereStatus(5)->orderByDesc('completed_at')->limit(10)->get();

        $donut = Order::selectRaw('status, COUNT(*) AS total')
                ->when($request['start_date'], function($query) use ($start, $end){
                    return $query->whereBetween('created_at', [$start, $end]);
                }, function($query) use ($end){
                    return $query->whereDate('created_at', $end);
                })->groupby('status')->get();

        $status_count = array_column($donut->toArray(), 'total');
        $status = array_column($donut->toArray(), 'status');

        $order = Order::when($request['start_date'], function($query) use ($start, $end){
                    return $query->whereBetween('orders.completed_at', [$start, $end]);
                }, function($query) use ($end){
                    return $query->whereDate('orders.completed_at', $end);
                })->where('orders.status',5)
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->selectRaw("order_items.product_id,order_items.product_name_en, SUM(order_items.product_quantity) as total")
                ->groupBy('product_id')->orderByDesc('total')->limit(10)->get();
						        
        return view('admin.totalRedemptions.index', compact('start', 'end','recent_redeem', 'status_count', 'status', 'date_arr', 'sum_arr', 'order'));
    }

    public function create()
    {
        abort_if(Gate::denies('total_redemption_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalRedemptions.create');
    }

    public function store(StoreTotalRedemptionRequest $request)
    {
        $totalRedemption = TotalRedemption::create($request->all());

        return redirect()->route('admin.total-redemptions.index');
    }

    public function edit(TotalRedemption $totalRedemption)
    {
        abort_if(Gate::denies('total_redemption_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalRedemptions.edit', compact('totalRedemption'));
    }

    public function update(UpdateTotalRedemptionRequest $request, TotalRedemption $totalRedemption)
    {
        $totalRedemption->update($request->all());

        return redirect()->route('admin.total-redemptions.index');
    }

    public function show(TotalRedemption $totalRedemption)
    {
        abort_if(Gate::denies('total_redemption_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalRedemptions.show', compact('totalRedemption'));
    }

    public function destroy(TotalRedemption $totalRedemption)
    {
        abort_if(Gate::denies('total_redemption_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalRedemption->delete();

        return back();
    }

    public function massDestroy(MassDestroyTotalRedemptionRequest $request)
    {
        TotalRedemption::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getDate(Request $request)
    {
        $range = $request->input('daterange');
        $start = Carbon::createFromFormat('m/d/Y', substr($range,0,10))->format('Y-m-d');
        $end = Carbon::createFromFormat('m/d/Y', substr($range,13,23))->format('Y-m-d');
        $request->request->add(['start_date' => $start, 'end_date' => $end ]); 

        return $this->index($request);
    }
}
