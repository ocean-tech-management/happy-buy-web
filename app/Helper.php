<?php

use App\Models\AddressBook;
use App\Models\BonusGroup;
use App\Models\BonusPersonal;
use App\Models\BonusTopUpPersonal;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Cart;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\CashVoucherBalance;
use App\Models\PvBalance;
use App\Models\PointTransactionLog;
use App\Models\ProductCategory;
use App\Models\ProductQuantity;
use App\Models\ProductVariant;
use App\Models\ShippingBalance;
use App\Models\TransactionAgentTopUp;
use App\Models\TransactionBonusGiven;
use App\Models\Point;
use App\Models\PointBalance;
use App\Models\PointBonusBalance;
use App\Models\TransactionPointPurchase;
use App\Models\TransactionPointWithdraw;
use App\Models\TransactionShippingPurchase;
use App\Models\User;
use App\Models\UserAgreementLog;
use App\Models\UserEntry;
use App\Models\VoucherBalance;
use App\Models\VoucherLog;
use App\Models\BonusTeamCar;
use App\Models\BonusTeamHouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function getInactiveMerchantCount(){
    $model = User::whereHas(
        'roles', function($q){
            $q->where('name','like', '%Merchant%');
        }
    )->whereNotIn('id', ['1','2','3'])->where('status','=', '2')->count();
    return $model;
}

function getInactiveAgentCount(){
    $model = User::whereHas(
        'roles', function($q){
        $q->where('name','like', '%Agent%');
    }
    )->whereNotIn('id', ['1','2','3'])->where('status','=', '2')->count();
    return $model;
}

function getInactiveVIPCount(){
    $model = User::whereHas(
        'roles', function($q){
        $q->where('name','like', '%VIP%');
    }
    )->whereNotIn('id', ['1','2','3'])->where('status','=', '2')->count();
    return $model;
}

function getAllInactiveUserCount(){
    $model = User::whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%')
            ->orWhere('name','like', '%Agent%');
    }
    )->whereNotIn('id', ['1','2','3'])->where('status','=', '2')->count();
    return $model;
}



function getAllOrderCount(){
    $model = Order::where(function ($query) {
        $query->where('status', '=', 1)
            ->orWhere('status', '=', 2)
            ->orWhere('status', '=', 3);
    })->count();

    return $model;
}

function getNewOrderCount(){
    $model = Order::where(function ($query) {
        $query->where('status', '=', 1);
    })->count();

    return $model;
}

function getShippedOrderCount(){
    $model = Order::where(function ($query) {
        $query->where('status', '=', 2);
    })->count();

    return $model;
}

function getPickedUpOrderCount(){
    $model = Order::where(function ($query) {
        $query->where('status', '=', 3);
    })->count();

    return $model;
}

function getUserPointBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('point_balance') ?? 0;
    $point_balance = PointBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserManagerPointBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('point_manager_balance') ?? 0;
    $point_balance = PointManagerBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserExecutivePointBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('point_executive_balance') ?? 0;
    $point_balance = PointExecutiveBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserPointManagerBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('point_manager_balance') ?? 0;
    $point_balance = PointManagerBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserPointExecutiveBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('point_executive_balance') ?? 0;
    $point_balance = PointExecutiveBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserPointBonusBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('point_bonus_balance') ?? 0;
    $point_balance = PointBonusBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserVoucherBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('voucher_balance') ?? 0;
    $point_balance = VoucherBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getCashVoucherBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('cash_voucher_balance') ?? 0;
    $point_balance = CashVoucherBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getPvBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('pv_balance') ?? 0;
    $point_balance = PvBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getUserVoucherLog($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('voucher_log') ?? 0;
    $point_balance = VoucherLog::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getCustomUserPointBalance($user_id, $date){

    $point_balance = PointBalance::whereUserId($user_id)->where('created_at', '<=', $date)->sum('amount');
    return $point_balance;

}


function getUserTotalVoucherBalanceGet($user_id){

    $point_balance = VoucherBalance::whereUserId($user_id)->where('amount' , '>', 0)->sum('amount');

    return $point_balance;
}

function addUserVoucherBalance($user_id, $amount, $remark){

    $voucherBalance = getUserVoucherBalance($user_id);
    $processAmount = 0;

    $user = User::whereId($user_id)->first();

    $quota = 27000;
    if($user->created_at >= '2022-08-01 00:00:00'){

        $quota = 18000;
        if(Carbon::now() >= "2023-03-31 00:00:00" && Carbon::now() <= "2023-03-31 23:59:59"){
            $processAmount = ($amount * 0.1) * 2;
        }else{
            $processAmount = $amount * 0.1;
        }
    }else{
        $quota = 27000;
        if($amount == 18000){
            if(Carbon::now() >= "2023-03-31 00:00:00" && Carbon::now() <= "2023-03-31 23:59:59"){
                $processAmount = 2700 * 2;
            }else{
                $processAmount = 2700;
            }
        }elseif ($amount == 9000){
            if(Carbon::now() >= "2023-03-31 00:00:00" && Carbon::now() <= "2023-03-31 23:59:59"){
                $processAmount = 1350 * 2;
            }else{
                $processAmount = 1350;
            }
        }
    }

    if ($voucherBalance >= $quota) {

    }elseif (($voucherBalance + $processAmount) >= $quota){
        VoucherBalance::create([
            'user_id' => $user_id,
            'amount' => $quota - $voucherBalance,
            'status' => '1',
            'settlement' => '1',
            'remark' => $remark
        ]);
    }else{
        VoucherBalance::create([
            'user_id' => $user_id,
            'amount' => $processAmount,
            'status' => '1',
            'settlement' => '1',
            'remark' => $remark
        ]);
    }
}

function addUserVoucherLog($user_id, $amount, $remark){

    $voucherBalance = getUserVoucherLog($user_id);
    $processAmount = $amount * 0.1;

    $user = User::whereId($user_id)->first();

    if($user->created_at != null)
    {
        if(Carbon::parse($user->created_at)->toDateTimeString() >= Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString()) {
            $userVoucherLog = 18000;
            $processAmount = $amount * 0.1;
        } else {
            $userVoucherLog = 27000;
            $processAmount = 2700;
        }
    } else {
        $userVoucherLog = 27000;
        $processAmount = 2700;
    }


    if ($voucherBalance >= $userVoucherLog) {

    }elseif (($voucherBalance + $processAmount) >= $userVoucherLog){
        VoucherLog::create([
            'user_id' => $user_id,
            'amount' => $userVoucherLog - $voucherBalance,
            'status' => '1',
            'settlement' => '1',
            'remark' => $remark
        ]);
    }else{
        VoucherLog::create([
            'user_id' => $user_id,
            'amount' => $processAmount,
            'status' => '1',
            'settlement' => '1',
            'remark' => $remark
        ]);
    }
}

function getUserShippingBalance($user_id){

    $user_point = (float)Point::whereUserId($user_id)->value('shipping_balance') ?? 0;
    $point_balance = ShippingBalance::whereUserId($user_id)->whereSettlement(1)->sum('amount');

    return $user_point+$point_balance;

}

function getCategories(){
    return ProductCategory::all();
}

function getUserDefaultAddress($user_id){
    $address_book = AddressBook::where('user_id', $user_id)->where('set_default', 1)->first();

    return $address_book;
}

function getCartItems($user_id){
    $carts = Cart::whereUserId($user_id)->where('status', 1)
        ->where(function ($query) {
            $query->where('to_user_id', Auth::guard('user')->user()->id)
                ->orWhereNull('to_user_id');
        })->get();

    return $carts;
}

function getReferralBonus($user_id){

    $bonus = TransactionBonusGiven::whereType(1)->whereStatus(1)->count();
    return $bonus;
}

function getPersonalTopupBonus($user_id){

    $bonusTopUpPersonal = BonusTopUpPersonal::whereId(1)->first();

    $startDate = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
    $endDate = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

    $selfTopUp = TransactionPointPurchase::whereUserId($user_id)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->first();

    if($selfTopUp){

        $downlines = User::where(function($q) use ($user_id){
            $q->where('upline_user_id','=', $user_id);
        })->pluck('id');

        $topUpPurchase = TransactionPointPurchase::whereIn('user_id', $downlines)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

        $downlines2 = User::where(function($q) use ($user_id){
            $q->where('upline_user_1_id','=', $user_id);
        })->pluck('id');

        $topUpPurchase2 = TransactionPointPurchase::whereIn('user_id', $downlines2)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->count();

        return ($topUpPurchase * $bonusTopUpPersonal->first_upline_bonus) + ($topUpPurchase2 * $bonusTopUpPersonal->second_upline_bonus);
    }else {
        return 0;
    }
}

function getTeamTopupBonus($user_id){
    $bonus = TransactionBonusGiven::whereType(3)->whereStatus(1)->count();
    return $bonus;
}

function getPersonalAnnualSales($user_id, $limit = true){

    $bonusPersonal = BonusPersonal::whereId(1)->first();

    $model = User::with(['agreement'])->whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%');
    })->whereId($user_id)->first();

    if($model){
        if(count($model->agreement) > 0){
            $date = "";
            $endDate = "";
            foreach ($model->agreement as $agreement){
                if ($agreement->user_agreement_id == 3){
                    $date = Carbon::parse($agreement->signature_at)->format('Y-m-d');
                    $endDate = Carbon::parse($agreement->signature_at)->addYear()->format('Y-m-d');
                }
            }

            if ($date != ""){
                $pointTransactionLog = PointTransactionLog::whereUserId($user_id)->where('date', '>=', $date)->where('date', '<', $endDate)->sum(DB::raw("top_up + point_convert"));
                if($limit){
                    return $pointTransactionLog."/".number_format($bonusPersonal->point);
                }else{
                    return $pointTransactionLog;
                }
            }else{
                if($limit){
                    return "0/".number_format($bonusPersonal->point);
                }else{
                    return "00";
                }
            }
        }else{
            if($limit){
                return "0/".number_format($bonusPersonal->point);
            }else{
                return "00";
            }
        }
    }else{
        if($limit){
            return "0/".number_format($bonusPersonal->point);
        }else{
            return "00";
        }
    }
}

function getPersonalAnnualClaimedBonus($user_id){

    $model = User::with(['agreement'])->whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%');
    })->whereId($user_id)->first();

    if($model){
        if(count($model->agreement) > 0){
            $date = "";
            $endDate = "";
            foreach ($model->agreement as $agreement){
                if ($agreement->user_agreement_id == 3){
                    $date = Carbon::parse($agreement->signature_at)->format('Y-m-d');
                    $endDate = Carbon::parse($agreement->signature_at)->addYear()->format('Y-m-d');
                }
            }

            if ($date != ""){
                $transactionBonusGiven = TransactionBonusGiven::whereUserId($user_id)->whereType(4)->where('given_at', '>=', $date)->where('given_at', '<', $endDate)->first();

                if($transactionBonusGiven){
                    return number_format($transactionBonusGiven->amount);
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function getPersonalAnnualBonus($user_id){

    $bonusPersonal = BonusPersonal::whereId(1)->first();

    $model = User::with(['agreement'])->whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%');
    })->whereId($user_id)->first();

    if($model){
        if(count($model->agreement) > 0){
            $date = "";
            $endDate = "";
            foreach ($model->agreement as $agreement){
                if ($agreement->user_agreement_id == 3){
                    $date = Carbon::parse($agreement->signature_at)->format('Y-m-d');
                    $endDate = Carbon::parse($agreement->signature_at)->addYear()->format('Y-m-d');
                }
            }

            if ($date != ""){
                $pointTransactionLog = PointTransactionLog::whereUserId($user_id)->where('date', '>=', $date)->where('date', '<', $endDate)->sum(DB::raw("top_up + point_convert"));

                if ($pointTransactionLog > $bonusPersonal->point){
                    return $pointTransactionLog * ($bonusPersonal->percent/100);
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function getGroupAnnualSales($user_id){

    $bonusGroup = BonusGroup::whereId(1)->first();

    $model = User::with(['agreement'])->whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%');
    })->whereId($user_id)->first();

    if($model){
        if(count($model->agreement) > 0){

            $downlines = User::with(['agreement'])->where(function($q) use ($user_id){
                $q->where('upline_user_id','=', $user_id)
                    ->orWhere('upline_user_1_id','=', $user_id)
                    ->orWhere('upline_user_2_id','=', $user_id);
            })->get();

            $totalBonus = 0;

            foreach ($downlines as $downline){
                if(count($downline->agreement) > 0){
                    $date = "";
                    $endDate = "";
                    foreach ($downline->agreement as $agreement){
                        if ($agreement->user_agreement_id == 3){
                            $date = Carbon::parse($agreement->signature_at)->format('Y-m-d');
                            $endDate = Carbon::parse($agreement->signature_at)->addYear()->format('Y-m-d');
                        }
                    }

                    if ($date != ""){
                        $pointTransactionLog = PointTransactionLog::whereUserId($downline->id)->where('user_id', '!=', $user_id)->where('date', '>=', $date)->where('date', '<', $endDate)->sum('top_up');
                        $totalBonus = $totalBonus +$pointTransactionLog;
                    }
                }
            }
            return $totalBonus."/".number_format($bonusGroup->point);
        }else{
            return "0/".number_format($bonusGroup->point);
        }
    }else{
        return "0/".number_format($bonusGroup->point);
    }
}

function getGroupAnnualClaimedBonus($user_id){

    $model = User::with(['agreement'])->whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%');
    })->whereId($user_id)->first();

    if($model){
        if(count($model->agreement) > 0){
            $date = "";
            $endDate = "";
            foreach ($model->agreement as $agreement){
                if ($agreement->user_agreement_id == 3){
                    $date = Carbon::parse($agreement->signature_at)->format('Y-m-d');
                    $endDate = Carbon::parse($agreement->signature_at)->addYear()->format('Y-m-d');
                }
            }

            if ($date != ""){
                $transactionBonusGiven = TransactionBonusGiven::whereUserId($user_id)->whereType(5)->where('given_at', '>=', $date)->where('given_at', '<', $endDate)->first();

                if($transactionBonusGiven){
                    return number_format($transactionBonusGiven->amount);
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function getGroupAnnualBonus($user_id){

    $model = User::with(['agreement'])->whereHas(
        'roles', function($q){
        $q->where('name','like', '%Merchant%');
    })->whereId($user_id)->first();

    if($model){
        if(count($model->agreement) > 0){

            $downlines = User::with(['agreement'])->where(function($q) use ($user_id){
                $q->where('upline_user_id','=', $user_id)
                ->orWhere('upline_user_1_id','=', $user_id)
                ->orWhere('upline_user_2_id','=', $user_id);
            })->get();

            $totalBonus = 0;

            foreach ($downlines as $downline){
                if(count($downline->agreement) > 0){
                    $date = "";
                    $endDate = "";
                    foreach ($downline->agreement as $agreement){
                        if ($agreement->user_agreement_id == 3){
                            $date = Carbon::parse($agreement->signature_at)->format('Y-m-d');
                            $endDate = Carbon::parse($agreement->signature_at)->addYear()->format('Y-m-d');
                        }
                    }

                    if ($date != ""){
                        $pointTransactionLog = PointTransactionLog::whereUserId($downline->id)->where('date', '>=', $date)->where('date', '<', $endDate)->sum('top_up');
                        $totalBonus = $totalBonus +$pointTransactionLog;
                    }
                }
            }
            return $totalBonus;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function getSelfMonthlyTopupAmount($user_id){

    $model = User::with(['agreement'])->whereId($user_id)->first();

    if($model){

        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (strpos($model->roles[0]->name, 'Merchant') !== false) {

            $transactionPointPurchase = TransactionPointPurchase::whereUserId($user_id)->whereStatus(3)->where('payment_verified_at', '>=', $startDate)->where('payment_verified_at', '<=', $endDate)->sum('point');

            return number_format($transactionPointPurchase);
        }else{

            $transactionAgentTopup = TransactionAgentTopUp::whereUserId($user_id)->whereStatus(2)->where('approved_at', '>=', $startDate)->where('approved_at', '<=', $endDate)->sum('amount');

            return number_format($transactionAgentTopup);
        }

    }else{
        return 0;
    }
}

function getOrderReadyForPickup($order_id){

    $order = Order::whereId($order_id)->first();

    $product_count = 0;
    $quantity_count = 0;
    foreach ($order->order_item as $item)
    {
        $product_count += count($item->product_detail);
        $quantity_count += $item->product_quantity;
    }

    if ($product_count != $quantity_count){
        return 0;
    }else{
        return 1;
    }
}

function getNewPurchaseCount(){
    $purchase = TransactionPointPurchase::where(function ($query) {
        $query->where('status', '=', 2)
            ->where('type', '=', 1);
    })->count();

    return $purchase;
}

function getNewUserUpgradeCount(){
    $purchase = TransactionPointPurchase::where(function ($query) {
        $query->where('status', '=', 2)
            ->where('type', '=', 2);
    })->count();

    return $purchase;
}

function getNewUserUpgradeCount2(){
    $user_entry = UserEntry::where('status', 2)->where('created_at', '>=',  Carbon::createFromFormat('Y-m-d', '2022-08-01')->startOfDay()->toDateTimeString())->count();

    return $user_entry;
}

function getNewWithdrawCount(){
    $withdraw = TransactionPointWithdraw::where(function ($query) {
        $query->where('status', '=', 1);
    })->count();

    return $withdraw;
}

function getProcessingWithdrawCount(){
    $withdraw = TransactionPointWithdraw::where(function ($query) {
        $query->where('status', '=', 4);
    })->count();

    return $withdraw;
}

function getAllWithdrawCount(){
    $withdraw = TransactionPointWithdraw::where(function ($query) {
        $query->where('status', '=', 1)
        ->orWhere('status', '=', 4);
    })->count();

    return $withdraw;
}

function getNewShippingPurchaseCount(){
    $purchase = TransactionShippingPurchase::where(function ($query) {
        $query->where('status', '=', 2);
    })->count();

    return $purchase;
}

function getProductVariantStock($product_variant_id){

    $productQuantity = ProductQuantity::whereProductVariantId($product_variant_id)->whereStatus(2)->count();

    return $productQuantity;
}

function getUserDepositSum($user_id){
    return UserEntry::whereUserId($user_id)->orderBy('created_at', 'desc')->sum('deposit');
}

function getUserDeposits($user_id){
    return UserEntry::whereUserId($user_id)->where('deposit', '!=', '0')->orderBy('created_at', 'desc')->get();
}

function getUserJoiningFee($user_id){
    return UserEntry::whereUserId($user_id)->where('fee', '!=', '0')->orderBy('created_at', 'desc')->sum('fee');
}

function getDiscountPercent(){

    $discount = Discount::whereStatus(1)->where('start_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))->where('end_time', '>=', Carbon::now()->format('Y-m-d H:i:s'))->first();

    return ($discount == null)? 0:$discount->percent ;
}


function getRequestPointActiveCount(){
    $user = Auth::user();

    if($user){
        if (Auth::user()->roles[0]->id == 2 || Auth::user()->roles[0]->id == 4) {
            $count = TransactionAgentTopUp::where('merchant_id', Auth::user()->id)->where('type', 1)->where('status', 1)->orderBy('created_at', 'desc')->count();
            return $count;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function getPendingUpgradeDownlines(){
    $user = Auth::user();

    if($user){
        if (Auth::user()->roles[0]->id == 2) {
            $count = TransactionAgentTopUp::where('merchant_id', $user->id)->where('type', 2)->where('status', 1)->orderBy('created_at', 'desc')->count();
            return $count;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function addToCart($user_id, $product_variant_id, $quantity){
    //important: do not call promotionItemUpdate() function here!
    $variant = ProductVariant::findOrFail($product_variant_id);

    //check if item already exist in cart
    $current_cart_with_selected_product_n_variant = Cart::where('user_id', $user_id)->where('product_variant_id', $product_variant_id)->where('status', 1)->first();

    if($current_cart_with_selected_product_n_variant){
        $current_cart_with_selected_product_n_variant->update([
            'quantity' =>  $current_cart_with_selected_product_n_variant->quantity + $quantity,
        ]);
    }else{
        $cart = Cart::create([
            'user_id' => $user_id,
            'product_id' => $variant->product->id,
            'quantity' => $quantity,
            'product_variant_id' => $product_variant_id,
            'status' => 1,
            'type' => 2
        ]);
    }
}

function removeFromCart($user_id, $product_variant_id, $quantity){
    //important: do not call promotionItemUpdate() function here!
    $variant = ProductVariant::findOrFail($product_variant_id);

    //check if item already exist in cart
    $current_cart_with_selected_product_n_variant = Cart::where('user_id', $user_id)->where('product_variant_id', $product_variant_id)->where('status', 1)->first();

    if(($current_cart_with_selected_product_n_variant->quantity-$quantity) == 0){
        $current_cart_with_selected_product_n_variant->delete();
    }else{
        $current_cart_with_selected_product_n_variant->update([
            'quantity' =>  $current_cart_with_selected_product_n_variant->quantity - $quantity,
        ]);
    }
}

function checkIfVIPOrderedThisMonth($user_id){
    //check if is VIP
    $user = User::find($user_id);
    if($user->user_type == 4){
       $orders = Order::where("order_user_id", $user_id)->where('status' ,'!=' , '4')->whereMonth('created_at', '=', date('n'))->count();

       if(($orders) > 0){
           return true;
       }
    }
    return false;
}

function promotionItemUpdate($user_id){
    //bottle variant id == 42
    //erya voucher 300 variant id == 45
    //erya voucher 600 variant id == 46


    //updated at 2021-10-21 , end of event
    $startDate = Carbon::createFromFormat('Y-m-d H:i:s','2021-10-13 00:00:00');
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s','2021-10-20 23:59:59');
    $inPromotion20211013To20 = Carbon::now()->between($startDate,$endDate);
    if($inPromotion20211013To20){
        //check cart E5 variant quantity , variant_id == 43;
        $cart = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 43)->first();
        if($cart){
            if($cart->quantity >= 3) {
                $cart_bottle = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 42)->first();
                if(!$cart_bottle){
                    addToCart($user_id, 42, 1);
                }
            }

            if($cart->quantity >= 7){
                $cart_voucher_600 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 46)->first();
                if(!$cart_voucher_600){
                    addToCart($user_id, 46, 1);
                }
                $cart_voucher_300 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 45)->first();
                if($cart_voucher_300){
                    Cart::whereId($cart_voucher_300->id)->delete();
                }
            }else if($cart->quantity >= 3){
                $cart_voucher_600 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 46)->first();
                if($cart_voucher_600){
                    Cart::whereId($cart_voucher_600->id)->delete();
                }
                $cart_voucher_300 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 45)->first();
                if(!$cart_voucher_300){
                    addToCart($user_id, 45, 1);
                }
            }

            if($cart->quantity <= 2){
                $cart_voucher_600 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 46)->first();
                if($cart_voucher_600){
                    Cart::whereId($cart_voucher_600->id)->delete();
                }
                $cart_voucher_300 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 45)->first();
                if($cart_voucher_300){
                    Cart::whereId($cart_voucher_300->id)->delete();
                }
                $cart_bottle = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 42)->first();
                if($cart_bottle){
                    Cart::whereId($cart_bottle->id)->delete();
                }
            }

        }else{
            $cart_voucher_600 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 46)->first();
            if($cart_voucher_600){
                Cart::whereId($cart_voucher_600->id)->delete();
            }
            $cart_voucher_300 = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 45)->first();
            if($cart_voucher_300){
                Cart::whereId($cart_voucher_300->id)->delete();
            }
            $cart_bottle = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 42)->first();
            if($cart_bottle){
                Cart::whereId($cart_bottle->id)->delete();
            }
        }

    }
    //updated at 2021-10-21 , end of event above

    //New event
    $startDate = Carbon::createFromFormat('Y-m-d H:i:s','2021-10-21 00:00:00');
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s','2021-11-05 23:59:59');
    $inPromotion20211021To1105 = Carbon::now()->between($startDate,$endDate);
    if($inPromotion20211021To1105){
        //check cart E5 variant quantity , variant_id == 43;
        $cart = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 43)->first();
        if($cart) {
            if ($cart->quantity >= 3) {
                $cart_bottle = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 42)->first();
                if (!$cart_bottle) {
                    addToCart($user_id, 42, 1);
                }
            }else{
                $cart_bottle = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 42)->first();
                if($cart_bottle){
                    Cart::whereId($cart_bottle->id)->delete();
                }
            }
        }else{
            $cart_bottle = Cart::where('user_id', $user_id)->where('status', '1')->where('product_variant_id', 42)->first();
            if($cart_bottle){
                Cart::whereId($cart_bottle->id)->delete();
            }
        }
    }
}

// This function return array is correct, If it is string mean something wrong.
function getAccumulatedBonusTeamCarAndHouse($user_id) {
    $bonusTeamCar = BonusTeamCar::where('id', 1)->first();
    $bonusTeamHouse = BonusTeamHouse::where('id', 1)->first();

    if(!$bonusTeamCar) {
        return "Something Wrong - Bonus Team Car not found.";
    }

    if(!$bonusTeamHouse) {
        return "Something Wrong - Bonus Team House not found.";
    }

//    $checkUserIsMillionaireLeader = User::where('user_type', 3)->where('sub_user_type', 2)->count('id');
//
//    if(!$checkUserIsMillionaireLeader) {
//        return "You are not Millionaire Leader";
//    }

    $user = User::find($user_id);

    $bonusTeamCarTargetAmount = $bonusTeamCar->target_amount;
    $bonusTeamHouseTargetAmount = $bonusTeamHouse->target_amount;

    if($user->sub_user_type == 2){

        $uplineUserArr = User::where('upline_user_id', $user_id)->where('status', 1)->pluck('id')->toArray();
        $uplineFirstUserArr = User::where('upline_user_1_id', $user_id)->where('status', 1)->pluck('id')->toArray();

        $mergedUplineArr = array_merge($uplineUserArr, $uplineFirstUserArr);
        $removedDuplicateDownlineUserIdArray = array_map("unserialize", array_unique(array_map("serialize", $mergedUplineArr))); // Optional (Original array's value[user_id] also not duplicate) (This is remove duplicate value in array)

        \Illuminate\Support\Facades\Log::info(json_encode($removedDuplicateDownlineUserIdArray));

        $accumulatedDownlineTransactionPointPurchase = TransactionPointPurchase::whereIn('user_id', $removedDuplicateDownlineUserIdArray)
            ->where('created_at', '>=', $user->sub_user_type_at)
            ->where('type', 1)->where('status', 3)->sum('price');

        $bonusTeamCarModularized = $accumulatedDownlineTransactionPointPurchase / $bonusTeamCarTargetAmount;
        $bonusTeamCarQualifyCount = (int)$accumulatedDownlineTransactionPointPurchase;
        $bonusTeamHouseModularized = $accumulatedDownlineTransactionPointPurchase / $bonusTeamHouseTargetAmount;
        $bonusTeamHouseQualifyCount = (int)$accumulatedDownlineTransactionPointPurchase;
    }else{
        $accumulatedDownlineTransactionPointPurchase = 0;
        $bonusTeamCarQualifyCount = 0;
        $bonusTeamHouseQualifyCount = 0;
    }





    // [0] => Total upline_user_id, upline_user_1_id total top up
    // [1] => Bonus Team Car Settings's Target Amount Settings 500M
    // [2] => Number of quanlitication to earn bonus team car settings
    // [3] => Bonus Team House Settings's Target Amount Settings 500M
    // [4] => Number of quanlitication to earn bonus team car settings

    return [$accumulatedDownlineTransactionPointPurchase, $bonusTeamCarTargetAmount, $bonusTeamCarQualifyCount, $bonusTeamHouseTargetAmount, $bonusTeamHouseQualifyCount];
}

function getUserSignedQuitAgreement($user_id) {

    $userAgreementLog = UserAgreementLog::where('user_id', $user_id)->where('user_agreement_id', 7)->first();

    if($userAgreementLog){
        return 1;
    }else{
        return 0;
    }
}
