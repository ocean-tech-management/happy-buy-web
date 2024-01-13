<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BankList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function bankSetting()
    {
        $bank_list = BankList::all();
        return view('user.bank-setting', compact('bank_list'));
    }

    public function bankUpdate(Request $request)
    {
        $user = Auth::user();
        $bank = BankList::find($request->bank);
        $user->update([
           'bank_name' => $bank->bank_name,
           'bank_account_name' => $request->beneficiary_name,
           'bank_account_number' => $request->bank_account,
            'bank_list_id' => $bank->id,
        ]);
        return redirect(route('user.bank-setting'))->with('message', __('global.update_profile_success'));
    }
}
