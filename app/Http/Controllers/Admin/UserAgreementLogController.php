<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserAgreementLogRequest;
use App\Http\Requests\StoreUserAgreementLogRequest;
use App\Http\Requests\UpdateUserAgreementLogRequest;
use App\Models\User;
use App\Models\UserAgreement;
use App\Models\UserAgreementLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserAgreementLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_agreement_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserAgreementLog::with(['user_agreement', 'user'])->search($request)->select(sprintf('%s.*', (new UserAgreementLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_agreement_log_show';
                $editGate = 'user_agreement_log_edit';
                $deleteGate = 'user_agreement_log_delete';
                $crudRoutePart = 'user-agreement-logs';

                return view('partials.datatablesActions_UserAgreementLog', compact(
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
            $table->addColumn('user_agreement_name', function ($row) {
                return $row->user_agreement ? $row->user_agreement->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('signature_name', function ($row) {
                return $row->signature_name ? $row->signature_name : '';
            });
            $table->editColumn('signature_ic', function ($row) {
                return $row->signature_ic ? $row->signature_ic : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_agreement', 'user']);

            return $table->make(true);
        }

        return view('admin.userAgreementLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_agreement_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_agreements = UserAgreement::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userAgreementLogs.create', compact('user_agreements', 'users'));
    }

    public function store(StoreUserAgreementLogRequest $request)
    {
        $userAgreementLog = UserAgreementLog::create($request->all());

        return redirect()->route('admin.user-agreement-logs.index');
    }

    public function edit(UserAgreementLog $userAgreementLog)
    {
        abort_if(Gate::denies('user_agreement_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_agreements = UserAgreement::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userAgreementLog->load('user_agreement', 'user');

        return view('admin.userAgreementLogs.edit', compact('user_agreements', 'users', 'userAgreementLog'));
    }

    public function update(UpdateUserAgreementLogRequest $request, UserAgreementLog $userAgreementLog)
    {
        $userAgreementLog->update($request->all());

        return redirect()->route('admin.user-agreement-logs.index');
    }

    public function show(UserAgreementLog $userAgreementLog)
    {
        abort_if(Gate::denies('user_agreement_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAgreementLog->load('user_agreement', 'user');

        return view('admin.userAgreementLogs.show', compact('userAgreementLog'));
    }

    public function destroy(UserAgreementLog $userAgreementLog)
    {
        abort_if(Gate::denies('user_agreement_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAgreementLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserAgreementLogRequest $request)
    {
        UserAgreementLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
