<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserEntryRequest;
use App\Http\Requests\StoreUserEntryRequest;
use App\Http\Requests\UpdateUserEntryRequest;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentReceiptLog;
use App\Models\User;
use App\Models\UserEntry;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserEntryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_entry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserEntry::with(['user'])->where('user_type', '!=', 4)->search($request)->select(sprintf('%s.*', (new UserEntry())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_entry_show';
                $editGate = 'user_entry_edit';
                $deleteGate = 'user_entry_delete';
                $crudRoutePart = 'user-entries';

                return view('partials.datatablesActions_UserEntry', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user_type', function ($row) {
                return $row->user_type ? UserEntry::USER_TYPE_SELECT[$row->user_type] : '';
            });
            $table->editColumn('deposit', function ($row) {
                return $row->deposit ? $row->deposit : '';
            });
            $table->editColumn('fee', function ($row) {
                return $row->fee ? $row->fee : '';
            });
            $table->editColumn('top_up', function ($row) {
                return $row->top_up ? $row->top_up : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.userEntries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_entry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userEntries.create', compact('users'));
    }

    public function store(StoreUserEntryRequest $request)
    {
        $userEntry = UserEntry::create($request->all());

        return redirect()->route('admin.user-entries.index');
    }

    public function edit(UserEntry $userEntry)
    {
        abort_if(Gate::denies('user_entry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userEntry->load('user');

        return view('admin.userEntries.edit', compact('users', 'userEntry'));
    }

    public function update(UpdateUserEntryRequest $request, UserEntry $userEntry)
    {
        $userEntry->update($request->all());

        return redirect()->route('admin.user-entries.index');
    }

    public function show(UserEntry $userEntry)
    {
        abort_if(Gate::denies('user_entry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userEntry->load('user');

        return view('admin.userEntries.show', compact('userEntry'));
    }

    public function destroy(UserEntry $userEntry)
    {
        abort_if(Gate::denies('user_entry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userEntry->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserEntryRequest $request)
    {
        UserEntry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function depositPrintReceipt($id)
    {
        $invoice = UserEntry::find($id);
//        if($invoice->user_id != Auth::user()->id){
//            abort(404);
//        }
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

    public function feePrintInvoice($id)
    {
        $invoice = UserEntry::find($id);
//        if($invoice->user_id != Auth::user()->id){
//            abort(404);
//        }
        $invoice->name ="Admin Fee Invoice";
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
