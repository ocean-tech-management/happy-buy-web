<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTransactionAgentTopUpRequest;
use App\Http\Requests\StoreTransactionAgentTopUpRequest;
use App\Http\Requests\UpdateTransactionAgentTopUpRequest;
use App\Models\PointBalance;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionIdLog;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionAgentTopUpController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_agent_top_up_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            if ($request->is('admin/transaction-agent-top-ups/new')) {
                $request->request->add(['status' => 1]);
            }
            else if ($request->is('admin/transaction-agent-top-ups/approved')) {
                $request->request->add(['status' => 2]);
            }
            else if ($request->is('admin/transaction-agent-top-ups/rejected')) {
                $request->request->add(['status' => 3]);
            }

            $query = TransactionAgentTopUp::with(['user', 'merchant'])->search($request)->select(sprintf('%s.*', (new TransactionAgentTopUp())->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_agent_top_up_show';
                $editGate = 'transaction_agent_top_up_edit';
                $deleteGate = 'transaction_agent_top_up_delete';
                $crudRoutePart = 'transaction-agent-top-ups';

                return view('partials.datatablesActions_TransactionAgentTopup', compact(
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

            $table->addColumn('merchant_name', function ($row) {
                return $row->merchant ? $row->merchant->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('merchant_pre_balance', function ($row) {
                return $row->merchant_pre_balance ? $row->merchant_pre_balance : '';
            });
            $table->editColumn('merchant_post_balance', function ($row) {
                return $row->merchant_post_balance ? $row->merchant_post_balance : '';
            });
            $table->editColumn('user_pre_balance', function ($row) {
                return $row->user_pre_balance ? $row->user_pre_balance : '';
            });
            $table->editColumn('user_post_balance', function ($row) {
                return $row->user_post_balance ? $row->user_post_balance : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionAgentTopUp::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('receipt_photo', function ($row) {
                if ($photo = $row->receipt_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'merchant', 'receipt_photo']);

            return $table->make(true);
        }

        return view('admin.transactionAgentTopUps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_agent_top_up_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $merchants = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionAgentTopUps.create', compact('users', 'merchants'));
    }

    public function store(StoreTransactionAgentTopUpRequest $request)
    {
        $transactionAgentTopUp = TransactionAgentTopUp::create($request->all());

        if ($request->input('receipt_photo', false)) {
            $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_photo'))))->toMediaCollection('receipt_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transactionAgentTopUp->id]);
        }

        return redirect()->route('admin.transaction-agent-top-ups.new');
    }

    public function edit(TransactionAgentTopUp $transactionAgentTopUp)
    {
        abort_if(Gate::denies('transaction_agent_top_up_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $merchants = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionAgentTopUp->load('user', 'merchant');

        return view('admin.transactionAgentTopUps.edit', compact('users', 'merchants', 'transactionAgentTopUp'));
    }

    public function update(UpdateTransactionAgentTopUpRequest $request, TransactionAgentTopUp $transactionAgentTopUp)
    {
        $transactionAgentTopUp->update($request->all());

        if ($request->input('receipt_photo', false)) {
            if (!$transactionAgentTopUp->receipt_photo || $request->input('receipt_photo') !== $transactionAgentTopUp->receipt_photo->file_name) {
                if ($transactionAgentTopUp->receipt_photo) {
                    $transactionAgentTopUp->receipt_photo->delete();
                }
                $transactionAgentTopUp->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_photo'))))->toMediaCollection('receipt_photo');
            }
        } elseif ($transactionAgentTopUp->receipt_photo) {
            $transactionAgentTopUp->receipt_photo->delete();
        }

        return redirect()->route('admin.transaction-agent-top-ups.new');
    }

    public function show(TransactionAgentTopUp $transactionAgentTopUp)
    {
        abort_if(Gate::denies('transaction_agent_top_up_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionAgentTopUp->load('user', 'merchant');

        return view('admin.transactionAgentTopUps.show', compact('transactionAgentTopUp'));
    }

    public function destroy(TransactionAgentTopUp $transactionAgentTopUp)
    {
        abort_if(Gate::denies('transaction_agent_top_up_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionAgentTopUp->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionAgentTopUpRequest $request)
    {
        TransactionAgentTopUp::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transaction_agent_top_up_create') && Gate::denies('transaction_agent_top_up_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TransactionAgentTopUp();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function manual(Request $request)
    {

        $users = User::all();

        return view('admin.transactionAgentTopUps.manual', compact('users'));
    }

    public function manualTopup(Request $request)
    {
        $user_id = $request->user_id;
        $amount = $request->amount;
        $wallet_id = $request->wallet_id;

        $user = User::whereId($user_id)->first();

        if($wallet_id != NULL){
            $wallet_type = $wallet_id;
        }else{
            if($user->user_type == 1){
                $wallet_type = 1;
            }else if($user->user_type == 2){
                $wallet_type = 2;
            }else if($user->user_type == 3){
                $wallet_type = 3;
            }
        }


        if($user->direct_upline->user_type == 1){
            $from_wallet_type = 1;
        }else if($user->direct_upline->user_type == 2){
            $from_wallet_type = 2;
        }else if($user->direct_upline->user_type == 3){
            $from_wallet_type = 3;
        }

        DB::beginTransaction();
        try{
            $transaction_date = [
                'type' => 1,
                'user_id' => $user->id,
                'merchant_id' => $user->direct_upline->id, //as upline id now , not just merchant already
                'amount' => $amount,
                'from_wallet' => $from_wallet_type,
                'to_wallet' => $wallet_type,
                'status' => 2,
                'deposit_bank' => $user->direct_upline->bank_name,
                'deposit_bank_account_name' => $user->direct_upline->bank_account_name,
                'deposit_bank_account_number' => $user->direct_upline->bank_account_number,
                'point_package_id' => 99,
                'approved_at' => Carbon::now(),
            ];

            $transactionAgentTopUp = TransactionAgentTopUp::create($transaction_date);
            $transaction = TransactionIdLog::generateTransactionId('1', $user->id, $transactionAgentTopUp->id);
            $transactionAgentTopUp::where('id', $transactionAgentTopUp->id)->update([
                'transaction' => $transaction,
            ]);

            $point_balance_data = [
                'amount' => $amount,
                'user_id' => $user->id,
                'status' => 1,
                'settlement' => 1,
                'remark' => "transfer from upline ".$user->direct_upline->name ."\n". $transaction,
                'model_type' => '\App\Models\TransactionAgentTopUp',
                'model' => $transactionAgentTopUp->id,
            ];

            if($wallet_id != NULL){
                if ($wallet_id == 1) {
                    $modelCheck = PointExecutiveBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                    if($modelCheck == 0){
                        PointExecutiveBalance::create($point_balance_data);
                    }
                } elseif ($wallet_id == 2) {
                    $modelCheck = PointManagerBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                    if($modelCheck == 0){
                        PointManagerBalance::create($point_balance_data);
                    }
                } elseif ($wallet_id == 3) {
                    $modelCheck = PointBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                    if($modelCheck == 0){
                        PointBalance::create($point_balance_data);
                    }
                }
            }else{
                if ($user->user_type == 1) {
                    $modelCheck = PointExecutiveBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                    if($modelCheck == 0){
                        PointExecutiveBalance::create($point_balance_data);
                    }
                } elseif ($user->user_type == 2) {
                    $modelCheck = PointManagerBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                    if($modelCheck == 0){
                        PointManagerBalance::create($point_balance_data);
                    }
                } elseif ($user->user_type == 3) {
                    $modelCheck = PointBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                    if($modelCheck == 0){
                        PointBalance::create($point_balance_data);
                    }
                }
            }


            $point_balance_data2 = [
                'amount' => "-".$amount,
                'user_id' => $user->direct_upline->id,
                'status' => 1,
                'settlement' => 1,
                'remark' => "transfer to downline ".$user->name . "\n".$transaction,
                'model_type' => '\App\Models\TransactionAgentTopUp',
                'model' => $transactionAgentTopUp->id,
            ];

            if($user->direct_upline->user_type == 1) {
                $modelCheck = PointExecutiveBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                if($modelCheck == 0){
                    PointExecutiveBalance::create($point_balance_data2);
                }
            }else if($user->direct_upline->user_type == 2) {
                $modelCheck = PointManagerBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                if($modelCheck == 0){
                    PointManagerBalance::create($point_balance_data2);
                }
            }else if($user->direct_upline->user_type == 3){
                $modelCheck = PointBalance::where('model_type', '\App\Models\TransactionAgentTopUp')->where('model', $transactionAgentTopUp->id)->where('user_id', $user_id)->count();
                if($modelCheck == 0){
                    PointBalance::create($point_balance_data2);
                }
            }

            DB::commit();
            return redirect()->route('admin.transaction-agent-top-ups.manual');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);
        }


    }


    // This function only fix Ricole's 6 records insert point without transaction_agent_top_ups record.
    public function manualWithoutPoint(Request $request)
    {

        $users = User::all();

        return view('admin.transactionAgentTopUps.manual_without_point', compact('users'));
    }

    public function manualTopupWithoutPoint(Request $request) {
        $user_id = $request->user_id;
        $amount = $request->amount;
        $user = User::whereId($user_id)->first();

        if($user->user_type == 1){
            $wallet_type = 1;
        }else if($user->user_type == 2){
            $wallet_type = 2;
        }else if($user->user_type == 3){
            $wallet_type = 3;
        }

        if($user->direct_upline->user_type == 1){
            $from_wallet_type = 1;
        }else if($user->direct_upline->user_type == 2){
            $from_wallet_type = 2;
        }else if($user->direct_upline->user_type == 3){
            $from_wallet_type = 3;
        }

        DB::beginTransaction();
        try{
            $transaction_date = [
                'type' => 1,
                'user_id' => $user->id,
                'merchant_id' => $user->direct_upline->id, //as upline id now , not just merchant already
                'amount' => $amount,
                'from_wallet' => $from_wallet_type,
                'to_wallet' => $wallet_type,
                'status' => 2,
                'deposit_bank' => $user->direct_upline->bank_name,
                'deposit_bank_account_name' => $user->direct_upline->bank_account_name,
                'deposit_bank_account_number' => $user->direct_upline->bank_account_number,
                'point_package_id' => 99,
                'approved_at' => Carbon::now(),
            ];

            $transactionAgentTopUp = TransactionAgentTopUp::create($transaction_date);
            $transaction = TransactionIdLog::generateTransactionId('1', $user->id, $transactionAgentTopUp->id);
            $transactionAgentTopUp::where('id', $transactionAgentTopUp->id)->update([
                'transaction' => $transaction,
            ]);

            DB::commit();
            return redirect()->route('admin.transaction-agent-top-ups.manual_without_point');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);
        }
    }
}
