<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function view(Request $request)
    {
        $year = date('Y');
        $month = date('m');
        if ($request->year) {
            $date = strtotime($request->year);
            $year = date('Y', $date);
            $month = date('m', $date);
        }
        $point_histories = \App\Models\PointBalance::where('user_id', Auth::user()->id)
            ->where(function ($q) {
                $q->where('remark', 'like', '%' . 'purchase order' . '%')
                    ->orWhere('remark', 'like', '%' . 'Point Transfer to donwline' . '%')
                    ->orWhere('remark', 'like', '%' . 'User Upgrade TopUp' . '%')
                    ->orWhere('remark', 'like', '%' . 'Point convert' . '%');
            })->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)->get();

        $last_month = date('Y-m-d',strtotime('-1 second',strtotime($month.'/01/'.$year)));
        $last_month_balance =  \App\Models\PointBalance::where('user_id', Auth::user()->id)
            ->where(function ($q) {
                $q->where('remark', 'like', '%' . 'purchase order' . '%')
                    ->orWhere('remark', 'like', '%' . 'Point Transfer to donwline' . '%')
                    ->orWhere('remark', 'like', '%' . 'User Upgrade TopUp' . '%')
                    ->orWhere('remark', 'like', '%' . 'Point convert' . '%');
            })->where('created_at', '<=', $last_month)->sum('amount');

        $latest_balance_date = date('Y-m-t',strtotime($month.'/01/'.$year));
        $latest_balance = \App\Models\PointBalance::where('user_id', Auth::user()->id)
            ->where(function ($q) {
                $q->where('remark', 'like', '%' . 'purchase order' . '%')
                    ->orWhere('remark', 'like', '%' . 'Point Transfer to donwline' . '%')
                    ->orWhere('remark', 'like', '%' . 'User Upgrade TopUp' . '%')
                    ->orWhere('remark', 'like', '%' . 'Point convert' . '%');
            })->where('created_at', '<=', $latest_balance_date)->sum('amount');

        $downlines = \App\Models\User::where('direct_upline_id', Auth::user()->id)->get()->pluck('id')->toArray();

        array_push($downlines, Auth::user()->id);
        $point_histories2 = \App\Models\PointBalance::whereIn('user_id', $downlines)
            ->where(function ($q) {
                $q->where('remark', 'like', '%' . 'purchase order ' . '%')
                    ->orWhere('remark', 'like', '%' . 'redeem order ' . '%')
                    ->orWhere('remark', 'like', '%' . 'refund order ' . '%');
            })->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)->get();

        $years = range(date('Y'), 2021);

        $start = strtotime('2021-09');
        $end = strtotime(date('Y-m'));
        $range = array(date('Y-m', $start) => date('Y-m', $start));
        while ($start <= strtotime('-1 month', $end)) {
            $start = strtotime('+1 month', $start);
            $yearMonth = date('Y-m', $start);
            $range[$yearMonth] = $yearMonth;
        }
        $range = array_reverse($range);

        return view('user.view-finance', compact('point_histories', 'point_histories2', 'range', 'last_month_balance', 'latest_balance'));
    }
}

//1, opening balance
//2. amount + balance
//3. top up receipt
//4. actual stock credit + invoice
//5. separate tab
