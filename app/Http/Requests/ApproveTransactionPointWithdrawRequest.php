<?php

namespace App\Http\Requests;

use App\Models\TransactionPointWithdraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApproveTransactionPointWithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_point_withdraw_to_approve');
    }

    public function rules()
    {
        return [
            'receipt' => [
                (Request::input('status') == "1")? 'required':'',
            ],
        ];
    }
}
