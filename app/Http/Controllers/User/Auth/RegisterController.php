<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\AddressBook;
use App\Models\BankList;
use App\Models\BonusJoin;
use App\Models\CashVoucherBalance;
use App\Models\Country;
use App\Models\DocumentMBRInvoiceLog;
use App\Models\PayoutLimit;
use App\Models\PersonalCodeLog;
use App\Models\Point;
use App\Models\PointBonusBalance;
use App\Models\PointExecutiveBalance;
use App\Models\Role;
use App\Models\State;
use App\Models\TransactionBonusGiven;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\UserAgreement;
use App\Models\UserAgreementLog;
use App\Models\UserEntry;
use App\Models\VoucherBalance;
use App\Models\DocumentNumberLog;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentReceiptLog;
use App\Sms\Nexmo;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers, MediaUploadingTrait;

    protected $redirectTo = '/user/agreement';

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showRegistrationForm()
    {
        $bank_list = BankList::all();
        $countries = Country::where('status', 1)->get();
        $roles = Role::whereGuardName('user')->pluck('name', 'id');
        return view('user.auth.register', ['countries' => $countries, 'roles' => $roles, 'bank_list' => $bank_list]);
    }

    public function getStates(Request $request)
    {
        $country_id = $request->country_id;

        $states = State::where('country_id', $country_id)->where('status', 1)->get();

        return json_encode(['success' => true, 'states' => $states]);
    }

    public function showAgreement()
    {
        $user_agreement = UserAgreement::where('role_id', Auth::user()->roles[0]->id)->first();

        return view('user.auth.agreement', compact('user_agreement'));
    }

    public function agreeAgreement(Request $request)
    {
        UserAgreementLog::create([
            'user_agreement_id' => $request->user_agreement_id,
            'user_id' => Auth::user()->id,
            'signature_name' => $request->fullname,
            'signature_ic' => $request->identity_id,
            'signature_at' => Carbon::now(),
        ]);

        return redirect(route('user.registerOTP'));
    }

    public function registrationComplete()
    {
        return view('user.auth.register-complete');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string'],
            'gender' => ['required', 'int'],
            'identity_type' => ['required', 'int'],
            'identity_no' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'address2' => ['string', 'max:255', 'nullable'],
            'country' => ['required', 'int'],
            'state' => ['required', 'int'],
            'postcode' => ['required', 'string', 'min:4', 'max:8'],
            'city' => ['required', 'string'],

            'bank' => ['required', 'int'],
            'bank_account' => ['required', 'string'],
            'beneficiary_name' => ['required', 'string'],

            'ranking_id' => ['required'],
//            'payment_date' => ['required', 'string'],
            'ref_code' => ['required', 'string'],
//            'first_payment_receipt' => ['required'],
        ]);
    }


    public function register(Request $request)
    {
        //validate phone number format
        $return = Nexmo::numberInsight($request->formatted_phone);

        if ($return['status'] == 0) {
            $request->request->add(['phone' => $return['international_format_number']]);
        } else {
            return redirect()->back()->withErrors(['phone' => __('user-portal.please_enter_a_valid_phone_number')])->withInput();
        }

        $this->validator($request->all())->validate();

        $ranking_id = $request->ranking_id;

        //check ref_code valid
        $upline = User::where('personal_code', strtoupper($request->ref_code))->first();
        if ($upline) {
            if($ranking_id == 2 || $ranking_id == 4){
                if ($upline->roles[0]->id != 2){
                    return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
                }else{
                    if ($upline->status == 2) {
                        return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
                    } else if ($upline->roles[0]->id == 3) { //executive does not hv any downline
                        return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
                    }
                }
            }else if($ranking_id == 2){
                if ($upline->roles[0]->id != 2 || $upline->roles[0]->id != 4){
                    return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
                }else{
                    if ($upline->status == 2) {
                        return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
                    } else if ($upline->roles[0]->id == 3) { //executive does not hv any downline
                        return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
                    }
                }
            }
        } else {
            return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
        }

        event(new Registered($user = $this->create($request->all())));



        $user->roles()->sync($ranking_id);

        if ($request->input('first_payment_receipt', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('first_payment_receipt'))))->toMediaCollection('first_payment_receipt_photo');
        }

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $upline = User::where('personal_code', $data['ref_code'])->first();
        $direct_upline = User::where('personal_code', $data['ref_code'])->first();

        //this one is for merchant upline listing
        if ($upline->user_type != 3) {
            $upline = User::find($upline->upline_user_id);
        }

        $upline_user_id = $upline->id;
        $upline_user_1_id = $upline->upline_user_id;
        $upline_user_2_id = $upline->upline_user_1_id;

        $personal_code = PersonalCodeLog::generatePersonalCode(5);

        $ranking_id = $data['ranking_id'];

        if($ranking_id == 3){
            $user_type = 1; //silver
        }else if($ranking_id == 4){
            $user_type = 2; //Gold
        }else if($ranking_id == 2){
            $user_type = 3; //Diamond
        }

        $user = User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'identity_type' => $data['identity_type'],
            'identity_no' => $data['identity_no'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'date_of_birth' => $data['birthday'],
            'gender' => $data['gender'],
            'user_type' => $user_type,
            'status' => 2,
            'country_id' => $data['country'],
            'personal_code' => $personal_code,
            'direct_upline_id' => $direct_upline->id,
            'upline_user_id' => $upline_user_id,
            'upline_user_1_id' => $upline_user_1_id,
            'upline_user_2_id' => $upline_user_2_id,
            'new_sign_required' => 1, // No
        ]);

        AddressBook::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'address_1' => $data['address'],
            'address_2' => $data['address2'],
            'city' => $data['city'],
            'state_id' => $data['state'],
            'postcode' => $data['postcode'],
            'set_default' => 1,
            'status' => 1,
        ]);

        $bank = BankList::find($data['bank']);
        $user->update([
            'bank_name' => $bank->bank_name,
            'bank_account_name' => $data['beneficiary_name'],
            'bank_account_number' => $data['bank_account'],
            'bank_list_id' => $bank->id,
        ]);

        Point::create([
            'point_balance' => 0,
            'point_manager_balance' => 0,
            'point_executive_balance' => 0,
            'point_bonus_balance' => 0,
            'shipping_balance' => 0,
            'voucher_balance' => 0,
            'cash_voucher_balance' => 0,
            'pv_balance' => 0,
            'user_id' => $user->id,
        ]);

        if($ranking_id == 2){
//            $deposit = 3000; // Need Change?
//            $fee = 15000;
//            $top_up = 0;
//
//            //last record of UserEntry for deposit
//            $lastUserEntry = UserEntry::where('deposit' , '!=' , 0)->where('total', '!=' , 0)->orderBy('created_at', 'desc')->first();
//            $total = $lastUserEntry->deposit + $deposit;
//
//            //  $documentMBRInvoiceLog = DocumentMBRInvoiceLog::generateDocumentNumber($user->id, null, Date('y'), $deposit, null, null);
//
//            UserEntry::create([
//                'user_id' => $user->id,
//                'user_type' => 1,
//                'deposit' => $deposit,
//                'fee' => $fee,
//                'top_up' => $top_up,
//                'total' => $total,
//                'receipt_number' => DocumentNumberLog::generateDocumentNumber("2", $user->id),
//                'new_receipt_number' => DocumentReceiptLog::generateDocumentNumber($user->id),
//            ]);
        }


        return $user;
    }

    public function showRegisterVIPForm()
    {

        $bank_list = BankList::all();
        $countries = Country::where('status', 1)->get();
        $roles = Role::whereGuardName('user')->pluck('name', 'id');

        //one 688 == 1 voucher
        $cash_voucher_count = getCashVoucherBalance(Auth::guard('user')->user()->id) / 688;

        if(Auth::user()->user_type == 4){
            return redirect()->back();
        }

        return view('user.auth.register-vip', ['countries' => $countries, 'roles' => $roles, 'bank_list' => $bank_list, 'cash_voucher_count' => $cash_voucher_count]);
    }

    public function registerVIP(Request $request){

        //one 688 == 1 voucher
        $cash_voucher_count = getCashVoucherBalance(Auth::guard('user')->user()->id) / 688;
        if($cash_voucher_count <= 0){
            return redirect()->back()->withErrors(['voucher' => __('user-portal.you_dont_have_enough_voucher_to_create_vip')])->withInput();
        }

        //validate phone number format
        $return = Nexmo::numberInsight($request->formatted_phone);

        if ($return['status'] == 0) {
            $request->request->add(['phone' => $return['international_format_number']]);
        } else {
            return redirect()->back()->withErrors(['phone' => __('user-portal.please_enter_a_valid_phone_number')])->withInput();
        }

        $this->validatorVIP($request->all())->validate();

        //check ref_code valid
        $upline = User::where('personal_code', strtoupper($request->ref_code))->first();
        if ($upline) {
            if ($upline->status == 2) {
                return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
            } else if ($upline->roles[0]->id != 2 && $upline->roles[0]->id != 3 && $upline->roles[0]->id != 4) { //all agent can register user, but beyond that cannot
                return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
            }
        }else{
            return redirect()->back()->withErrors(['ref_code' => __('user-portal.please_enter_a_valid_referral_code')])->withInput();
        }

        event(new Registered($user = $this->createVIP($request->all())));

        $user->roles()->sync(8);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath())->with('message', __('user-portal.register_vip_successful'));
    }

    protected function validatorVIP(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string'],
            'gender' => ['required', 'int'],
            'identity_type' => ['required', 'int'],
            'identity_no' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'address2' => ['string', 'max:255', 'nullable'],
            'country' => ['required', 'int'],
            'state' => ['required', 'int'],
            'postcode' => ['required', 'string', 'min:4', 'max:8'],
            'city' => ['required', 'string'],

//            'bank' => ['required', 'int'],
//            'bank_account' => ['required', 'string'],
//            'beneficiary_name' => ['required', 'string'],

            'ref_code' => ['required', 'string'],
        ]);
    }

    protected function createVIP(array $data)
    {
        $upline = User::where('personal_code', $data['ref_code'])->first();
        $direct_upline = User::where('personal_code', $data['ref_code'])->first();

        //this one is for merchant upline listing
        if ($upline->user_type != 3) {
            $upline = User::find($upline->upline_user_id);
        }

        $upline_user_id = $upline->id;
        $upline_user_1_id = $upline->upline_user_id;
        $upline_user_2_id = $upline->upline_user_1_id;

        $personal_code = PersonalCodeLog::generatePersonalCode(5);

        $user = User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'identity_type' => $data['identity_type'],
            'identity_no' => $data['identity_no'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'date_of_birth' => $data['birthday'],
            'gender' => $data['gender'],
            'user_type' => 4,
            'status' => 2,
            'country_id' => $data['country'],
            'personal_code' => $personal_code,
            'direct_upline_id' => $direct_upline->id,
            'upline_user_id' => $upline_user_id,
            'upline_user_1_id' => $upline_user_1_id,
            'upline_user_2_id' => $upline_user_2_id,
            'new_sign_required' => 1, // No
        ]);

        AddressBook::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'address_1' => $data['address'],
            'address_2' => $data['address2'],
            'city' => $data['city'],
            'state_id' => $data['state'],
            'postcode' => $data['postcode'],
            'set_default' => 1,
            'status' => 1,
        ]);

//        $bank = BankList::find($data['bank']);
//        $user->update([
//            'bank_name' => $bank->bank_name,
//            'bank_account_name' => $data['beneficiary_name'],
//            'bank_account_number' => $data['bank_account'],
//            'bank_list_id' => $bank->id,
//        ]);

        Point::create([
            'point_balance' => 0,
            'point_manager_balance' => 0,
            'point_executive_balance' => 0,
            'point_bonus_balance' => 0,
            'shipping_balance' => 0,
            'voucher_balance' => 0,
            'cash_voucher_balance' => 0,
            'pv_balance' => 0,
            'user_id' => $user->id,
        ]);


        $deposit = 0;
        $fee = 0;
        $top_up = 0;

        //last record of UserEntry for deposit
        $lastUserEntry = UserEntry::where('deposit' , '!=' , 0)->where('total', '!=' , 0)->orderBy('created_at', 'desc')->first();
        $total = $lastUserEntry->deposit;


        UserEntry::create([
            'user_id' => $user->id,
            'user_type' => 4,
            'deposit' => $deposit,
            'fee' => $fee,
            'total' => $total,
            'top_up' => $top_up,
        ]);

        CashVoucherBalance::create([
            'amount' => '-688',
            'status' => '1',
            'settlement' => '1',
            'remark' => 'Create New VIP, user id:' . $user->id,
            'user_id' => Auth::guard('user')->user()->id,
        ]);

        CashVoucherBalance::create([
            'amount' => '688',
            'status' => '1',
            'settlement' => '1',
            'remark' => 'New VIP' . $user->id,
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
