<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PointBalance;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductQuantity;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\PvBalance;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\VoucherBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mockery\Exception;

class Create extends Component
{
    public $users;
    public $user;
    public $userInfo;
    public $productVariant;
    public $wallet;
    public $publicOrder = true;
    public $agentType = "1";
    public $orderType = "1";

    public $orderItemId = [];
    public $orderProductVariant = [];
    public $orderPrice1 = [];
    public $orderPrice2 = [];
    public $orderPrice3 = [];
    public $orderPrice4 = [];
    public $orderPrice5 = [];
    public $orderPrice6 = [];
    public $orderPrice7 = [];
    public $orderQuantity = [];
    public $orderSubTotal = [];

    public $orderTotalAmount = 0;
    public $balance = 0;
    public $message = "";
    public $discount = 0;

    public $billingName = "";
    public $billingPhone = "";
    public $billingAddress = "";

    public function mount()
    {
        $this->users = User::whereStatus(1)->get();
        $this->productVariant = ProductVariant::whereStatus(1)->whereNotIn('type',[3])->get();
    }

    public function render()
    {
        return view('livewire.admin.order.create');
    }

    public function addItem()
    {
        $count = count($this->orderItemId);
        array_push($this->orderItemId, $count + 1);
        array_push($this->orderProductVariant, null);
        array_push($this->orderPrice1, null);
        array_push($this->orderPrice2, null);
        array_push($this->orderPrice3, null);
        array_push($this->orderPrice4, null);
        array_push($this->orderPrice5, null);
        array_push($this->orderPrice6, null);
        array_push($this->orderPrice7, null);
        array_push($this->orderQuantity, 1);
        array_push($this->orderSubTotal, null);

    }

    public function removeAllItem()
    {
        $this->orderItemId = [];
        $this->orderProductVariant = [];
        $this->orderPrice1 = [];
        $this->orderPrice2 = [];
        $this->orderPrice3 = [];
        $this->orderPrice4 = [];
        $this->orderPrice5 = [];
        $this->orderPrice6 = [];
        $this->orderPrice7 = [];
        $this->orderQuantity = [];
        $this->orderSubTotal = [];
    }

    public function updatedUser($value): void
    {

        $user = User::where('id', $value)->first();
        $this->userInfo = User::where('id', $value)->first();

        if($user->roles[0]->id == 2){
            $this->wallet = 3;
            $this->balance = getUserPointBalance($this->user);
        }else if($user->roles[0]->id == 3){
            $this->wallet = 1;
            $this->balance = getUserExecutivePointBalance($this->user);
        }else if($user->roles[0]->id == 4){
            $this->wallet = 2;
            $this->balance = getUserManagerPointBalance($this->user);
        }else if($user->roles[0]->id == 8){
            $this->wallet = 5;
            $this->balance = getPvBalance($this->user);
        }

        $this->updatedWallet($this->wallet);
    }

    public function updatedWallet($value): void
    {
        $this->orderTotalAmount = 0;
        for ($i =0; $i<count($this->orderItemId); $i++){
            if($value == 1){
                $this->orderSubTotal[$i] = $this->orderPrice3[$i] * $this->orderQuantity[$i];
            }else if($value == 2){
                $this->orderSubTotal[$i] = $this->orderPrice2[$i] * $this->orderQuantity[$i];
            }else if($value == 3){
                $this->orderSubTotal[$i] = $this->orderPrice1[$i] * $this->orderQuantity[$i];
            }else if($value == 5){
                $this->orderSubTotal[$i] = $this->orderPrice7[$i] * $this->orderQuantity[$i];
            }
            $this->orderTotalAmount += $this->orderSubTotal[$i];
        }

        $this->productVariant = ProductVariant::whereStatus(1)->whereNotIn('type',[3])->get();

        if($value == 1){
            $this->balance = getUserExecutivePointBalance($this->user);
        }else if($value == 2){
            $this->balance = getUserManagerPointBalance($this->user);
        }else if($value == 3){
            $this->balance = getUserPointBalance($this->user);
        }else if($value == 5){
            $this->balance = getPvBalance($this->user);
            $this->productVariant = ProductVariant::whereStatus(1)->whereIn('type',[3])->get();
            $this->removeAllItem();
        }
    }

    public function updateProductVariant($key): void
    {
        $model = ProductVariant::where('id', $this->orderProductVariant[$key])->first();
        $this->orderPrice1[$key] = $model->merchant_president_price;
        $this->orderPrice2[$key] = $model->agent_director_price;
        $this->orderPrice3[$key] = $model->agent_executive_price;
        $this->orderPrice4[$key] = $model->sales_price;
        $this->orderPrice5[$key] = $model->sales_price;
        $this->orderPrice6[$key] = $model->sales_price;
        $this->orderPrice7[$key] = $model->vip_redeem_pv ?? 0;

//        if($this->wallet == "1"){
//            $this->orderSubTotal[$key] = $this->orderPrice3[$key] * $this->orderQuantity[$key];
//        }else if($this->wallet == "2"){
////            $this->orderSubTotal[$key] = $this->orderPrice2[$key] * $this->orderQuantity[$key];
//            $this->orderSubTotal[$key] = 111;
//        }else if($this->wallet == "3"){
////            $this->orderSubTotal[$key] = $this->orderPrice1[$key] * $this->orderQuantity[$key];
//            $this->orderSubTotal[$key] = 0;
//        }

        $this->updateTotalAmount();


//        dd($key);
//        $this->orderProductVariant[$key] = $this->itemDescription[$key];
    }

    public function updateQuantity($key): void
    {
        if($this->wallet == "1"){
            $this->orderSubTotal[$key] = $this->orderPrice3[$key] * $this->orderQuantity[$key];
        }else if($this->wallet == "2"){
            $this->orderSubTotal[$key] = $this->orderPrice2[$key] * $this->orderQuantity[$key];
        }else if($this->wallet == "3"){
            $this->orderSubTotal[$key] = $this->orderPrice1[$key] * $this->orderQuantity[$key];
        }

        $this->updateTotalAmount();
    }

    public function removeItem($val): void
    {
        if (($key = array_search($val, $this->orderItemId)) !== false) {
            unset($this->orderItemId[$key]);
            unset($this->orderProductVariant[$key]);
            unset($this->orderPrice1[$key]);
            unset($this->orderPrice2[$key]);
            unset($this->orderPrice3[$key]);
            unset($this->orderPrice4[$key]);
            unset($this->orderPrice5[$key]);
            unset($this->orderPrice6[$key]);
            unset($this->orderPrice7[$key]);
            unset($this->orderQuantity[$key]);
            unset($this->orderSubTotal[$key]);

            $this->orderItemId = array_values($this->orderItemId);
            $this->orderProductVariant = array_values($this->orderProductVariant);
            $this->orderPrice1 = array_values($this->orderPrice1);
            $this->orderPrice2 = array_values($this->orderPrice2);
            $this->orderPrice3 = array_values($this->orderPrice3);
            $this->orderPrice4 = array_values($this->orderPrice4);
            $this->orderPrice5 = array_values($this->orderPrice5);
            $this->orderPrice6 = array_values($this->orderPrice6);
            $this->orderPrice7 = array_values($this->orderPrice7);
            $this->orderQuantity = array_values($this->orderQuantity);
            $this->orderSubTotal = array_values($this->orderSubTotal);

        }

        $this->updateTotalAmount();
    }


    public function updateTotalAmount(): void
    {
        $this->orderTotalAmount = 0;
        $oriTotal = 0;
        for ($i =0; $i<count($this->orderItemId); $i++){
            if ($this->orderType == 1){
                if($this->wallet == "1") {
                    $this->orderSubTotal[$i] = $this->orderPrice3[$i] * $this->orderQuantity[$i];
                }else if($this->wallet == "2"){
                    $this->orderSubTotal[$i] = $this->orderPrice2[$i] * $this->orderQuantity[$i];
                }else if($this->wallet == "3"){
                    $this->orderSubTotal[$i] = $this->orderPrice1[$i] * $this->orderQuantity[$i];
                }else if($this->wallet == "5"){
                    $this->orderSubTotal[$i] = $this->orderPrice7[$i] * $this->orderQuantity[$i];
                }
                $this->orderTotalAmount += $this->orderSubTotal[$i];
            }else{
                $oriTotal += $this->orderPrice4[$i] * $this->orderQuantity[$i];

                if($this->orderPrice5[$i] != ""){

                    if($this->orderPrice4[$i] < 1){
                        $this->orderSubTotal[$i] = $this->orderPrice5[$i] * $this->orderQuantity[$i];
                        $this->orderPrice6[$i] = 0;
                    }else{
                        $this->orderSubTotal[$i] = $this->orderPrice5[$i] * $this->orderQuantity[$i];
                        $this->orderPrice6[$i] = (($this->orderPrice4[$i]-$this->orderPrice5[$i])/$this->orderPrice4[$i])*100;
                    }
                }else{
                    $this->orderSubTotal[$i] = 0 * $this->orderQuantity[$i];
                    $this->orderPrice6[$i] = 0;
                }
                $this->orderTotalAmount += $this->orderSubTotal[$i];

                if($oriTotal > $this->orderTotalAmount){
                    $this->discount = $oriTotal - $this->orderTotalAmount;
                }else{
                    $this->discount = 0;
                }
            }
        }
    }

    public function updatedAgentType($value): void
    {
        if($value == 1){
            $this->publicOrder = true;
            $this->orderType = "1";
            $this->user = null;
        }else{
            $this->publicOrder = false;
            $this->orderType = "2";
            $this->user = User::whereId(1)->first()->id;
        }

        $this->updateTotalAmount();
    }

    public function updatedOrderPrice5($value): void
    {
        $this->updateTotalAmount();
    }

    public function updatedOrderPrice6($value): void
    {
        $this->orderTotalAmount = 0;
        $oriTotal = 0;
        for ($i =0; $i<count($this->orderItemId); $i++){
            if ($this->orderType == 1){
                if($this->wallet == "1") {
                    $this->orderSubTotal[$i] = $this->orderPrice3[$i] * $this->orderQuantity[$i];
                }else if($this->wallet == "2"){
                    $this->orderSubTotal[$i] = $this->orderPrice2[$i] * $this->orderQuantity[$i];
                }else if($this->wallet == "3"){
                    $this->orderSubTotal[$i] = $this->orderPrice1[$i] * $this->orderQuantity[$i];
                }
                $this->orderTotalAmount += $this->orderSubTotal[$i];
            }else{
                $oriTotal += $this->orderPrice4[$i] * $this->orderQuantity[$i];

                if($this->orderPrice6[$i] != ""){
                    $this->orderPrice5[$i] = $this->orderPrice4[$i]-(($this->orderPrice6[$i]/100)*$this->orderPrice4[$i]);
//
//                    $this->orderPrice6[$i] = (($this->orderPrice4[$i]-$this->orderPrice5[$i])/$this->orderPrice4[$i])*100;
                }else{
                    $this->orderPrice5[$i] = "0";
//                    $this->orderSubTotal[$i] = 0 * $this->orderQuantity[$i];
//                    $this->orderPrice6[$i] = 0;
                }
                $this->orderSubTotal[$i] = $this->orderPrice5[$i] * $this->orderQuantity[$i];
                $this->orderTotalAmount += $this->orderSubTotal[$i];

                if($oriTotal > $this->orderTotalAmount){
                    $this->discount = $oriTotal - $this->orderTotalAmount;
                }else{
                    $this->discount = 0;
                }
            }
        }
    }

    public function saveOrder()
    {
        if(count($this->orderItemId) > 0){

            if($this->orderType == "1"){
                $subTotal = 0;
                $voucherAmount = 0;

                if(getUserVoucherBalance($this->user) > 0){
                    if(getUserVoucherBalance($this->user) >= $this->orderTotalAmount){
                        $voucherAmount = $this->orderTotalAmount;
                        $subTotal = 0;
                    }else{
                        $voucherAmount = getUserVoucherBalance($this->user);
                        $subTotal = $this->orderTotalAmount - getUserVoucherBalance($this->user);
                    }
                }else{
                    $voucherAmount = 0;
                    $subTotal = $this->orderTotalAmount;
                }


                if($this->balance >= $this->orderTotalAmount){

                    DB::beginTransaction();

                    $orderUser = User::whereId($this->user)->first();
                    $orderUserId = $this->user;
                    if($this->wallet == 5){
                        $orderUserId = $orderUser->upline_user_id;
                    }else{
                        $orderUserId = $this->user;
                    }

                    try {
                        $order = Order::create([
                            'receiver_name' => "",
                            'receiver_phone' => "",
                            'receiver_address_1' => "",
                            'receiver_address_2' => "",
                            'receiver_city' => "",
                            'receiver_state' => "",
                            'receiver_postcode' => "",
                            'pre_point_balance' => getUserPointBalance($this->user),
                            'post_point_balance' => getUserPointBalance($this->user) - $this->orderTotalAmount,
                            'amount' => $subTotal,
                            'voucher_amount' => $voucherAmount,
                            'sub_total' => $this->orderTotalAmount,
                            'total_add_on' => 0,
                            'total_shipping' => 0,
                            'payment_method_id' => 4,
                            'collect_type' => 1,
                            'wallet_type' => $this->wallet,
                            'invoice_user_id' => $this->user,
                            'user_id' => $orderUserId,
                            'order_user_id' => $this->user,
                            'status' => 1,
                            'order_type' => $this->orderType,

                        ]);



                        for ($i=0; $i<count($this->orderItemId); $i++){

                            $productVariant = ProductVariant::whereId($this->orderProductVariant[$i])->first();

                            $orderItem = OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $productVariant->product_id,
                                'product_variant_id' => $productVariant->id,
                                'product_name_en' => $productVariant->product->name_en,
                                'product_name_zh' => $productVariant->product->name_zh,
                                'product_desc_en' => $productVariant->product->desc_en,
                                'product_desc_zh' => $productVariant->product->desc_zh,
                                'product_quantity' => $this->orderQuantity[$i],
                                'product_color' => $productVariant->color->name,
                                'product_size' => $productVariant->size->name,
                                'product_sku' => $productVariant->sku,
                                'sales_price' => $productVariant->sales_price,
                                'merchant_president_price' => $productVariant->merchant_president_price,
                                'agent_director_price' => $productVariant->agent_director_price,
                                'agent_executive_price' => $productVariant->agent_executive_price,
                                'purchase_price' => (($this->wallet == 1) ? $productVariant->agent_executive_price: (($this->wallet == 2) ? $productVariant->agent_director_price: $productVariant->merchant_president_price)),
                                'price_add_on' => $productVariant->price_add_on,
                                'type' => 1,
                                'admin_id' => Auth::guard('admin')->user()->id,
                                'is_new' => 1,
                            ]);
                        }

                        $order_number = TransactionIdLog::generateTransactionId(2, $order->user_id, $order->id);
                        $order->update([
                            'order_number' => $order_number,
                        ]);


                        $point_balance_data = [
                            'amount' => '-' . $subTotal,
                            'user_id' => $this->user,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ];


                        if($this->wallet == NULL){
                            if ($this->userInfo->roles[0]->id == 3) {
                                PointExecutiveBalance::create($point_balance_data);
                            } elseif ($this->userInfo->roles[0]->id == 4) {
                                PointManagerBalance::create($point_balance_data);
                            } elseif ($this->userInfo->roles[0]->id == 2) {
                                PointBalance::create($point_balance_data);
                            } elseif ($this->userInfo->roles[0]->id == 8) {
                                PvBalance::create($point_balance_data);
                            }
                        } else if($this->wallet == "1"){
                            PointExecutiveBalance::create($point_balance_data);
                        }else if($this->wallet == "2"){
                            PointManagerBalance::create($point_balance_data);
                        }else if($this->wallet == "3"){
                            PointBalance::create($point_balance_data);
                        }else if($this->wallet == "5"){
                            PvBalance::create($point_balance_data);
                        }

                        if ($voucherAmount != 0) {
                            VoucherBalance::create([
                                'amount' => '-' . $voucherAmount,
                                'user_id' => $this->user,
                                'status' => 1,
                                'settlement' => 1,
                                'remark' => "redeem order " . $order_number,
                                'model_type' => '\App\Models\Order',
                                'model' => $order->id,
                            ]);
                        }

                        DB::commit();

                        return redirect()->route('admin.orders.show', [$order->id]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->route('admin.orders.index');
                    }

                }else{
                    $this->message = "insufficient balance!";
                }
            }else{

                if($this->billingName == ""){
                    $this->message = "Please enter billing name!";
                }else if($this->billingPhone == ""){
                    $this->message = "Please enter billing phone!";
                }else if($this->billingAddress == ""){
                    $this->message = "Please enter billing address!";
                }else{
                    DB::beginTransaction();

                    try {
                        $order = Order::create([
                            'receiver_name' => "",
                            'receiver_phone' => "",
                            'receiver_address_1' => "",
                            'receiver_address_2' => "",
                            'receiver_city' => "",
                            'receiver_state' => "",
                            'receiver_postcode' => "",
                            'pre_point_balance' => getUserPointBalance($this->user),
                            'post_point_balance' => getUserPointBalance($this->user) - $this->orderTotalAmount,
                            'amount' => $this->orderTotalAmount,
                            'voucher_amount' => $this->discount,
                            'sub_total' => $this->orderTotalAmount,
                            'total_add_on' => 0,
                            'total_shipping' => 0,
                            'payment_method_id' => 4,
                            'collect_type' => 1,
                            'wallet_type' => 1,
                            'invoice_user_id' => $this->user,
                            'user_id' => $this->user,
                            'order_user_id' => $this->user,
                            'status' => 1,
                            'order_type' => $this->orderType,
                            'billing_name' => $this->billingName,
                            'billing_phone' => $this->billingPhone,
                            'billing_address' => $this->billingAddress,
                        ]);

                        for ($i=0; $i<count($this->orderItemId); $i++){

                            $productVariant = ProductVariant::whereId($this->orderProductVariant[$i])->first();

                            $orderItem = OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $productVariant->product_id,
                                'product_variant_id' => $productVariant->id,
                                'product_name_en' => $productVariant->product->name_en,
                                'product_name_zh' => $productVariant->product->name_zh,
                                'product_desc_en' => $productVariant->product->desc_en,
                                'product_desc_zh' => $productVariant->product->desc_zh,
                                'product_quantity' => $this->orderQuantity[$i],
                                'product_color' => $productVariant->color->name,
                                'product_size' => $productVariant->size->name,
                                'product_sku' => $productVariant->sku,
                                'sales_price' => $this->orderPrice4[$i],
                                'merchant_president_price' => $productVariant->merchant_president_price,
                                'agent_director_price' => $productVariant->agent_director_price,
                                'agent_executive_price' => $productVariant->agent_executive_price,
                                'purchase_price' => $this->orderPrice5[$i],
                                'price_add_on' => $productVariant->price_add_on,
                                'type' => 1,
                                'admin_id' => Auth::guard('admin')->user()->id,
                                'is_new' => 1,
                            ]);
                        }

                        $order_number = TransactionIdLog::generateTransactionId(2, $order->user_id, $order->id);
                        $order->update([
                            'order_number' => $order_number,
                        ]);

                        DB::commit();

                        return redirect()->route('admin.orders.show', [$order->id]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->route('admin.orders.index');
                    }
                }

            }
        }else{
            $this->message = "Order list EMPTY! Please add order item!";
        }

    }
}
