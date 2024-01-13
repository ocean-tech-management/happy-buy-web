<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTotalRevenueRequest;
use App\Http\Requests\StoreTotalRevenueRequest;
use App\Http\Requests\UpdateTotalRevenueRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
class TotalRevenueController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('total_revenue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        return view('admin.totalRevenues.index', compact('start', 'end'));
    }

    public function create()
    {
        abort_if(Gate::denies('total_revenue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalRevenues.create');
    }

    public function store(StoreTotalRevenueRequest $request)
    {
        $totalRevenue = TotalRevenue::create($request->all());

        return redirect()->route('admin.total-revenues.index');
    }

    public function edit(TotalRevenue $totalRevenue)
    {
        abort_if(Gate::denies('total_revenue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalRevenues.edit', compact('totalRevenue'));
    }

    public function update(UpdateTotalRevenueRequest $request, TotalRevenue $totalRevenue)
    {
        $totalRevenue->update($request->all());

        return redirect()->route('admin.total-revenues.index');
    }

    public function show(TotalRevenue $totalRevenue)
    {
        abort_if(Gate::denies('total_revenue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.totalRevenues.show', compact('totalRevenue'));
    }

    public function destroy(TotalRevenue $totalRevenue)
    {
        abort_if(Gate::denies('total_revenue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalRevenue->delete();

        return back();
    }

    public function massDestroy(MassDestroyTotalRevenueRequest $request)
    {
        TotalRevenue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
