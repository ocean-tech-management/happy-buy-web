<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTransactionPointPurchaseRequest;
use App\Http\Requests\StoreTransactionPointPurchaseRequest;
use App\Http\Requests\UpdateTransactionPointPurchaseRequest;
use App\Models\Admin;
use App\Models\BonusJoin;
use App\Models\BonusTopUpGroup;
use App\Models\BonusTopUpPersonal;
use App\Models\DocumentNumberLog;
use App\Models\DocumentCreditNoteLogs;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentPaymentVoucherLogs;
use App\Models\DocumentReceiptLog;
use App\Models\DocumentMBRInvoiceLog;
use App\Models\PaymentMethod;
use App\Models\Point;
use App\Models\PointBalance;
use App\Models\PointBonusBalance;
use App\Models\PointPackage;
use App\Models\TransactionBonusGiven;
use App\Models\TransactionIdLog;
use App\Models\TransactionPointPurchase;
use App\Models\User;
use App\Models\UserEntry;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class TransactionPointPurchaseController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_point_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            if ($request->is('admin/transaction-point-purchases/failed')) {
                $request->request->add(['status' => 1]);
                $request->request->add(['type' => 1]);
            } else if ($request->is('admin/transaction-point-purchases/verified')) {
                $request->request->add(['status' => 3]);
                $request->request->add(['type' => 1]);
            } else if ($request->is('admin/transaction-point-purchases/new')) {
                $request->request->add(['status' => 2]);
                $request->request->add(['type' => 1]);
            } else if ($request->is('admin/transaction-point-purchases')) {
                // $request->request->add(['type' => 1]);
            } else if ($request->is('admin/user-upgrades')) {
//                $request->request->add(['status' => 2]);
                $request->request->add(['type' => 2]);
            } else if ($request->is('admin/user-upgrades/new')) {
                $request->request->add(['status' => 2]);
                $request->request->add(['type' => 2]);
            }

            $query = TransactionPointPurchase::with(['user', 'point_package', 'payment_method', 'admin'])->search($request)->select(sprintf('%s.*', (new TransactionPointPurchase())->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_point_purchase_show';
                $editGate = 'transaction_point_purchase_edit';
                $deleteGate = 'transaction_point_purchase_delete';
                $toVerifyGate = 'transaction_point_purchase_to_verify';
                $toRejectGate = 'transaction_point_purchase_to_reject';
                $crudRoutePart = 'transaction-point-purchases';

                return view('partials.datatablesActions_TransactionPointPurchase', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'toVerifyGate',
                    'toRejectGate',
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

            $table->addColumn('point_package_name_en', function ($row) {
                return $row->point_package ? $row->point_package->name_en : '';
            });

            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionPointPurchase::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('receipt', function ($row) {
                if ($photo = $row->receipt) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->editColumn('gateway_response', function ($row) {
                return $row->gateway_response ? $row->gateway_response : '';
            });
            $table->editColumn('gateway_status', function ($row) {
                return $row->gateway_status ? TransactionPointPurchase::GATEWAY_STATUS_SELECT[$row->gateway_status] : '';
            });
            $table->editColumn('gateway_transaction', function ($row) {
                return $row->gateway_transaction ? $row->gateway_transaction : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'point_package', 'payment_method', 'receipt', 'admin']);

            return $table->make(true);
        }

        return view('admin.transactionPointPurchases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_point_purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $point_packages = PointPackage::whereStatus(1)->where('id','!=', 99)->get();

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionPointPurchases.create', compact('users', 'point_packages', 'payment_methods', 'admins'));
    }

    public function store(StoreTransactionPointPurchaseRequest $request)
    {
        $point_package = PointPackage::findOrFail(request('point_package_id'));

        $request->request->add(['point' => $point_package->point]);
        $request->request->add(['price' => $point_package->price]);

        $transactionPointPurchase = TransactionPointPurchase::create($request->all());

        $order_number = TransactionIdLog::generateTransactionId(1, $transactionPointPurchase->user_id, $transactionPointPurchase->id);
        $transactionPointPurchase->update([
            'transaction' => $order_number,
        ]);

        if ($request->input('receipt', false)) {
            $transactionPointPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transactionPointPurchase->id]);
        }

        if($request->type == 2){
            return redirect()->route('admin.transaction-point-purchases.user-upgrade');
        }else{
            return redirect()->route('admin.transaction-point-purchases.new');
        }

    }

    public function edit(TransactionPointPurchase $transactionPointPurchase)
    {
        abort_if(Gate::denies('transaction_point_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $point_packages = PointPackage::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionPointPurchase->load('user', 'point_package', 'payment_method', 'admin');

        return view('admin.transactionPointPurchases.edit', compact('users', 'point_packages', 'payment_methods', 'admins', 'transactionPointPurchase'));
    }

    public function update(UpdateTransactionPointPurchaseRequest $request, TransactionPointPurchase $transactionPointPurchase)
    {
        $transactionPointPurchase->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$transactionPointPurchase->receipt || $request->input('receipt') !== $transactionPointPurchase->receipt->file_name) {
                if ($transactionPointPurchase->receipt) {
                    $transactionPointPurchase->receipt->delete();
                }
                $transactionPointPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
            }
        } elseif ($transactionPointPurchase->receipt) {
            $transactionPointPurchase->receipt->delete();
        }

        return redirect()->route('admin.transaction-point-purchases.new');
    }

    public function show(TransactionPointPurchase $transactionPointPurchase)
    {
        abort_if(Gate::denies('transaction_point_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointPurchase->load('user', 'point_package', 'payment_method', 'admin');

        return view('admin.transactionPointPurchases.show', compact('transactionPointPurchase'));
    }

    public function upgradeShow(Request $request)
    {
        abort_if(Gate::denies('transaction_point_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointPurchase = TransactionPointPurchase::findOrFail(request('id'));
        $transactionPointPurchase->load('user', 'point_package', 'payment_method', 'admin');

        return view('admin.userUpgrades.show', compact('transactionPointPurchase'));
    }

    public function destroy(TransactionPointPurchase $transactionPointPurchase)
    {
        abort_if(Gate::denies('transaction_point_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPointPurchase->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionPointPurchaseRequest $request)
    {
        TransactionPointPurchase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transaction_point_purchase_create') && Gate::denies('transaction_point_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new TransactionPointPurchase();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function toVerify(Request $request)
    {
        $model = TransactionPointPurchase::findOrFail(request('id'));

        if ($model){
            DB::beginTransaction();
            try {
                $point = $model->point;
                $user_id = $model->user_id;
                $order_number = $model->transaction;
                $created_at = $model->created_at;
                $user = $model->user;
                $point_package_id = $model->point_package_id;

                $bonusTopUpGroup = BonusTopUpGroup::where('point_package_id', $point_package_id)->first();
                $bonusTopUpPersonal = BonusTopUpPersonal::where('point_package_id', $point_package_id)->first();

                $model->update([
                    'status' => 3,
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'payment_verified_at' => Carbon::now(),
                    'invoice_number' => DocumentNumberLog::generateDocumentNumber("1", $user_id),
                    'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($user_id),
                    'receipt_number' => DocumentReceiptLog::generateDocumentNumber($user_id),
                ]);

                // DocumentMBRInvoiceLog::generateDocumentNumber($user_id, 1, null, $point, 0, 90);

                PointBalance::create([
                    'amount' => $point,
                    'user_id' => $user_id,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "purchase order ".$order_number,
                ]);

                // give upline bonus if user are merchant
                if(str_contains($user->roles[0]->name , 'Merchant')){

                    addUserVoucherBalance($user_id, $point, 'topup reward: '.$order_number);
                    addUserVoucherLog($user_id, $point, 'topup reward: '.$order_number);

                    $startDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2022-03-08 00:00:00');
                    $endDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2022-03-08 23:59:59');
                    $check_between_dates =  \Carbon\Carbon::parse($created_at)->between($startDate,$endDate);

                    if($check_between_dates){
                        addToCart($user_id, 125, 10);
                    }

                    if($user->upline_user != null){
                        if($user->upline_user->id != "1" && $user->upline_user->id != "2" && $user->upline_user->id != "3"){

                            $checkExists = TransactionBonusGiven::where('model', $model->id)->where('title','team topup bonus first upline')->first();

                            if(!$checkExists){
                                $transactionBonusGiven = TransactionBonusGiven::create([
                                    'user_id' => $user->upline_user->id,
                                    'type' => 3,
                                    'amount' => $bonusTopUpGroup->first_upline_bonus,
                                    'title' => 'team topup bonus first upline',
                                    'remark' => 'team topup bonus 1st: '.$order_number,
                                    'status' => 2,
                                    'model_type' => '\App\Model\TransactionPointPurchase',
                                    'model' => $model->id,
                                ]);
                                $bonusGivenNumber = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                                $transactionBonusGiven->update([
                                    'transaction' => $bonusGivenNumber,
                                    'given_at' => Carbon::now()
                                ]);

                                PointBonusBalance::create([
                                    'amount' => $bonusTopUpGroup->first_upline_bonus,
                                    'user_id' => $user->upline_user->id,
                                    'status' => 1,
                                    'settlement' => 1,
                                    'remark' => "team topup bonus ".$bonusGivenNumber,
                                    'model_type' => '\App\Models\TransactionBonusGiven',
                                    'model' => $transactionBonusGiven->id,
                                ]);
                            }

                        }
                    }

                    if($user->upline_user_1 != null){

                        if($user->upline_user_1->id != "1" && $user->upline_user_1->id != "2" && $user->upline_user_1->id != "3"){

                            $checkExists2 = TransactionBonusGiven::where('model', $model->id)->where('title','team topup bonus second upline')->first();

                            if(!$checkExists2){
                                $transactionBonusGiven2 = TransactionBonusGiven::create([
                                    'user_id' => $user->upline_user_1->id,
                                    'type' => 3,
                                    'amount' => $bonusTopUpGroup->second_upline_bonus,
                                    'title' => 'team topup bonus second upline',
                                    'remark' => 'team topup bonus 2nd: '.$order_number,
                                    'status' => 2,
                                    'model_type' => '\App\Model\TransactionPointPurchase',
                                    'model' => $model->id,
                                ]);
                                $bonusGivenNumber2 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven2->user_id, $transactionBonusGiven2->id);
                                $transactionBonusGiven2->update([
                                    'transaction' => $bonusGivenNumber2,
                                    'given_at' => Carbon::now()
                                ]);

                                PointBonusBalance::create([
                                    'amount' => $bonusTopUpGroup->second_upline_bonus,
                                    'user_id' => $user->upline_user_1->id,
                                    'status' => 1,
                                    'settlement' => 1,
                                    'remark' => "team topup bonus ".$bonusGivenNumber2,
                                    'model_type' => '\App\Models\TransactionBonusGiven',
                                    'model' => $transactionBonusGiven2->id,
                                ]);
                            }
                        }
                    }

                    //calculate personal topup first upline
//                    $downline1 = User::whereUplineUserId($user_id)->pluck('id');
//
//                    $startDate = Carbon::now()->startOfMonth()->toDateString();
//                    $endDate = Carbon::now()->endOfMonth()->toDateString();
//
//                    $transactionPointPurchaseDownline1 = TransactionPointPurchase::whereIn('user_id',$downline1)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();
//
//                    if($transactionPointPurchaseDownline1 > 0){
//
//                        $transactionBonusGivenCount = TransactionBonusGiven::whereUserId($user_id)->whereTitle('PTB1ST')->whereType(2)->count();
//
//                        if ($transactionBonusGivenCount < $transactionPointPurchaseDownline1){
//                            $transactionBonusGiven3 = TransactionBonusGiven::create([
//                                'user_id' => $user_id,
//                                'type' => 2,
//                                'amount' => $bonusTopUpPersonal->first_upline_bonus,
//                                'title' => 'PTB1ST',
//                                'remark' => 'personal topup bonus 1st: '.$order_number,
//                                'status' => 2
//                            ]);
//                            $bonusGivenNumber3 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven3->user_id, $transactionBonusGiven3->id);
//                            $transactionBonusGiven3->update([
//                                'transaction' => $bonusGivenNumber3,
//                                'given_at' => Carbon::now()
//                            ]);
//
//                            PointBonusBalance::create([
//                                'amount' => $bonusTopUpPersonal->first_upline_bonus,
//                                'user_id' => $user_id,
//                                'status' => 1,
//                                'settlement' => 1,
//                                'remark' => "personal topup bonus ".$bonusGivenNumber3,
//                            ]);
//                        }
//
//                    }
//
//                    //calculate personal topup second upline
//                    $downline2 = User::where('upline_user_1_id',$user_id)->pluck('id');
//
//                    $transactionPointPurchaseDownline2 = TransactionPointPurchase::whereIn('user_id',$downline2)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();
//
//                    if($transactionPointPurchaseDownline2 > 0){
//
//                        $transactionBonusGivenCount = TransactionBonusGiven::whereUserId($user_id)->whereTitle('PTB2ND')->whereType(2)->count();
//
//                        if ($transactionBonusGivenCount < $transactionPointPurchaseDownline2){
//                            $transactionBonusGiven4 = TransactionBonusGiven::create([
//                                'user_id' => $user_id,
//                                'type' => 2,
//                                'amount' => $bonusTopUpPersonal->second_upline_bonus,
//                                'title' => 'PTB2ND',
//                                'remark' => 'personal topup bonus 2nd: '.$order_number,
//                                'status' => 2
//                            ]);
//                            $bonusGivenNumber4 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven4->user_id, $transactionBonusGiven4->id);
//                            $transactionBonusGiven4->update([
//                                'transaction' => $bonusGivenNumber4,
//                                'given_at' => Carbon::now()
//                            ]);
//
//                            PointBonusBalance::create([
//                                'amount' => $bonusTopUpPersonal->second_upline_bonus,
//                                'user_id' => $user_id,
//                                'status' => 1,
//                                'settlement' => 1,
//                                'remark' => "personal topup bonus ".$bonusGivenNumber4,
//                            ]);
//                        }
//
//                    }
                }
                DB::commit();
                return back();
            } catch (\Exception $e) {
                Log::error($e);
                DB::rollBack();
                return back();
            }
        }
        return back();
    }

    public function toReject(Request $request)
    {
        $model = TransactionPointPurchase::findOrFail(request('id'));
        $point = $model->point;
        $user_id = $model->user_id;
        $order_number = $model->transaction;
        $model->update([
            'status' => 1,
            'admin_id' => Auth::guard('admin')->user()->id,
            // 'payment_voucher_number' => DocumentPaymentVoucherLog::generateDocumentNumber($user_id, 1),
        ]);

        return back();
    }

    public function upgradeVerify(Request $request)
    {
        $model = TransactionPointPurchase::findOrFail(request('id'));
        $point = $model->point;
        $user_id = $model->user_id;
        $order_number = $model->transaction;
        $user = $model->user;
        $created_at = $model->created_at;

        $bonusJoin = BonusJoin::whereId(1)->first();

        $model->update([
            'status' => 3,
            'admin_id' => Auth::guard('admin')->user()->id,
            'payment_verified_at' => Carbon::now(),
            'invoice_number' => DocumentNumberLog::generateDocumentNumber("1", $user_id),
            'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($user_id),
            'receipt_number' => DocumentReceiptLog::generateDocumentNumber($user_id),
        ]);

        // $documentMBRInvoiceLog = DocumentMBRInvoiceLog::generateDocumentNumber($user_id, 1, null, ($point + 6000 + 2000), 0);

        if ($model){

            DB::beginTransaction();
            try{
                PointBalance::create([
                    'amount' => $point,
                    'user_id' => $user_id,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "upgrade order ".$order_number,
                ]);

                $directUplineUser = $user->direct_upline;

                if(!str_contains($directUplineUser->roles[0]->name , 'Merchant')){
                    $user->update([
                        'direct_upline_id' => $user->upline_user->id,
                        'user_type' => 3
                    ]);
                }
                $user->update([
                    'user_type' => 3
                ]);
                $user->syncRoles(['Merchant-Millionaire']);

//                $userEntry = UserEntry::whereUserId($user_id)->first();

                // create user deposit entry
                $userEntry = UserEntry::create([
                    'user_type' => 3,
                    'user_id' => $user_id,
                    'deposit' => '2000',
                    'fee' => 0,
                    'top_up' => 0,
                    'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $user_id),
                    'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($user_id),
                ]);

                // create user fee entry
                UserEntry::create([
                    'user_type' => 3,
                    'user_id' => $user_id,
                    'deposit' => 0,
                    'fee' => '6000',
                    'top_up' => 0,
                    'invoice_number' => DocumentNumberLog::generateDocumentNumber("1", $user_id),
                    'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($user_id),
                ]);
                // create user top_up entry
                UserEntry::create([
                    'user_type' => 3,
                    'user_id' => $user_id,
                    'deposit' => 0,
                    'fee' => 0,
                    'top_up' => $point,
                ]);

//                if($userEntry){
                    addUserVoucherBalance($user_id, $point, 'topup reward: '.$order_number);
                    addUserVoucherLog($user_id, $point, 'topup reward: '.$order_number);

                $startDate = Carbon::createFromFormat('Y-m-d H:i:s','2022-03-08 00:00:00');
                $endDate = Carbon::createFromFormat('Y-m-d H:i:s','2022-03-08 23:59:59');
                $check_between_dates =  Carbon::parse($created_at)->between($startDate,$endDate);

                if($check_between_dates){
                    addToCart($user_id, 55, 15);
                }


//                }

                $newUser = User::whereId($user->id)->first();

                //referral bonus 1
                $transactionBonusGiven = TransactionBonusGiven::create([
                    'user_id' => $newUser->upline_user->id,
                    'type' => 1,
                    'amount' => $bonusJoin->first_upline_bonus,
                    'title' => 'referral bonus first upline',
                    'remark' => 'referral bonus 1st: '.$order_number,
                    'status' => 2
                ]);
                $bonusGivenNumber = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                $transactionBonusGiven->update([
                    'transaction' => $bonusGivenNumber,
                    'given_at' => Carbon::now()
                ]);

                PointBonusBalance::create([
                    'amount' => $bonusJoin->first_upline_bonus,
                    'user_id' => $newUser->upline_user->id,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "referral bonus ".$bonusGivenNumber,
                    'model_type' => '\App\Models\TransactionBonusGiven',
                    'model' => $transactionBonusGiven->id,
                ]);

                if($newUser->upline_user_1->id != "1" && $newUser->upline_user_1->id != "2" && $newUser->upline_user_1->id != "3"){
                    //referral bonus 2
                    $transactionBonusGiven2 = TransactionBonusGiven::create([
                        'user_id' => $newUser->upline_user_1->id,
                        'type' => 1,
                        'amount' => $bonusJoin->second_upline_bonus,
                        'title' => 'referral bonus second upline',
                        'remark' => 'referral bonus 2nd: '.$order_number,
                        'status' => 2
                    ]);
                    $bonusGivenNumber2 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven2->user_id, $transactionBonusGiven2->id);
                    $transactionBonusGiven2->update([
                        'transaction' => $bonusGivenNumber2,
                        'given_at' => Carbon::now()
                    ]);

                    PointBonusBalance::create([
                        'amount' => $bonusJoin->second_upline_bonus,
                        'user_id' => $newUser->upline_user_1->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "referral bonus ".$bonusGivenNumber2,
                        'model_type' => '\App\Models\TransactionBonusGiven',
                        'model' => $transactionBonusGiven2->id,
                    ]);
                }

                ///team topup bonus
                $bonusTopUpGroup = BonusTopUpGroup::whereId(1)->first();

                if($newUser->upline_user != null){
                    if($newUser->upline_user->id != "1" && $newUser->upline_user->id != "2" && $newUser->upline_user->id != "3"){
                        $transactionBonusGiven3 = TransactionBonusGiven::create([
                            'user_id' => $newUser->upline_user->id,
                            'type' => 3,
                            'amount' => $bonusTopUpGroup->first_upline_bonus,
                            'title' => 'team topup bonus first upline',
                            'remark' => 'team topup bonus 1st: '.$order_number,
                            'status' => 2
                        ]);
                        $bonusGivenNumber3 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven3->user_id, $transactionBonusGiven3->id);
                        $transactionBonusGiven3->update([
                            'transaction' => $bonusGivenNumber3,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $bonusTopUpGroup->first_upline_bonus,
                            'user_id' => $newUser->upline_user->id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "team topup bonus ".$bonusGivenNumber3,
                        ]);
                    }
                }

                if($newUser->upline_user_1 != null){
                    if($newUser->upline_user_1->id != "1" && $newUser->upline_user_1->id != "2" && $newUser->upline_user_1->id != "3"){
                        $transactionBonusGiven4 = TransactionBonusGiven::create([
                            'user_id' => $newUser->upline_user_1->id,
                            'type' => 3,
                            'amount' => $bonusTopUpGroup->second_upline_bonus,
                            'title' => 'team topup bonus second upline',
                            'remark' => 'team topup bonus 2nd: '.$order_number,
                            'status' => 2
                        ]);
                        $bonusGivenNumber4 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven4->user_id, $transactionBonusGiven4->id);
                        $transactionBonusGiven4->update([
                            'transaction' => $bonusGivenNumber4,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $bonusTopUpGroup->second_upline_bonus,
                            'user_id' => $newUser->upline_user_1->id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "team topup bonus ".$bonusGivenNumber4,
                        ]);
                    }
                }

                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                return back();
            }
        }
        return back();
    }

    public function test(){

        $downline1 = User::where('upline_user_1_id',2)->pluck('id');

        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        $transactionPointPurchase = TransactionPointPurchase::whereIn('user_id',$downline1)->wherePointPackageId(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

        if($transactionPointPurchase > 0){

        }

        return $transactionPointPurchase;
    }

    public function calculatePersonalTopUpBonus(){


        $startDate = Carbon::today()->startOfMonth()->subMonth()->format('Y-m-d H:i:s');
        $endDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');

        foreach(TransactionPointPurchase::whereStatus('3')->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->groupBy('user_id')->cursor() as $value){

            $bonusTopUpPersonal = BonusTopUpPersonal::where('point_package_id', $value->point_package_id)->first();

            $user_id = $value->user_id;

            $downlines = User::where(function($q) use ($user_id){
                $q->where('upline_user_id','=', $user_id);
            })->pluck('id');

            $topUpPurchase = TransactionPointPurchase::whereIn('user_id', $downlines)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

            $downlines2 = User::where(function($q) use ($user_id){
                $q->where('upline_user_1_id','=', $user_id);
            })->pluck('id');

            $topUpPurchase2 = TransactionPointPurchase::whereIn('user_id', $downlines2)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

            $totalBonus = ($topUpPurchase * $bonusTopUpPersonal->first_upline_bonus) + ($topUpPurchase2 * $bonusTopUpPersonal->second_upline_bonus);

            if($totalBonus > 0){
                $transactionBonusGiven = TransactionBonusGiven::create([
                    'user_id' => $user_id,
                    'type' => 2,
                    'amount' => $totalBonus,
                    'title' => 'PTUBONUS',
                    'remark' => 'personal topup bonus',
                    'status' => 2
                ]);
                $bonusGivenNumber = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                $transactionBonusGiven->update([
                    'transaction' => $bonusGivenNumber,
                    'given_at' => Carbon::now()
                ]);

                PointBonusBalance::create([
                    'amount' => $totalBonus,
                    'user_id' => $user_id,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "personal topup bonus ".$bonusGivenNumber,
                ]);
            }
        }
    }

    public function transactionPointPurchaseReceiptPDF($id){
        $receipt = TransactionPointPurchase::find($id);
        $receipt->name ="Top Up Receipt";
        $receipt->footnote ="Foot Note";
        $pdf = PDF::loadView('user.print.top-up-receipt', compact('receipt'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($receipt->name.".pdf");
    }

    public function calculatePersonalTopUpBonusTest(Request $request){

        $bonusTopUpPersonal = BonusTopUpPersonal::whereId(1)->first();

        $startDate = "2022-11-01 00:00:00";
        $endDate = "2022-11-30 23:59:59";

        $startDate2 = Carbon::today()->startOfMonth()->subMonth()->format('Y-m-d H:i:s');
        $endDate2 = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');

        echo $startDate2." - ".$endDate2."<br/>";

        foreach(TransactionPointPurchase::whereStatus('3')->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->groupBy('user_id')->cursor() as $value){

            $user_id = $value->user_id;

            $downlines = User::where(function($q) use ($user_id){
                $q->where('upline_user_id','=', $user_id);
            })->pluck('id');

            $topUpPurchase = TransactionPointPurchase::whereIn('user_id', $downlines)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

            $downlines2 = User::where(function($q) use ($user_id){
                $q->where('upline_user_1_id','=', $user_id);
            })->pluck('id');

            $topUpPurchase2 = TransactionPointPurchase::whereIn('user_id', $downlines2)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

            $totalBonus = ($topUpPurchase * $bonusTopUpPersonal->first_upline_bonus) + ($topUpPurchase2 * $bonusTopUpPersonal->second_upline_bonus);

            echo $user_id." - ".$totalBonus."<br/>";
            if($totalBonus > 0){
                $transactionBonusGiven = TransactionBonusGiven::create([
                    'user_id' => $user_id,
                    'type' => 2,
                    'amount' => $totalBonus,
                    'title' => 'PTUBONUS',
                    'remark' => 'personal topup bonus',
                    'status' => 2
                ]);
                $bonusGivenNumber = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                $transactionBonusGiven->update([
                    'transaction' => $bonusGivenNumber,
                    'given_at' => Carbon::now()
                ]);

                PointBonusBalance::create([
                    'amount' => $totalBonus,
                    'user_id' => $user_id,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "personal topup bonus ".$bonusGivenNumber,
                ]);
            }
        }
    }

    public function test2()
    {

        DB::commit();


    }
}
