<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointConvertRequest;
use App\Http\Requests\StorePointConvertRequest;
use App\Http\Requests\UpdatePointConvertRequest;
use App\Models\PointBalance;
use App\Models\PointBonusBalance;
use App\Models\PointConvert;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\VoucherBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointConvertController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('point_convert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointConvert::with(['user'])->search($request)->select(sprintf('%s.*', (new PointConvert())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'point_convert_show';
                $editGate = 'point_convert_edit';
                $deleteGate = 'point_convert_delete';
                $crudRoutePart = 'point-converts';

                return view('partials.datatablesActions_PointConvert', compact(
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
            $table->editColumn('transaction', function ($row) {
                return $row->transaction ? $row->transaction : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('pre_cp_bonus_balance', function ($row) {
                return $row->pre_cp_bonus_balance ? $row->pre_cp_bonus_balance : '';
            });
            $table->editColumn('post_cp_bonus_balance', function ($row) {
                return $row->post_cp_bonus_balance ? $row->post_cp_bonus_balance : '';
            });
            $table->editColumn('pre_cp_balance', function ($row) {
                return $row->pre_cp_balance ? $row->pre_cp_balance : '';
            });
            $table->editColumn('post_cp_balance', function ($row) {
                return $row->post_cp_balance ? $row->post_cp_balance : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.pointConverts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_convert_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pointConverts.create', compact('users'));
    }

    public function store(StorePointConvertRequest $request)
    {
        $pointBonusBalance = getUserPointBonusBalance(request('user_id'));
        $pointBalance = getUserPointBalance(request('user_id'));
        $requestAmount = request('amount');

        if ($requestAmount > $pointBonusBalance){
            return back()->with('error', trans('cruds.pointConvert.fields.insufficient_point_bonus'));
        }else{

            $request->request->add(['pre_cp_bonus_balance' => $pointBonusBalance]);
            $request->request->add(['post_cp_bonus_balance' => $pointBonusBalance - $requestAmount]);
            $request->request->add(['pre_cp_balance' => $pointBalance]);
            $request->request->add(['post_cp_balance' => $pointBalance + $requestAmount]);
            $pointConvert = PointConvert::create($request->all());
            $orderNumber = TransactionIdLog::generateTransactionId(5, request('user_id'), $pointConvert->id);
            $pointConvert->update([
                'transaction' => $orderNumber
            ]);

            if($pointConvert){
                PointBonusBalance::create([
                    'user_id' => request('user_id'),
                    'amount' => '-'.$requestAmount,
                    'status' => '1',
                    'settlement' => '1',
                    'remark' => 'convert point order: '.$orderNumber
                ]);

                PointBalance::create([
                    'user_id' => request('user_id'),
                    'amount' => $requestAmount,
                    'status' => '1',
                    'settlement' => '1',
                    'remark' => 'convert point order: '.$orderNumber
                ]);

                addUserVoucherBalance(request('user_id'), $requestAmount, 'convert reward: '.$orderNumber);
                addUserVoucherLog(request('user_id'), $requestAmount, 'convert reward: '.$orderNumber);
            }


            return redirect()->route('admin.point-converts.index');
        }
    }

    public function edit(PointConvert $pointConvert)
    {
        abort_if(Gate::denies('point_convert_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pointConvert->load('user');

        return view('admin.pointConverts.edit', compact('users', 'pointConvert'));
    }

    public function update(UpdatePointConvertRequest $request, PointConvert $pointConvert)
    {
        $pointConvert->update($request->all());

        return redirect()->route('admin.point-converts.index');
    }

    public function show(PointConvert $pointConvert)
    {
        abort_if(Gate::denies('point_convert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointConvert->load('user');

        return view('admin.pointConverts.show', compact('pointConvert'));
    }

    public function destroy(PointConvert $pointConvert)
    {
        abort_if(Gate::denies('point_convert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointConvert->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointConvertRequest $request)
    {
        PointConvert::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
