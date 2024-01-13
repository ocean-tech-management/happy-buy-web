<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentReceiptLog;
use App\Models\PointBalance;
use App\Models\PointPackage;
use App\Models\Role;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\UserEntry;
use App\Models\UserUpgrade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class MemberController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
//            if ($request->is('admin/merchants')) {
//                $request->request->add(['role' => 'Merchant']);
//            }else{
//                $request->request->add(['role' => 'Agent']);
//            }

            $query = User::with(['bank_list', 'country', 'upline_user', 'upline_user_1', 'roles'])->search($request)->select(sprintf('%s.*', (new User())->table))->where('direct_upline_id',Auth::user()->id);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $crudRoutePart = 'users';

                return view('user.partials.datatablesActions_User', compact(
                    'viewGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('profile_photo', function ($row) {
                if ($photo = $row->profile_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="rounded-circle" src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                } else {
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="rounded-circle" src="%s" width="50px" height="50px"></a>',
                        asset('landing/images/default_profile.png'),
                        asset('landing/images/default_profile.png')
                    );
                }
            });

            $table->editColumn('role', function ($row) {
                $user = User::find($row->id);
                Log::info($user->roles[0]->name);
                return $user->roles[0] ? str_replace('Merchant-', '', str_replace('Agent-', '', $user->roles[0]->name)) : '';
            });

            $table->editColumn('personal_code', function ($row) {
                return $row->personal_code ? $row->personal_code : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status == 1 ?  'Verified' : "Not Verify" ;
            });


            $table->editColumn('monthly_sales', function ($row) {
                return getSelfMonthlyTopupAmount($row->id);
            });

//            $table->editColumn('total_sales', function ($row) {
//                return "1500";
//            });


            $table->rawColumns(['actions', 'placeholder', 'bank_list', 'country', 'upline_user', 'upline_user_1', 'profile_photo', 'ssm_photo', 'ic_photo', 'first_payment_receipt_photo', 'roles', 'status']);

            return $table->make(true);
        }

        if ($request->is('user/downline/index')) {
            $request_upgrades = TransactionAgentTopUp::where('merchant_id', Auth::user()->id)->where('type', 2)->get();
            return view('user.downline2', compact('request_upgrades'));
        }

    }

    public function downlineDetails($id){
        $this_dl = User::find($id);
        $first_layer_dl = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->get();
//        $first_layer_dl_ids = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->pluck('id', 'name');
        $first_layer_dl_ids = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->pluck('id');

//        $second_layer_dl_ids = User::whereIn('direct_upline_id', $first_layer_dl_ids)->pluck('id', 'name');
        $second_layer_dl_ids = User::whereIn('direct_upline_id', $first_layer_dl_ids)->pluck('id');
//        $third_layer_dl_ids = User::whereIn('direct_upline_id', $second_layer_dl_ids)->pluck('id', 'name');
        $third_layer_dl_ids = User::whereIn('direct_upline_id', $second_layer_dl_ids)->pluck('id');


        $is_my_downline = false;
        if (in_array($id, $first_layer_dl_ids->toArray())) {
            $is_my_downline = true;
        } else if (in_array($id, $second_layer_dl_ids->toArray())) {
            $is_my_downline = true;
        } else if (in_array($id, $third_layer_dl_ids->toArray())) {
            $is_my_downline = true;
        } else {
            abort(404);
        }

        if ( $is_my_downline ){
            $this_dl = User::find($id);

            $downlines = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->get();

            return view('user.downline-details', compact('this_dl', 'downlines'));
        }

    }

    public function downlineDetailsDownline(Request $request, $id){

        if ($request->ajax()) {


            $query = User::with(['bank_list', 'country', 'upline_user', 'upline_user_1', 'roles'])->search($request)->select(sprintf('%s.*', (new User())->table))->where('direct_upline_id',$id );
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $crudRoutePart = 'users';

                return view('user.partials.datatablesActions_User', compact(
                    'viewGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('profile_photo', function ($row) {
                if ($photo = $row->profile_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="rounded-circle" src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                } else {
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="rounded-circle" src="%s" width="50px" height="50px"></a>',
                        asset('landing/images/default_profile.png'),
                        asset('landing/images/default_profile.png')
                    );
                }
            });

            $table->editColumn('role', function ($row) {
                $user = User::find($row->id);
                Log::info($user->roles[0]->name);
                return $user->roles[0] ? str_replace('Merchant-', '', str_replace('Agent-', '', $user->roles[0]->name)) : '';
            });

            $table->editColumn('personal_code', function ($row) {
                return $row->personal_code ? $row->personal_code : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status == 1 ?  'Verified' : "Not Verify" ;
            });


            $table->editColumn('monthly_sales', function ($row) {
                return getSelfMonthlyTopupAmount($row->id);
            });

            $table->editColumn('total_sales', function ($row) {
                return "1500";
            });


            $table->rawColumns(['actions', 'placeholder', 'bank_list', 'country', 'upline_user', 'upline_user_1', 'profile_photo', 'ssm_photo', 'ic_photo', 'first_payment_receipt_photo', 'roles', 'status']);

            return $table->make(true);
        }
    }

    public function downline()
    {
        $downlines = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->get();

        $request_upgrades = TransactionAgentTopUp::where('merchant_id', Auth::user()->id)->where('type', 2)->get();

        return view('user.downline', compact('downlines', 'request_upgrades'));
    }

    public function downlineDownlines($id)
    {
        //check if this user under this user 3 line
        $this_dl = User::find($id);
        $first_layer_dl = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->get();
        $first_layer_dl_ids = User::where('direct_upline_id', Auth::user()->id)->where('id', '!=', Auth::user()->id)->pluck('id', 'name');

        $second_layer_dl_ids = User::whereIn('direct_upline_id', $first_layer_dl_ids)->pluck('id', 'name');
        $third_layer_dl_ids = User::whereIn('direct_upline_id', $second_layer_dl_ids)->pluck('id', 'name');

        $is_my_downline = false;
        if (isset($first_layer_dl_ids[$this_dl->name])) {
            if ($first_layer_dl_ids[$this_dl->name] == $id) {
                $is_my_downline = true;
            }

        } else if (isset($second_layer_dl_ids[$this_dl->name])) {
            if ($second_layer_dl_ids[$this_dl->name] == $id) {
                $is_my_downline = true;
            }

        } else if (isset($third_layer_dl_ids[$this_dl->name])) {
            if ($third_layer_dl_ids[$this_dl->name] == $id) {
                $is_my_downline = true;
            }
        } else {
            abort(404);
        }

        if ( $is_my_downline ){
            $downlines =  User::where('direct_upline_id', $id)->where('id', '!=', $id)->get();
            $request_upgrades = [];
            return view('user.downline', compact('downlines', 'request_upgrades'));
        }
    }

    public function viewUpgradeAccount($id)
    {
        $request_upgrade = UserUpgrade::find($id);

        return view('user.upgrade-account-view', compact('request_upgrade'));
    }


    public function depositPrintReceipt($id)
    {
        $invoice = UserEntry::find($id);
        if($invoice->user_id != Auth::user()->id){
            abort(404);
        }
        $invoice->name ="Deposit Receipt";
        $invoice->footnote ="Foot Note";

        $invoice_logs = DocumentReceiptLog::where('name', $invoice->new_receipt_number)->first();
        if($invoice_logs) {
            $from_user = User::where('id', $invoice_logs->from_user_id)->first();
            if(!in_array($from_user->id, [1,2,3], true)) {
                $invoice->from_name = $from_user->name;
                $invoice->from_email = $from_user->email;
                $invoice->from_phone = $from_user->phone;
            }
        }

        $pdf = PDF::loadView('user.print.deposit-receipt', compact('invoice'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($invoice->name.".pdf");
    }

    public function joinFeePrintReceipt()
    {
        $invoice = UserEntry::whereUserId(Auth::user()->id)->where('fee', '!=', '0')->orderBy('created_at', 'desc')->first();
        if($invoice->user_id != Auth::user()->id){
            abort(404);
        }
        $invoice->name ="Joining Fee Receipt";
        $invoice->footnote ="Foot Note";

        $invoice_logs = DocumentInvoiceLog::where('name', $invoice->new_invoice_number)->first();
        if($invoice_logs) {
            $from_user = User::where('id', $invoice_logs->from_user_id)->first();
            if(!in_array($from_user->id, [1,2,3], true)) {
                $invoice->from_name = $from_user->name;
                $invoice->from_email = $from_user->email;
                $invoice->from_phone = $from_user->phone;
            }
        }

        $pdf = PDF::loadView('user.print.joinfee-invoice', compact('invoice'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($invoice->name.".pdf");
    }
}
