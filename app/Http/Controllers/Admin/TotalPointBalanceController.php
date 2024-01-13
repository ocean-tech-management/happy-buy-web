<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTotalPointBalanceRequest;
use App\Http\Requests\StoreTotalPointBalanceRequest;
use App\Http\Requests\UpdateTotalPointBalanceRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\TransactionPointPurchase;
use Gate;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use Doctrine\DBAL\Types\Type;

class TotalPointBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('total_point_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            $sum = TransactionPointPurchase::whereStatus(3)->whereDate('payment_verified_at', '=', $date_arr[$i])->sum('price');     
            if($sum == null) { $total = 0;} 
            else{ $total = $sum;};
            array_push($sum_arr,$total);
        };

        $recent_purchase = TransactionPointPurchase::when($request['start_date'], function($query) use ($start, $end){
                                return $query->whereBetween('created_at', [$start, $end]);
                            }, function($query) use ($end){
                                return $query->whereDate('created_at', $end);
                            })->whereStatus(3)->orderByDesc('payment_verified_at')->limit(10)->get();

        $donut = TransactionPointPurchase::selectRaw('status, COUNT(*) AS total')
                ->when($request['start_date'], function($query) use ($start, $end){
                    return $query->whereBetween('created_at', [$start, $end]);
                }, function($query) use ($end){
                    return $query->whereDate('created_at', $end);
                })->groupby('status')->get();   
               
        $status_count = array_column($donut->toArray(), 'total');
        $status = array_column($donut->toArray(), 'status');     

        $purchase = TransactionPointPurchase::when($request['start_date'], function($query) use ($start, $end){
                        return $query->whereBetween('transaction_point_purchases.payment_verified_at', [$start, $end]);
                    }, function($query) use ($end){
                        return $query->whereDate('transaction_point_purchases.payment_verified_at', $end);
                    })->where('transaction_point_purchases.status',3)
                    ->join('point_packages', 'point_packages.id', '=', 'transaction_point_purchases.point_package_id')
                    ->selectRaw("point_packages.id, point_packages.name_en , COUNT(transaction_point_purchases.price) as total")
                    ->groupBy('point_packages.id')->orderByDesc('total')->get();           

        return view('admin.totalPointBalances.index', compact('start','end','recent_purchase', 'status_count', 'status', 'date_arr', 'sum_arr', 'purchase'));
    }

    public function create()
    {
        abort_if(Gate::denies('total_point_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalPointBalances.create');
    }

    public function store(StoreTotalPointBalanceRequest $request)
    {
        $totalPointBalance = TotalPointBalance::create($request->all());

        return redirect()->route('admin.total-point-balances.index');
    }

    public function edit(TotalPointBalance $totalPointBalance)
    {
        abort_if(Gate::denies('total_point_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalPointBalances.edit', compact('totalPointBalance'));
    }

    public function update(UpdateTotalPointBalanceRequest $request, TotalPointBalance $totalPointBalance)
    {
        $totalPointBalance->update($request->all());

        return redirect()->route('admin.total-point-balances.index');
    }

    public function show(TotalPointBalance $totalPointBalance)
    {
        abort_if(Gate::denies('total_point_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalPointBalances.show', compact('totalPointBalance'));
    }

    public function destroy(TotalPointBalance $totalPointBalance)
    {
        abort_if(Gate::denies('total_point_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalPointBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyTotalPointBalanceRequest $request)
    {
        TotalPointBalance::whereIn('id', request('ids'))->delete();

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
