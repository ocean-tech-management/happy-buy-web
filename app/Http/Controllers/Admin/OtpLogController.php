<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOtpLogRequest;
use App\Http\Requests\StoreOtpLogRequest;
use App\Http\Requests\UpdateOtpLogRequest;
use App\Jobs\SendOtpSms;
use App\Models\OtpLog;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OtpLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('otp_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OtpLog::with(['user'])->select(sprintf('%s.*', (new OtpLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'otp_log_show';
                $editGate = 'otp_log_edit';
                $deleteGate = 'otp_log_delete';
                $crudRoutePart = 'otp-logs';

                return view('partials.datatablesActions', compact(
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

            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? OtpLog::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('api_response', function ($row) {
                return $row->api_response ? $row->api_response : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.otpLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('otp_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.otpLogs.create', compact('users'));
    }

    public function store(StoreOtpLogRequest $request)
    {
        $otpLog = OtpLog::create($request->all());

        return redirect()->route('admin.otp-logs.index');
    }

    public function edit(OtpLog $otpLog)
    {
        abort_if(Gate::denies('otp_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $otpLog->load('user');

        return view('admin.otpLogs.edit', compact('users', 'otpLog'));
    }

    public function update(UpdateOtpLogRequest $request, OtpLog $otpLog)
    {
        $otpLog->update($request->all());

        return redirect()->route('admin.otp-logs.index');
    }

    public function show(OtpLog $otpLog)
    {
        abort_if(Gate::denies('otp_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otpLog->load('user');

        return view('admin.otpLogs.show', compact('otpLog'));
    }

    public function destroy(OtpLog $otpLog)
    {
        abort_if(Gate::denies('otp_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otpLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyOtpLogRequest $request)
    {
        OtpLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function test(Request $request)
    {
        SendOtpSms::dispatch("60167524536","test sms","123456", '1')->onQueue('sms-otp');

        return back();
    }
}
