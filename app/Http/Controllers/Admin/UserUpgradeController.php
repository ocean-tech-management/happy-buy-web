<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserUpgradeRequest;
use App\Http\Requests\StoreUserUpgradeRequest;
use App\Http\Requests\UpdateUserUpgradeRequest;
use App\Models\Admin;
use App\Models\PaymentMethod;
use App\Models\Role;
use App\Models\User;
use App\Models\UserEntry;
use App\Models\UserUpgrade;
use App\Models\PointBonusBalance;
use App\Models\TransactionIdLog;
use App\Models\TransactionBonusGiven;
use App\Models\BonusFirstUpline;
use App\Models\BonusFirstUplineLog;
use App\Models\BonusJoin;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class UserUpgradeController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_upgrade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserUpgrade::with(['user', 'upgrade_role', 'payment_method', 'approved_by_user', 'approved_by_admin'])->select(sprintf('%s.*', (new UserUpgrade())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_upgrade_show';
                $editGate = 'user_upgrade_edit';
                $deleteGate = 'user_upgrade_delete';
                $crudRoutePart = 'user-upgrades';

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

            $table->addColumn('upgrade_role_title', function ($row) {
                return $row->upgrade_role ? $row->upgrade_role->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
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
            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? UserUpgrade::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('gateway_response', function ($row) {
                return $row->gateway_response ? $row->gateway_response : '';
            });
            $table->editColumn('gateway_status', function ($row) {
                return $row->gateway_status ? UserUpgrade::GATEWAY_STATUS_SELECT[$row->gateway_status] : '';
            });
            $table->editColumn('gateway_transaction', function ($row) {
                return $row->gateway_transaction ? $row->gateway_transaction : '';
            });

            $table->addColumn('approved_by_user_name', function ($row) {
                return $row->approved_by_user ? $row->approved_by_user->name : '';
            });

            $table->addColumn('approved_by_admin_name', function ($row) {
                return $row->approved_by_admin ? $row->approved_by_admin->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'upgrade_role', 'receipt', 'payment_method', 'approved_by_user', 'approved_by_admin']);

            return $table->make(true);
        }

        return view('admin.userUpgrades.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_upgrade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upgrade_roles = Role::whereGuardName('user')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_by_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_by_admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userUpgrades.create', compact('users', 'upgrade_roles', 'payment_methods', 'approved_by_users', 'approved_by_admins'));
    }

    public function store(StoreUserUpgradeRequest $request)
    {
        $userUpgrade = UserUpgrade::create($request->all());

        if ($request->input('receipt', false)) {
            $userUpgrade->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userUpgrade->id]);
        }

        return redirect()->route('admin.user-upgrades.index');
    }

    public function edit(UserUpgrade $userUpgrade)
    {
        abort_if(Gate::denies('user_upgrade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upgrade_roles = Role::whereGuardName('user')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_by_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_by_admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userUpgrade->load('user', 'upgrade_role', 'payment_method', 'approved_by_user', 'approved_by_admin');

        return view('admin.userUpgrades.edit', compact('users', 'upgrade_roles', 'payment_methods', 'approved_by_users', 'approved_by_admins', 'userUpgrade'));
    }

    public function update(UpdateUserUpgradeRequest $request, UserUpgrade $userUpgrade)
    {
        $userUpgrade->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$userUpgrade->receipt || $request->input('receipt') !== $userUpgrade->receipt->file_name) {
                if ($userUpgrade->receipt) {
                    $userUpgrade->receipt->delete();
                }
                $userUpgrade->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
            }
        } elseif ($userUpgrade->receipt) {
            $userUpgrade->receipt->delete();
        }

        return redirect()->route('admin.user-upgrades.index');
    }

    public function show(UserUpgrade $userUpgrade)
    {
        abort_if(Gate::denies('user_upgrade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userUpgrade->load('user', 'upgrade_role', 'payment_method', 'approved_by_user', 'approved_by_admin');

        return view('admin.userUpgrades.show', compact('userUpgrade'));
    }

    public function destroy(UserUpgrade $userUpgrade)
    {
        abort_if(Gate::denies('user_upgrade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userUpgrade->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserUpgradeRequest $request)
    {
        UserUpgrade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_upgrade_create') && Gate::denies('user_upgrade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserUpgrade();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    // New User Upgrade Record is stored in User Entry Table
    public function userUpgradeNewListing(Request $request)
    {
        abort_if(Gate::denies('user_upgrade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->is('admin/new-user-upgrades/pending')) {
                $request->request->add(['status' => 2]);
            }

            $query = UserEntry::with(['user'])->Search($request)->where('created_at', '>=', '2022-08-01')->select(sprintf('%s.*', (new UserEntry())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_upgrade_show';
                $editGate = 'user_upgrade_edit';
                $deleteGate = 'user_upgrade_delete';
                $crudRoutePart = 'user-upgrades';

                return view('partials.datatablesActions_NewUserUpgrade', compact(
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
            $table->addColumn('transaction', function ($row) {
                return $row->transaction ? $row->transaction : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->addColumn('user_type', function ($row) {
                return $row->user_type ? UserEntry::USER_TYPE_SELECT[$row->user_type] : '';
            });

            $table->editColumn('deposit', function ($row) {
                return $row->deposit ? $row->deposit : '';
            });
            $table->editColumn('fee', function ($row) {
                return $row->fee ? $row->fee : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? UserEntry::STATUS_SELECT[$row->status] : '';
            });

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });
            

            $table->rawColumns(['actions', 'placeholder', 'user', 'status', 'user_type']);

            return $table->make(true);
        }

        return view('admin.userUpgrades.new_index');
    }

    public function upgradeApproveReject(Request $request){

        $status = $request->status;

        $userEntry = UserEntry::find($request->id);
        $user = $userEntry->user;

        DB::beginTransaction();
        try {
            if($status == "1"){
                $userEntry->update([
                    'status' => 1
                ]);
            }else{

                if($userEntry->user_type == "3"){

                    $user->syncRoles(['Merchant-Millionaire']);

                    $beneficial_first_upline_user_id = $user->upline_user_id;
                    $beneficial_second_upline_user_id = $user->upline_user->upline_user_id; 

                    if($user->direct_upline->roles[0]->id == 2){
                        // Once Approve, upline_user_id It will update to direct_upline_id
                        $beneficial_first_upline_user_id = $user->direct_upline_id;
                        $beneficial_second_upline_user_id = $user->direct_upline->upline_user_id;
                        
                        $user->update([
                            'user_type' => 3,
                            'upline_user_2_id' => $user->upline_user_1_id,
                            'upline_user_1_id' => $user->upline_user_id,
                            'upline_user_id' => $user->direct_upline_id,
                        ]);
                    }

                    $business_model_start_day = "2022-08-01";
                    // $userEntry2 = UserEntry::find($request->id);
                    // $user_id = $userEntry2->user_id;
                    // $user2 = User::findOrFail($user_id);

                    // dd($user2, Carbon::parse($user2->created_at)->toDateTimeString(), Carbon::createFromFormat('Y-m-d', $business_model_start_day)->startOfDay()->toDateTimeString());

                    // dd($beneficial_first_upline_user_id, $beneficial_second_upline_user_id);
                    $bonusFirstUpline = BonusFirstUpline::whereStatus(1)->get()->toArray();
                    $bonusJoin = BonusJoin::whereId(1)->first();
                    // $countReferralFound = User::where('user_type', '=', 3)->where('upline_user_id', $beneficial_first_upline_user_id)->where('status', 1)->count('id');
                    $userDirectUplineBeforeBusinessModel = User::where('user_type', '=', 3)->where('created_at', '<=', $business_model_start_day)->where('upline_user_id', $beneficial_first_upline_user_id)->where('status', 1)->count('id');
                    $countFirstUplineBonusGave = TransactionBonusGiven::where('user_id', $beneficial_first_upline_user_id)->whereIn('type', [6, 11])->where('status', 2)->count('id');
                    $currentReferralLevel = $countFirstUplineBonusGave + $userDirectUplineBeforeBusinessModel + 1;
                    foreach ($bonusFirstUpline as $key => $bonusItem) {
                        if ($currentReferralLevel >= $bonusItem['referral_count']) {
                            $shouldGiveBonusAmount = $bonusItem['bonus_amount'] ?? 0.00;
                        }
                    }

                    if(!in_array($beneficial_first_upline_user_id, [1,2,3])) {
                        $transactionBonusGiven = TransactionBonusGiven::create([
                            'user_id' => $beneficial_first_upline_user_id,
                            'type' => 11, //User Upgrade First Upline Bonus
                            'amount' => $shouldGiveBonusAmount,
                            'title' => 'user upgrade first upline bonus',
                            'remark' => 'user upgrade first upline bonus',
                            'status' => 2
                        ]);
                        $transactionNo = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven->user_id, $transactionBonusGiven->id);
                        $transactionBonusGiven->update([
                            'transaction' => $transactionNo,
                            'given_at' => Carbon::now()
                        ]);
                        PointBonusBalance::create([
                            'amount' => $shouldGiveBonusAmount,
                            'user_id' => $beneficial_first_upline_user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "user upgrade first upline bonus " . $transactionNo,
                        ]);
                        BonusFirstUplineLog::create([
                            'level' => $currentReferralLevel,
                            'transaction_remark' => $transactionNo,
                            'remark' => 'User Upgrade - First Upline Bonus',
                            'amount' => $shouldGiveBonusAmount,
                            'type' => 3,
                            'status' => 1,
                            'user_id' => $beneficial_first_upline_user_id,
                        ]);
                    }
                    // dd($beneficial_first_upline_user_id, $beneficial_second_upline_user_id, $shouldGiveBonusAmount);

                    // Second Upline Bonus From Bonus Join
                    if(!in_array($beneficial_second_upline_user_id, [1,2,3])) {
                        $transactionBonusGiven2 = TransactionBonusGiven::create([
                            'user_id' => $beneficial_second_upline_user_id, // User's Upline (Second Upline Id)
                            'type' => 12, // User Upgrade Second Upline Bonus
                            'amount' => $bonusJoin->second_upline_bonus,
                            'title' => 'user upgrade second upline bonus',
                            'remark' => 'user upgrade second upline bonus',
                            'status' => 2
                        ]);
                        $transactionNo2 = TransactionIdLog::generateTransactionId(4, $transactionBonusGiven2->user_id, $transactionBonusGiven2->id);
                        $transactionBonusGiven2->update([
                            'transaction' => $transactionNo2,
                            'given_at' => Carbon::now()
                        ]);

                        PointBonusBalance::create([
                            'amount' => $bonusJoin->second_upline_bonus,
                            'user_id' => $beneficial_second_upline_user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "user upgrade second upline bonus " . $transactionNo2,
                        ]);
                    }
                    // if(Carbon::parse($user2->created_at)->toDateTimeString() <= Carbon::createFromFormat('Y-m-d', $business_model_start_day)->startOfDay()->toDateTimeString()) {

                    // }
                }
                
                $userEntry->update([
                    'status' => 3
                ]);
            }

            // dd("test");
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back();
        }

        if(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'admin.user-upgrades.new-listing') {
            return redirect()->route('admin.user-upgrades.new-listing');
        }

        return redirect()->route('admin.users.show', $user->id);

    }
}
