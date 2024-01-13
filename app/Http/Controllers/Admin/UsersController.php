<?php

namespace App\Http\Controllers\Admin;

use App\Exports\WithdrawExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\AddressBook;
use App\Models\BankList;
use App\Models\Country;
use App\Models\DocumentNumberLog;
use App\Models\DocumentCreditNoteLogs;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentPaymentVoucherLogs;
use App\Models\DocumentReceiptLog;
use App\Models\PersonalCodeLog;
use App\Models\PointPackage;
use App\Models\Role;
use App\Models\ShippingBalance;
use App\Models\State;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionPointWithdraw;
use App\Models\User;
use App\Models\Point;
use App\Models\Order;
use App\Models\Enquiry;
use App\Models\UserEntry;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->is('admin/merchants')) {
                $request->request->add(['role' => 'Merchant']);
            } else if ($request->is('admin/agents')){
                $request->request->add(['role' => 'Agent']);
            } else if ($request->is('admin/vips')) {
                $request->request->add(['role' => 'VIP']);
            } else {
                $request->request->add(['role' => 'Merchant']);
            }

            $query = User::with(['bank_list', 'country', 'upline_user', 'upline_user_1', 'roles'])->whereNotIn('id', ['1','2','3'])->search($request)->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions_User', compact(
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('identity_type', function ($row) {
                return $row->identity_type ? User::IDENTITY_TYPE_SELECT[$row->identity_type] : '';
            });
            $table->editColumn('identity_no', function ($row) {
                return $row->identity_no ? $row->identity_no : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('gender', function ($row) {
                return $row->gender ? User::GENDER_SELECT[$row->gender] : '';
            });
            $table->addColumn('bank_list_code', function ($row) {
                return $row->bank_list ? $row->bank_list->code : '';
            });

            $table->editColumn('bank_name', function ($row) {
                return $row->bank_name ? $row->bank_name : '';
            });
            $table->editColumn('bank_account_name', function ($row) {
                return $row->bank_account_name ? $row->bank_account_name : '';
            });
            $table->editColumn('bank_account_number', function ($row) {
                return $row->bank_account_number ? $row->bank_account_number : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('user_type', function ($row) {
                return $row->user_type ? User::USER_TYPE_SELECT[$row->user_type] : '';
            });
            $table->editColumn('personal_code', function ($row) {
                return $row->personal_code ? $row->personal_code : '';
            });
            $table->addColumn('upline_user_name', function ($row) {
                return $row->upline_user ? $row->upline_user->name : '';
            });

            $table->addColumn('upline_user_1_name', function ($row) {
                return $row->upline_user_1 ? $row->upline_user_1->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? (($row->status == 1)? '<span class="badge bg-info">'.User::STATUS_SELECT[$row->status].'</span>':'<span class="badge bg-secondary">'.User::STATUS_SELECT[$row->status].'</span>') : '';
            });
            $table->editColumn('allow_order_status', function ($row) {
                return $row->allow_order_status ? (($row->allow_order_status == 1)? '<span class="badge bg-success">'.User::ALLOW_ORDER_STATUS_SELECT[$row->allow_order_status].'</span>':'<span class="badge bg-danger">'.User::ALLOW_ORDER_STATUS_SELECT[$row->allow_order_status].'</span>') : '';
            });

            $table->editColumn('account_verify', function ($row) {
                return $row->account_verify ? User::ACCOUNT_VERIFY_SELECT[$row->account_verify] : '';
            });
            $table->editColumn('ssm_verify', function ($row) {
                return $row->ssm_verify ? User::SSM_VERIFY_SELECT[$row->ssm_verify] : '';
            });
            $table->editColumn('first_payment', function ($row) {
                return $row->first_payment ? User::FIRST_PAYMENT_SELECT[$row->first_payment] : '';
            });
            $table->editColumn('profile_photo', function ($row) {
                if ($photo = $row->profile_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('ssm_photo', function ($row) {
                if ($photo = $row->ssm_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('ic_photo', function ($row) {
                if ($photo = $row->ic_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('first_payment_receipt_photo', function ($row) {
                if ($photo = $row->first_payment_receipt_photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

                $table->editColumn('roles', function ($row) {
                    $labels = [];
                    foreach ($row->roles as $role) {
                        $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                    }

                    return implode(' ', $labels);
                });

            $table->rawColumns(['actions', 'placeholder', 'bank_list', 'country', 'upline_user', 'upline_user_1', 'profile_photo', 'ssm_photo', 'ic_photo', 'first_payment_receipt_photo', 'roles', 'status', 'allow_order_status']);

            return $table->make(true);
        }

        if ($request->is('admin/merchants')) {
            return view('admin.users.merchant');
        } else if ($request->is('admin/agents')){
            return view('admin.users.agent');
        } else if ($request->is('admin/vips')) {
            return view('admin.users.vip');
        } else {
            return view('admin.users.merchant');
        }

    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_lists = BankList::pluck('bank_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::where('status', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        if (Route::is('admin.users.merchants.create')){
            $upline_users = User::whereHas('roles', function($q){
                $q->where('name','like', '%Merchant%');
            })->whereNotIn('id', ['1','2','3'])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else if (Route::is('admin.users.agents.create')){
            $upline_users = User::whereNotIn('id', ['1','2','3'])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else if (Route::is('admin.users.vips.create')) {
            $upline_users = User::whereNotIn('id', ['2','3'])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        } else {
            $upline_users = User::whereHas('roles', function($q){
                $q->where('name','like', '%Merchant%');
            })->whereNotIn('id', ['1','2','3'])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        $upline_user_1s = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upline_user_2s = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::whereGuardName('web')->pluck('name', 'id');

        return view('admin.users.create', compact('bank_lists', 'countries', 'upline_users', 'upline_user_1s', 'upline_user_2s', 'roles'));
    }

    public function fetchState(Request $request) {
        $country_id = $request->country_id;

        $states = State::where('country_id', $country_id)->where('status', 1)->get();

        return json_encode(['success' => true, 'states' => $states]);
    }

    public function store(StoreUserRequest $request)
    {

        DB::beginTransaction();
        try {
            $request->request->add(['personal_code' => PersonalCodeLog::generatePersonalCode(5)]);

            $bankList = BankList::findOrFail(request('bank_list_id'));
            $request->request->add(['bank_name' => $bankList->bank_name]);

            $upline = User::where('direct_upline_id', request('direct_upline_id'))->first();
            $direct_upline_id = request('direct_upline_id');
            if ($upline->user_type != 3) {
                $upline = User::find($upline->upline_user_id);
            }

            $request->request->add(['upline_user_id' => $upline->id]);
            $request->request->add(['upline_user_1_id' => $upline->upline_user_id]);
            $request->request->add(['upline_user_2_id' => $upline->upline_user_1_id]);

            $user = User::create($request->all());

            if (Route::is('admin.users.merchants.store')){
                $user->syncRoles(['Merchant-Millionaire']);

                $pointPackage = PointPackage::whereId(3)->first();

                UserEntry::create([
                    'user_id' => $user->id,
                    'user_type' => request('user_type'),
                    'deposit' => '3000',
                    'fee' => '0',
                    'top_up' => '0',
                    'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $user->id),
                    'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($user->id, $upline->id),
                ]);
                UserEntry::create([
                    'user_id' => $user->id,
                    'user_type' => request('user_type'),
                    'deposit' => '0',
                    'fee' => '6000',
                    'top_up' => '0',
                    'invoice_number' => DocumentNumberLog::generateDocumentNumber("1", $user->id),
                    'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($user->id, $upline->id),
                ]);
                UserEntry::create([
                    'user_id' => $user->id,
                    'user_type' => request('user_type'),
                    'deposit' => '0',
                    'fee' => '0',
                    'top_up' => $pointPackage->point,
                ]);
            }else if (Route::is('admin.users.merchants.store')) {
                if(request('user_type') == 1){
                    $user->syncRoles(['Agent-Executive']);
                    UserEntry::create([
                        'user_id' => $user->id,
                        'user_type' => request('user_type'),
                        'deposit' => '1000',
                        'fee' => '0',
                        'top_up' => '0',
                        'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $user->id),
                        'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($user->id, $upline->id),
                    ]);
                }else{
                    $user->syncRoles(['Agent-Manager']);
                    UserEntry::create([
                        'user_id' => $user->id,
                        'user_type' => request('user_type'),
                        'deposit' => '1000',
                        'fee' => '0',
                        'top_up' => '0',
                        'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $user->id),
                        'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($user->id, $upline->id),
                    ]);
                }
            } else {
                $user->syncRoles(['VIP']);

                AddressBook::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'address_1' => $request->address_1,
                    'address_2' => $request->address_2,
                    'city' => $request->city,
                    'state_id' => $request->state,
                    'postcode' => $request->postcode,
                    'set_default' => 1,
                    'status' => 1,
                ]);

                UserEntry::create([
                    'user_id' => $user->id,
                    'user_type' => request('user_type'),
                    'deposit' => '0',
                    'fee' => '0',
                    'top_up' => '0',
                ]);
            }

    //
            if ($request->input('profile_photo', false)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
            }

            if ($request->input('ssm_photo', false)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_photo'))))->toMediaCollection('ssm_photo');
            }

            if ($request->input('ic_photo', false)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ic_photo'))))->toMediaCollection('ic_photo');
            }

            if ($request->input('first_payment_receipt_photo', false)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('first_payment_receipt_photo'))))->toMediaCollection('first_payment_receipt_photo');
            }

            if ($request->input('shop_photo', false)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('shop_photo'))))->toMediaCollection('shop_photo');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $user->id]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }


        if (Route::is('admin.users.merchants.store')){
            return redirect()->route('admin.users.merchants');
        } else if (Route::is('admin.users.agents.store')){
            return redirect()->route('admin.users.agents');
        } else if (Route::is('admin.users.vips.store')) {
            return redirect()->route('admin.users.vips');
        } else {
            return redirect()->route('admin.users.merchants');
        }
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Route::is('admin.users.merchants.edit')){
            if(!str_contains($user->roles[0]->name , 'Merchant')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        }else if (Route::is('admin.users.agents.edit')){
            if(!str_contains($user->roles[0]->name , 'Agent')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        } else if (Route::is('admin.users.vips.edit')){
            if(!str_contains($user->roles[0]->name , 'VIP')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        } else {
            if(!str_contains($user->roles[0]->name , 'Merchant')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        }

        $bank_lists = BankList::pluck('bank_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::where('status', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upline_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upline_user_1s = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upline_user_2s = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::whereGuardName('web')->pluck('name', 'id');

        $user->load('bank_list', 'country', 'upline_user', 'upline_user_1', 'upline_user_2', 'roles');

        return view('admin.users.edit', compact('bank_lists', 'countries', 'upline_users', 'upline_user_1s', 'upline_user_2s', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $role = $user->roles[0]->name;

            $bankList = BankList::findOrFail(request('bank_list_id'));
            $request->request->add(['bank_name' => $bankList->bank_name]);

            $user->update($request->all());

            if (Route::is('admin.users.vips.update')){

            }

    //        $user->roles()->sync($request->input('roles', []));
            if ($request->input('profile_photo', false)) {
                if (!$user->profile_photo || $request->input('profile_photo') !== $user->profile_photo->file_name) {
                    if ($user->profile_photo) {
                        $user->profile_photo->delete();
                    }
                    $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
                }
            } elseif ($user->profile_photo) {
                $user->profile_photo->delete();
            }

            if ($request->input('ssm_photo', false)) {
                if (!$user->ssm_photo || $request->input('ssm_photo') !== $user->ssm_photo->file_name) {
                    if ($user->ssm_photo) {
                        $user->ssm_photo->delete();
                    }
                    $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_photo'))))->toMediaCollection('ssm_photo');
                }
            } elseif ($user->ssm_photo) {
                $user->ssm_photo->delete();
            }

            if ($request->input('ic_photo', false)) {
                if (!$user->ic_photo || $request->input('ic_photo') !== $user->ic_photo->file_name) {
                    if ($user->ic_photo) {
                        $user->ic_photo->delete();
                    }
                    $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('ic_photo'))))->toMediaCollection('ic_photo');
                }
            } elseif ($user->ic_photo) {
                $user->ic_photo->delete();
            }

            if ($request->input('first_payment_receipt_photo', false)) {
                if (!$user->first_payment_receipt_photo || $request->input('first_payment_receipt_photo') !== $user->first_payment_receipt_photo->file_name) {
                    if ($user->first_payment_receipt_photo) {
                        $user->first_payment_receipt_photo->delete();
                    }
                    $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('first_payment_receipt_photo'))))->toMediaCollection('first_payment_receipt_photo');
                }
            } elseif ($user->first_payment_receipt_photo) {
                $user->first_payment_receipt_photo->delete();
            }

            if ($request->input('shop_photo', false)) {
                if (!$user->shop_photo || $request->input('shop_photo') !== $user->shop_photo->file_name) {
                    if ($user->shop_photo) {
                        $user->shop_photo->delete();
                    }
                    $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('shop_photo'))))->toMediaCollection('shop_photo');
                }
            } elseif ($user->shop_photo) {
                $user->shop_photo->delete();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        if(str_contains($role, 'Merchant')){
            return redirect()->route('admin.users.merchants');
        } else if (str_contains($role, 'Agent')){
            return redirect()->route('admin.users.agents');
        } else if (str_contains($role, 'VIP')) {
            return redirect()->route('admin.users.vips');
        } else {
            return redirect()->route('admin.users.merchants');
        }

    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Route::is('admin.users.merchants.show')){
            if(!str_contains($user->roles[0]->name , 'Merchant')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        } else if (Route::is('admin.users.agents.show')){
            if(!str_contains($user->roles[0]->name , 'Agent')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        } else if (Route::is('admin.users.vips.show')) {
            if(!str_contains($user->roles[0]->name , 'VIP')){
                abort(Response::HTTP_NOT_FOUND, '404 Not found');
            }
        }

        $order = Order::where('user_id', $user->id)->get();
        $pending_order = Order::where('user_id', $user->id)->where('status', 1)->get()->count();
        $complete_order = Order::where('user_id', $user->id)->where('status', 5)->get()->count();
        $enquiry = Enquiry::where('user_id', $user->id)->get();
        $point_balance = Point::where('user_id', $user->id)->first();
        $userEntry = UserEntry::where('user_id', $user->id)->get();

        $totalTopUp = TransactionPointPurchase::where('user_id', $user->id)->where('status', 3)->sum('point');
        $topUps = TransactionPointPurchase::where('user_id', $user->id)->where('status', 3)->get();
        $user->load('bank_list', 'country', 'upline_user', 'upline_user_1', 'upline_user_2', 'roles', 'address_book', 'agreement');

        $totalWithdraw = TransactionPointWithdraw::where('user_id', $user->id)->where('status', 2)->sum('amount');
        $withdraws = TransactionPointWithdraw::where('user_id', $user->id)->where('status', 2)->get();

        return view('admin.users.show1', compact('user', 'point_balance', 'pending_order', 'complete_order','order','enquiry', 'userEntry', 'totalTopUp', 'topUps', 'totalWithdraw', 'withdraws'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function addressBookList(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // if(!str_contains($user->roles[0]->name , 'VIP')){
        //     abort(Response::HTTP_NOT_FOUND, '404 Not found');
        // }

        $user->load('address_book');

        return view('admin.users.address-book-list', compact('user'));
    }

    public function createAddressBook(Request $request, $userId)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::where('status', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create-address-book', compact('countries', 'userId'));
    }

    public function storeAddressBook(Request $request)
    {
        DB::beginTransaction();
        $userId = $request->user_id;
        try {
            $addressBook_default_exist = AddressBook::where('user_id', $userId)->where('set_default', 1)->count();

            $addressBook = AddressBook::create($request->all());

            if($addressBook_default_exist == 0){
                $addressBook->update([
                    'state_id' => $request->state,
                    'status' => 1,
                    'set_default' => 1,
                ]);
            }else{
                $addressBook->update([
                    'state_id' => $request->state,
                    'status' => 1,
                    'set_default' => 2,
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.users.address-book.list', ['user' => $userId]);
    }

    public function editAddressBook($id, User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address_book = AddressBook::findOrFail($id);
        $user = User::where('id', $address_book->user_id);
        $countries = Country::where('status', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.edit-address-book', compact('user', 'countries', 'address_book'));
    }

    public function updateAddressBook(Request $request, $id)
    {
        $addressBook = AddressBook::findOrFail($id);
        $userId = $addressBook->user_id;
        DB::beginTransaction();
        try {
            $addressBook->update($request->all());
            $addressBook->update([
                'state_id' => $request->state,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.users.address-book.list', ['user' => $userId]);
    }

    public function setAsDefault($id)
    {
        $userAddress = AddressBook::findOrFail($id);

        DB::beginTransaction();
        try {
            AddressBook::where('user_id', $userAddress->user_id)->update([
                'set_default' => 2,
            ]);

            AddressBook::where('id',$id)->update([
                'set_default' => 1,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.users.address-book.list', ['user' => $userAddress->user_id]);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function toAccountVerify(Request $request)
    {
        $model = User::findOrFail(request('id'));

        $model->update([
            'account_verify' => 2,
        ]);

        return back()->with('message', 'account');
    }

    public function toSsmVerify(Request $request)
    {
        $model = User::findOrFail(request('id'));
        $model->update([
            'ssm_verify' => 2,
        ]);

        return back()->with('message', 'account');
    }

    public function toFirstPayment(Request $request)
    {
        $model = User::findOrFail(request('id'));

        if(Carbon::now()->toDateTimeString() >= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
            $user_id = $model->id;

            if($model->user_type == 3) {
                $userEntry = UserEntry::whereUserId($user_id)->where('deposit', '=', 3000)->where('fee', '=', 15000)->first();
                if($userEntry) {
                    $product_variation_id = null; // TODO: Remember Update 大礼包的ID.
                    // addToCart($user_id, $product_variation_id, 1);
                }
            }
        }

        $model->update([
            'first_payment' => 2,
        ]);

        UserEntry::whereUserId($model->id)->whereDeposit(1000)->update([
            'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $model->id),
            'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($model->id),
        ]);

        return back()->with('message', 'account');
    }

    public function statusChange(Request $request)
    {
        $model = User::findOrFail(request('id'));
        $status = request('status');

        $model->update([
            'status' => ($status == 1)? "2":"1",
        ]);

        return back();
    }

    public function toShopVerify(Request $request)
    {
        $model = User::findOrFail(request('id'));
        $model->update([
            'shop_verify' => 2,
        ]);

        return back()->with('message', 'account');
    }

    public function shippingBalance(Request $request){

        foreach (User::role(['Agent-Executive','Agent-Manager'])->whereStatus(1)->cursor() as $item){
            $userShippingBalance = getUserShippingBalance($item->id);

            echo $item->name." - ".$item->personal_code." - ".$userShippingBalance."<br/>";

            if($userShippingBalance > 0){
                ShippingBalance::create([
                    'user_id' => $item->id,
                    'amount' => "-".$userShippingBalance,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Clear shipping balance for executive and manager',
                ]);
            }else if($userShippingBalance < 0){
                ShippingBalance::create([
                    'user_id' => $item->id,
                    'amount' => str_replace("-","",$userShippingBalance),
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => 'Clear shipping balance for executive and manager',
                ]);
            }
        }
    }


}
