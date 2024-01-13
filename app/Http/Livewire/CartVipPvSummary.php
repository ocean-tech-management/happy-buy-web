<?php

namespace App\Http\Livewire;

use App\Models\Cart as CartModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartVipPvSummary extends Component
{
    public $total_deduct_for_cash_voucher_count = 0;
    public $total_deduct_for_cash_voucher = 0;

    public $total_vip_price = 0;
    public $carts;
    public $selected_user_id;

    public $double_point;
    public $balance;

    protected $listeners = ['update_cart_vip_pv_summary' => 'calculation'];

    public function mount()
    {
        $this->calculation();
    }

    public function calculation()
    {
        $this->total_deduct_for_cash_voucher_count = 0;
        $this->total_vip_price = 0;

        $carts = CartModel::whereUserId(Auth::user()->id)->where('status', 1)
            ->whereIsPackage(2)
            ->where(function ($query) {
                if ($this->selected_user_id == Auth::user()->id) {
                    $query->where('to_user_id', Auth::user()->id)
                        ->orWhereNull('to_user_id');
                } else {
                    $query->where('to_user_id', $this->selected_user_id);
                }

            })->whereHas('product_variant', function ($q) {
                $q->whereIn('type', [1, 2]);
            })->get();

        foreach($carts as $key => $cart){
            if($cart->product_variant != NULL){
                if($cart->product_variant->type == 1){
                    $this->total_deduct_for_cash_voucher_count += $cart->quantity;
                }
                $this->total_vip_price += ($cart->product_variant->sales_price * $cart->quantity) ;
            }
        }


        $this->total_deduct_for_cash_voucher = ((intval($this->total_deduct_for_cash_voucher_count/5) * 100) + ($this->total_deduct_for_cash_voucher_count % 5 * 15));
        $this->balance = 0;
        if(getCashVoucherBalance($this->selected_user_id) > $this->total_deduct_for_cash_voucher){
            $this->balance = getCashVoucherBalance($this->selected_user_id) - $this->total_deduct_for_cash_voucher;
        }else{
            $this->total_deduct_for_cash_voucher = getCashVoucherBalance($this->selected_user_id);
        }

        $this->double_point = false;
        $cart_user = User::find($this->selected_user_id);
        if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
            if(!checkIfVIPOrderedThisMonth($this->selected_user_id)){
                $this->total_deduct_for_cash_voucher = 0;
                $this->double_point = true;

                $this->total_deduct_for_cash_voucher += (intval($this->total_deduct_for_cash_voucher_count/5) * 160);
                $item_left = $this->total_deduct_for_cash_voucher_count % 5;
                if($item_left <= 3){
                    $this->total_deduct_for_cash_voucher += $item_left * 25;
                }else if($item_left == 4){
                    $this->total_deduct_for_cash_voucher += 90;
                }
                $this->balance = 0;
                if(getCashVoucherBalance($this->selected_user_id) > $this->total_deduct_for_cash_voucher){
                    $this->balance = getCashVoucherBalance($this->selected_user_id) - $this->total_deduct_for_cash_voucher;
                }else{
                    $this->total_deduct_for_cash_voucher = getCashVoucherBalance($this->selected_user_id);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.cart-vip-pv-summary');
    }
}
