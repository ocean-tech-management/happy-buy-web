<?php

namespace App\Http\Livewire;

use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\CashVoucherBalance;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickUpLocation;
use App\Models\PointBalance;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\ShippingBalance;
use App\Models\ShippingFee;
use App\Models\State;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\VoucherBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Psr\Log\NullLogger;

class Checkout extends Component
{
    public $selected_user_id;
    public $carts;
    public $wallet_id;
    public $addressBooks, $countries, $pickupLocations, $my_vips;

    public $shipping_fee;
    public $product_subtotal;
    public $total_price;
    public $productTotalAddon;

    public $total_deduct_for_cash_voucher;
    public $total_deduct_for_cash_voucher_count;
    public $total_vip_price;

    public $address_target;
    public $my_address_target;
    public $vip_select_vip_address_target;
    public $vip_address_target;

    public $shipping_method;
    public $withShipping;
    public $pickupLocation_id;
    public $pickup_by;
    public $vips_pickup;

    public $states;
    public $address_id;
    public $state;
    public $country_id;
    public $address_name,
        $address_phone,
        $address1, $address2, $state_id, $postcode, $city;
    public $remark;

    public function mount(Request $request)
    {
        $this->selected_user_id = Auth::user()->id;
        if ($request->has('vip_id')) {
            //check if selected vip is own vip
            $user = User::where('user_type', 4)->where('direct_upline_id', Auth::user()->id)->where('id', $request->vip_id)->first();
            if (!$user) {
                return redirect()->route('user.cart');
            }
            $this->selected_user_id = $request->vip_id;
            $this->addressBooks = AddressBook::whereUserId($this->selected_user_id)->where('status', 1)->get();

            $this->address_target = 2;
            $this->vip_select_vip_address_target = $this->selected_user_id;
            $this->onVipAddressTargeted();
        } else {
            $this->addressBooks = AddressBook::whereUserId($this->selected_user_id)->where('status', 1)->get();

            $this->address_target = 1;
            $this->onMyAddressTargeted();
        }

        $this->carts = Cart::whereUserId(Auth::user()->id)->where('status', 1)->where(function ($query) {
            if ($this->selected_user_id == Auth::user()->id) {
                $query->where('to_user_id', Auth::user()->id)
                    ->orWhereNull('to_user_id');
            } else {
                $query->where('to_user_id', $this->selected_user_id);
            }

        })
//            ->whereHas('product_variant', function ($q) {
//            $q->whereIn('type', [1, 2]);
//        })
            ->get();


        $this->wallet_id = $request->wallet_id;

        if (!$this->wallet_id) {
            return abort(404);
        } else if ($this->wallet_id == 1) {
            if (Auth::user()->roles[0]->id == 3) {

            } else if (Auth::user()->roles[0]->id == 4) {
                if (getUserExecutivePointBalance(Auth::user()->id) == 0) {
                    return abort(404);
                }
            } else if (Auth::user()->roles[0]->id == 2) {
                if (getUserExecutivePointBalance(Auth::user()->id) == 0) {
                    return abort(404);
                }
            }
        } else if ($this->wallet_id == 2) {
            if (Auth::user()->roles[0]->id == 3) {
                return abort(404);
            } else if (Auth::user()->roles[0]->id == 4) {

            } else if (Auth::user()->roles[0]->id == 2) {
                if (getUserManagerPointBalance(Auth::user()->id) == 0) {
                    return abort(404);
                }
            }
        } else if ($this->wallet_id == 3) {
            if (Auth::user()->roles[0]->id == 3) {
                return abort(404);
            } else if (Auth::user()->roles[0]->id == 4) {
                return abort(404);
            } else if (Auth::user()->roles[0]->id == 2) {

            }
        }

        $this->countries = Country::where('status', 1)->get();
        $this->pickupLocations = PickUpLocation::where('status', 1)->get();

        $this->my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 4)->get();

        $this->calculationTotal();

    }

    public function render()
    {
        return view('livewire.checkout');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function onShippingMethodSelect()
    {
        if ($this->shipping_method == 2) {
            $this->withShipping = true;
        } else {
            $this->withShipping = false;
            if(empty($this->pickupLocation_id)){
                $this->pickupLocation_id = $this->pickupLocations[0]->id;
                $this->vips_pickup = Auth::user()->id;
            }
        }

        $this->calculationTotal();
    }

    public function onVipAddressTargeted()
    {
        foreach ($this->addressBooks as $addressBook) {
            if ($addressBook->set_default == 1) {
                $this->vip_address_target = $addressBook->id;
                $this->onVipAddressSelected($addressBook->id);
            }
        }
    }

    public function onMyAddressTargeted()
    {
        foreach ($this->addressBooks as $addressBook) {
            if ($addressBook->set_default == 1) {
                $this->my_address_target = $addressBook->id;
                $this->onMyAddressSelected($addressBook->id);
            }
        }
    }

    public function onMyAddressSelected($id)
    {
        $addressBook = AddressBook::find($id);
        $this->address_id = $addressBook->id;
        $this->address_name = $addressBook->name;
        $this->address_phone = $addressBook->phone;
        $this->address1 = $addressBook->address_1;
        $this->address2 = $addressBook->address_2;
        $this->state_id = $addressBook->state_id;
        $this->postcode = $addressBook->postcode;
        $this->city = $addressBook->city;

        $this->state = $addressBook->state;

        $this->country_id = $this->state->country->id;

        $this->states = State::where('country_id', $this->country_id)->get();
    }

    public function onVipAddressSelected($id)
    {
        $addressBook = AddressBook::find($id);
        $this->address_id = $addressBook->id;
        $this->address_name = $addressBook->name;
        $this->address_phone = $addressBook->phone;
        $this->address1 = $addressBook->address_1;
        $this->address2 = $addressBook->address_2;
        $this->state_id = $addressBook->state_id;
        $this->postcode = $addressBook->postcode;
        $this->city = $addressBook->city;

        $this->state = $addressBook->state;

        $this->country_id = $this->state->country->id;

        $this->states = State::where('country_id', $this->country_id)->get();
    }


    public function onCountryChange()
    {
        $this->states = State::where('country_id', $this->country_id)->get();
        $this->state = $this->states[0];
        $this->state_id = $this->states[0]->id;
    }

    public function onStateChange()
    {
        foreach ($this->states as $s) {
            if ($this->state_id == $s->id) {
                $this->state = $s;
            }
        }
        $this->calculationTotal();
    }

    public function useAddress()
    {
        $this->onStateChange();
    }

    public function onAddressChangedSelect()
    {
        $this->calculationTotal();
    }

    public function calculationTotal()
    {
        $this->shipping_fee = 0;
        $this->product_subtotal = 0;
        $this->total_price = 0;
        $this->productTotalAddon = 0;
        $total_item_qty = 0;

        $this->total_deduct_for_cash_voucher_count = 0;
        $this->total_vip_price = 0;


        $use_product_add_on = false;
        $max_quantity_b4_shipping_add_on = 0;
        $shipping_fee = 0;
        foreach ($this->carts as $key => $cart) {

            if($cart->is_package == 1){
//                $total_item_qty += $cart->quantity;

//                $cartParent = Cart::whereId($cart->package_id)->first();

                $total_item_qty = $cart->product->product_variant_quantity;

                $shippingFees = ShippingFee::whereHas('states', function ($q) {
                    $q->where('state_id', $this->state->id);
                })->orderBy('quantity', 'asc')->pluck('id');

                $shippingFees = ShippingFee::whereIn('id', $shippingFees)->orderByRaw("CAST(quantity as UNSIGNED) ASC")->get();

                $use_sf = null;
                foreach ($shippingFees as $shippingFee) {
                    if ($total_item_qty <= $shippingFee->quantity) {
                        $use_sf = $shippingFee;
                        break;
                    }
                }

                if (!($use_sf)) {
                    $use_sf = $shippingFees[count($shippingFees) - 1];
                }

                $use_product_add_on = false;
                if ($use_sf->add_on == 0) {
                    $use_product_add_on = true;
                }

                $max_quantity_b4_shipping_add_on = $use_sf->quantity;
                $shipping_fee += $use_sf->price;
                $shipping_add_on = $use_sf->add_on;

//                echo $shipping_fee;
//                dd($shipping_fee);


            }
        }

//        $shippingFees = ShippingFee::whereHas('states', function ($q) {
//            $q->where('state_id', $this->state->id);
//        })->orderBy('quantity', 'asc')->pluck('id');
//
//        $shippingFees = ShippingFee::whereIn('id', $shippingFees)->orderByRaw("CAST(quantity as UNSIGNED) ASC")->get();
//
//        $use_sf = null;
//        foreach ($shippingFees as $shippingFee) {
//            if ($total_item_qty <= $shippingFee->quantity) {
//                $use_sf = $shippingFee;
//                break;
//            }
//        }
//        if (!($use_sf)) {
//            $use_sf = $shippingFees[count($shippingFees) - 1];
//        }
//
//        $use_product_add_on = false;
//        if ($use_sf->add_on == 0) {
//            $use_product_add_on = true;
//        }
//
//        $max_quantity_b4_shipping_add_on = $use_sf->quantity;
//        $shipping_fee = $use_sf->price;
//        $shipping_add_on = $use_sf->add_on;
//
//        if($total_item_qty == 0){
//            $max_quantity_b4_shipping_add_on = 0;
//            $shipping_fee = 0;
//            $shipping_add_on = 0;
//        }

        foreach ($this->carts as $key => $cart) {

            if($cart->product_variant != NULL){
                if ($this->wallet_id == 1) {
                    $unit_price = $cart->product_variant->agent_executive_price;
                } elseif ($this->wallet_id == 2) {
                    $unit_price = $cart->product_variant->agent_director_price;
                } elseif ($this->wallet_id == 3) {
                    $unit_price = $cart->product_variant->merchant_president_price;
                }

                $this->product_subtotal += $cart->quantity * $unit_price;

                if ($use_product_add_on) {
//                    $this->productTotalAddon += $cart->product_variant->price_add_on * ($cart->quantity);
                    $this->productTotalAddon += 0;
                }

                if($cart->product_variant->type == 1){
                    $this->total_deduct_for_cash_voucher_count += $cart->quantity;
                }
            }

        }

        $this->total_deduct_for_cash_voucher = ((intval($this->total_deduct_for_cash_voucher_count/5) * 100) + ($this->total_deduct_for_cash_voucher_count % 5 * 15));

        if (!$use_product_add_on) {
            if ($total_item_qty > $max_quantity_b4_shipping_add_on) {
//                $this->productTotalAddon += $shipping_add_on * ($total_item_qty - $max_quantity_b4_shipping_add_on);
                $this->productTotalAddon += 0;

            } else {
                $this->productTotalAddon += 0;
            }
        } else {
            if ($total_item_qty <= $max_quantity_b4_shipping_add_on) {
                $this->productTotalAddon = 0;
            }else{

            }
        }

        //calculate only for mother's day special
        foreach ($this->carts as $key => $cart) {
            if($cart->product_variant != NULL){
                if($cart->product_variant->id == 126){
//                    $this->productTotalAddon += $cart->product_variant->price_add_on * ($cart->quantity);
                    $this->productTotalAddon = 0;
                }
            }

        }

        if($this->withShipping){
            $this->shipping_fee = $shipping_fee;
//            $this->total_price = $this->shipping_fee + $this->product_subtotal;
            $this->total_price = $this->product_subtotal;
        }else{
            $this->shipping_fee = 0;
//            $this->total_price = $this->shipping_fee + $this->product_subtotal;
            $this->total_price = $this->product_subtotal;
        }
    }

    public function checkOut(Request $request){
        $user = Auth::user();
        $data = $this->validate([
           'address_name' => 'required',
           'address_phone' => 'required',
           'address1' => 'required',
           'country_id' => 'required',
           'state_id' => 'required',
           'postcode' => 'required',
           'city' => 'required',
        ]);


        if ($this->wallet_id == 1) {
            $balance = getUserExecutivePointBalance($user->id);
        } elseif ($this->wallet_id == 2) {
            $balance = getUserManagerPointBalance($user->id);
        } elseif ($this->wallet_id == 3) {
            $balance = getUserPointBalance($user->id);
        }

        //user balance add (if user is merchant then calculate voucher point also , will deduct all of voucher point then point
        if ($balance + ((Auth::user()->roles[0]->id == 2 && $this->wallet_id == 3) ? getUserVoucherBalance(Auth::user()->id) : 0) < $this->total_price) {
            $this->addError('balance', trans('user-portal.insufficient_point_balance'));
            return;
        }
//        return back()->withErrors(['balance' => trans('user-portal.insufficient_point_balance')]); old

        if ($this->shipping_method == 2) { //collect type = delivery
            //check if shipping point enough
            if (getUserShippingBalance($user->id) < ($this->shipping_fee + $this->productTotalAddon)) {
                $this->addError('balance', trans('user-portal.insufficient_shipping_point_balance'));
                return ;
            }
        }
//        return back()->withErrors(['balance' => trans('user-portal.insufficient_shipping_point_balance')]);


        DB::beginTransaction();
        try {
            if (Auth::user()->roles[0]->id == 2 && $this->wallet_id == 3) {
                $voucher_balance = getUserVoucherBalance(Auth::user()->id);

                if ($voucher_balance > $this->total_price) {
                    $voucher_amount = $this->total_price;
                    $amount = 0;
                } else {
                    $voucher_amount = $voucher_balance;
                    $amount = $this->total_price - $voucher_amount;
                }
            } else {
                $amount = $this->total_price;
                $voucher_amount = 0;
            }
            if ($this->shipping_method == 2) { // delivery then record
                $request->request->add(['receiver_name' => $this->address_name]);
                $request->request->add(['receiver_phone' => $this->address_phone]);
                $request->request->add(['receiver_address_1' => $this->address1]);
                $request->request->add(['receiver_address_2' => $this->address2]);
                $request->request->add(['receiver_city' => $this->city]);
                $request->request->add(['receiver_state' => $this->state->name]);
                $request->request->add(['receiver_postcode' => $this->postcode]);
            }

            $request->request->add(['pre_point_balance' => getUserPointBalance($user->id)]);
            $request->request->add(['post_point_balance' => getUserPointBalance($user->id) - $this->total_price]);
            $request->request->add(['amount' => $amount]);
            $request->request->add(['wallet_type' => $this->wallet_id]);
            $request->request->add(['voucher_amount' => $voucher_amount]);
            $request->request->add(['sub_total' => $this->product_subtotal]);
            $request->request->add(['total_add_on' => $this->productTotalAddon]); //deduct from shipping point
            $request->request->add(['total_shipping' => $this->shipping_fee]); //deduct from shipping point
            $request->request->add(['cash_voucher_amount' => $this->selected_user_id != Auth::guard('user')->user()->id ? $this->total_deduct_for_cash_voucher : 0]); //deduct from shipping point
            $request->request->add(['payment_method_id' => 4]);
            $request->request->add(['collect_type' => $this->shipping_method]);
            $request->request->add(['invoice_user_id' => (Auth::user()->roles[0]->id == 2) ? $user->id : $user->upline_user->id]);

            $request->request->add(['user_id' => Auth::user()->id]);
            $request->request->add(['order_user_id' => $this->selected_user_id]);
            if ($this->shipping_method == 1) {
                $request->request->add(['pickup_location_id' => $this->pickupLocation_id]);
                $request->request->add(['order_user_id' => $this->vips_pickup]);
            }
            $request->request->add(['remark' => $this->remark]);
            $request->request->add(['status' => 1]);
            $request->request->add(['order_type' => 1]);


            $order = Order::create($request->all());

            if ($order) {
                if ($this->selected_user_id != Auth::user()->id) {
                    $this->total_deduct_for_cash_voucher_count = 0;
                    $this->total_vip_price = 0;
                }
                foreach ($this->carts as $cart) {
                    if ($this->selected_user_id != Auth::user()->id) {
                        if ($cart->product_variant->type == 1) {
                            $this->total_deduct_for_cash_voucher_count += $cart->quantity;
                        }

                        $this->total_vip_price += ($cart->product_variant->sales_price * $cart->quantity);
                    }

                    if($cart->is_package == 1){
                        $orderItem = OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $cart->product_id,
                            'product_variant_id' => $cart->product_variant_id,
                            'product_name_en' => $cart->product->name_en,
                            'product_name_zh' => $cart->product->name_zh,
                            'product_desc_en' => $cart->product->desc_en,
                            'product_desc_zh' => $cart->product->desc_zh,
                            'short_desc_en' => $cart->product->short_desc_en,
                            'short_desc_zh' => $cart->product->short_desc_zh,
                            'product_quantity' => $cart->quantity,
                            'product_color' => $cart->product_variant->color->name ?? "",
                            'product_size' => $cart->product_variant->size->name ?? "",
                            'product_sku' => $cart->product_variant->sku ?? "",
                            'sales_price' => $cart->product_variant->sales_price ?? "",
                            'merchant_president_price' => $cart->product_variant->merchant_president_price ?? "",
                            'agent_director_price' => $cart->product_variant->agent_director_price ?? "",
                            'agent_executive_price' => $cart->product_variant->agent_executive_price ?? "",
                            'vip_redeem_pv' => $cart->product_variant->vip_redeem_pv ?? "",
                            'purchase_price' => $cart->product_variant->price ?? "",
                            'price_add_on' => $cart->product_variant->price_add_on ?? "",
                            'type' => $cart->type,
                            'is_new' => 1,
                        ]);

                        foreach ($cart->package_item as $items) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $items->product_id,
                                'product_variant_id' => $items->product_variant_id,
                                'product_name_en' => $items->product->name_en,
                                'product_name_zh' => $items->product->name_zh,
                                'product_desc_en' => $items->product->desc_en,
                                'product_desc_zh' => $items->product->desc_zh,
                                'short_desc_en' => $items->product->short_desc_en,
                                'short_desc_zh' => $items->product->short_desc_zh,
                                'product_quantity' => $items->quantity,
                                'product_color' => $items->product_variant->color->name ?? "",
                                'product_size' => $items->product_variant->size->name ?? "",
                                'product_sku' => $items->product_variant->sku ?? "",
                                'sales_price' => $items->product_variant->sales_price ?? "",
                                'merchant_president_price' => $items->product_variant->merchant_president_price ?? "",
                                'agent_director_price' => $items->product_variant->agent_director_price ?? "",
                                'agent_executive_price' => $items->product_variant->agent_executive_price ?? "",
                                'vip_redeem_pv' => $items->product_variant->vip_redeem_pv ?? "",
                                'purchase_price' => $items->product_variant->price ?? "",
                                'price_add_on' => $items->product_variant->price_add_on ?? "",
                                'type' => $items->type,
                                'parent_id' => $orderItem->id,
                                'is_new' => 1,
                            ]);
                        }
                    }else if($cart->is_package == 2){ //insert to order item for non package item
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $cart->product_id,
                            'product_variant_id' => $cart->product_variant_id,
                            'product_name_en' => $cart->product->name_en,
                            'product_name_zh' => $cart->product->name_zh,
                            'product_desc_en' => $cart->product->desc_en,
                            'product_desc_zh' => $cart->product->desc_zh,
                            'short_desc_en' => $cart->product->short_desc_en,
                            'short_desc_zh' => $cart->product->short_desc_zh,
                            'product_quantity' => $cart->quantity,
                            'product_color' => $cart->product_variant->color->name ?? "",
                            'product_size' => $cart->product_variant->size->name ?? "",
                            'product_sku' => $cart->product_variant->sku ?? "",
                            'sales_price' => $cart->product_variant->sales_price ?? "",
                            'merchant_president_price' => $cart->product_variant->merchant_president_price ?? "",
                            'agent_director_price' => $cart->product_variant->agent_director_price ?? "",
                            'agent_executive_price' => $cart->product_variant->agent_executive_price ?? "",
                            'vip_redeem_pv' => $cart->product_variant->vip_redeem_pv ?? "",
                            'purchase_price' => $cart->product_variant->price ?? "",
                            'price_add_on' => $cart->product_variant->price_add_on ?? "",
                            'type' => $cart->type,
                            'is_new' => 1,
                        ]);
                    }

                    //update cart to check out
                    $cart->update([
                        'status' => 2
                    ]);
                }
                $order_number = TransactionIdLog::generateTransactionId(2, $order->user_id, $order->id);
                $order->update([
                    'order_number' => $order_number,
                ]);

                if ($amount != 0) {
                    $point_balance_data = [
                        'amount' => '-' . $amount,
                        'user_id' => $user->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "redeem order " . $order_number,
                        'model_type' => '\App\Models\Order',
                        'model' => $order->id,
                    ];
                    if ($this->wallet_id == 1) {
                        PointExecutiveBalance::create($point_balance_data);
                    } elseif ($this->wallet_id == 2) {
                        PointManagerBalance::create($point_balance_data);
                    } elseif ($this->wallet_id == 3) {
                        PointBalance::create($point_balance_data);
                    }

                }

                if ($voucher_amount != 0) {
                    VoucherBalance::create([
                        'amount' => '-' . $voucher_amount,
                        'user_id' => $user->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "redeem order " . $order_number,
                        'model_type' => '\App\Models\Order',
                        'model' => $order->id,
                    ]);
                }

                if ($this->shipping_fee != 0) {
                    ShippingBalance::create([
                        'amount' => '-' . $this->shipping_fee,
                        'user_id' => $user->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "redeem order " . $order_number,
                        'model_type' => '\App\Models\Order',
                        'model' => $order->id,
                    ]);
                }

                //vip cash voucher part
                if ($this->selected_user_id != Auth::user()->id) {
                    $this->total_deduct_for_cash_voucher = ((intval($this->total_deduct_for_cash_voucher_count / 5) * 100) + ($this->total_deduct_for_cash_voucher_count % 5 * 15));
                    $balance = 0;
                    if (getCashVoucherBalance($this->selected_user_id) > $this->total_deduct_for_cash_voucher) {
                        $balance = getCashVoucherBalance($this->selected_user_id) - $this->total_deduct_for_cash_voucher;
                    } else {
                        $this->total_deduct_for_cash_voucher = getCashVoucherBalance($this->selected_user_id);
                    }

                    $cart_user = User::find($this->selected_user_id);
                    if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
                        if(!checkIfVIPOrderedThisMonth($this->selected_user_id)){ //only accept one order per birthday user.
                            $this->total_deduct_for_cash_voucher = 0;

                            $this->total_deduct_for_cash_voucher += (intval($this->total_deduct_for_cash_voucher_count/5) * 160);
                            $item_left = $this->total_deduct_for_cash_voucher_count % 5;
                            if($item_left <= 3){
                                $this->total_deduct_for_cash_voucher += $item_left * 25;
                            }else if($item_left == 4){
                                $this->total_deduct_for_cash_voucher += 90;
                            }
                            $balance = 0;
                            if(getCashVoucherBalance($this->selected_user_id) > $this->total_deduct_for_cash_voucher){
                                $balance = getCashVoucherBalance($this->selected_user_id) - $this->total_deduct_for_cash_voucher;
                            }else{
                                $this->total_deduct_for_cash_voucher = getCashVoucherBalance($this->selected_user_id);
                            }
                        }
                    }

                    CashVoucherBalance::create([
                        'user_id' => $this->selected_user_id,
                        'amount' => -($this->total_deduct_for_cash_voucher),
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "vip redeem order " . $order_number,
                        'model_type' => '\App\Models\Order',
                        'model' => $order->id,
                    ]);
                }

                DB::commit();

                return redirect()->route('user.purchase-success', ['order_id' => $order->id]);

            }


        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
//            $this->addError('message', "Some error occur. Please contact admin.");
            $this->addError('message', $e);
            return;
//            return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);
        }
    }
}
