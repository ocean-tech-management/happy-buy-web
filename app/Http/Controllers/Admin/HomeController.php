<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocumentNumberLog;
use App\Models\DocumentReceiptLog;
use App\Models\Order;
use App\Models\ProductQuantity;
use DB;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(Request $request)
    {
//        abort_if(Gate::denies('total_redemption_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $start = Carbon::today()->startOfMonth()->toDateTimeString();
        $end = Carbon::today()->endOfDay()->toDateTimeString();

        if($request->has('start_date')){
            $start = $request->start_date. ' 00:00:00';
            $end = $request->end_date.' 23:59:59';
        }else{
            $request['start_date'] = $start;
        }

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
            ->where('order_items.product_variant_id','!=', null)
            ->selectRaw("order_items.product_id,order_items.product_variant_id,order_items.product_name_en, order_items.product_size, order_items.product_color, SUM(order_items.product_quantity) as total")
            ->groupBy('order_items.product_variant_id')->orderByDesc('total')->get();

        foreach ($order as $item){

            $stock_balance = ProductQuantity::where('product_variant_id', $item->product_variant_id)->whereIn('status',[2,3,4,5,7])->where('created_at','<=', $end)->count();
            $item->stock_balance = $stock_balance;

        }


        return view('home', compact('start', 'end','recent_redeem', 'status_count', 'status', 'date_arr', 'sum_arr', 'order'));
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
