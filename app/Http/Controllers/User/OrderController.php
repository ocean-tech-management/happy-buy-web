<?php

namespace App\Http\Controllers\User;

use App\CustomClass\SenangPay;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\AddressBook;
use App\Models\BonusGroup;
use App\Models\BonusPersonal;
use App\Models\Cart;
use App\Models\CashVoucherBalance;
use App\Models\Country;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentNumberLog;
use App\Models\ModelHasRole;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickUpLocation;
use App\Models\PointBalance;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\Product;
use App\Models\PvBalance;
use App\Models\ShippingBalance;
use App\Models\ShippingFee;
use App\Models\State;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\UserAgreementLog;
use App\Models\VoucherBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class OrderController extends Controller
{
    public function showCart(Request $request)
    {
        $selected_user_id = Auth::user()->id;
        if ($request->has('vip_id')) {

            //check if selected vip is own and downlines vip

            $downlines = User::where('upline_user_id', Auth::user()->id)->role(['Agent-Executive','Agent-Manager'])->where('user_type', '!=',4)->pluck('id');

            $user = User::where(function ($q) use ($downlines) {
                $q->where('direct_upline_id', Auth::user()->id)
                    ->orWhereIn('direct_upline_id', $downlines);
            })->where('user_type', 4)->where('id', $request->vip_id)->get();

//            $user = User::where('user_type', 4)->where('direct_upline_id', Auth::user()->id)->where('id', $request->vip_id)->first();
            if (!$user) {
                return redirect()->route('user.cart');
            }
            $selected_user_id = $request->vip_id;
        }

        $carts = Cart::whereUserId(Auth::user()->id)->where('status', 1)
            ->where(function ($query) use ($selected_user_id) {
                if ($selected_user_id == Auth::user()->id) {
                    $query->where('to_user_id', Auth::user()->id)
                        ->orWhereNull('to_user_id');
                } else {
                    $query->where('to_user_id', $selected_user_id);
                }

            })->whereHas('product_variant', function ($q) {
                $q->whereIn('type', [1, 2]);
            })->get();

        $downlines = User::where('upline_user_id', Auth::user()->id)->role(['Agent-Executive','Agent-Manager'])->where('user_type', '!=',4)->pluck('id');

        $my_vips = User::where(function ($q) use ($downlines) {
            $q->where('direct_upline_id', Auth::user()->id)
                ->orWhereIn('direct_upline_id', $downlines);
        })->where('user_type', 4)->get();

//        $my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 4)->get();

        return view('user.cart', compact('carts', 'my_vips', 'selected_user_id'));
    }

    public function showCart2(){

        return view('user.cart2');
    }

    public function showRedeemCart(Request $request)
    {

        $my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 4)->get();
        if (!$request->has('vip_id')) {
            if (sizeof($my_vips) > 0) {
                return redirect()->route('user.redeem-cart', ['vip_id' => $my_vips[0]->id]);
            }
        } else {
            $user = User::where('user_type', 4)->where('direct_upline_id', Auth::user()->id)->where('id', $request->vip_id)->first();
            if (!$user) {
                return redirect()->route('user.redeem-cart');
            }
        }
        $selected_user_id = $request->vip_id;

        $carts = Cart::whereUserId(Auth::user()->id)->where('status', 1)
            ->where(function ($query) use ($selected_user_id) {
                $query->where('to_user_id', $selected_user_id);
            })->whereHas('product_variant', function ($q) {
                $q->where('type', 3);
            })->get();

        $my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 4)->get();

        return view('user.redeem-cart', compact('carts', 'my_vips', 'selected_user_id'));
    }

    public function confirmOrder(Request $request)
    {
        $selected_user_id = Auth::user()->id;
        if ($request->has('vip_id')) {
            //check if selected vip is own and downlines vip

            $downlines = User::where('upline_user_id', Auth::user()->id)->role(['Agent-Executive','Agent-Manager'])->where('user_type', '!=',4)->pluck('id');

            $user = User::where(function ($q) use ($downlines) {
                $q->where('direct_upline_id', Auth::user()->id)
                    ->orWhereIn('direct_upline_id', $downlines);
            })->where('user_type', 4)->where('id', $request->vip_id)->get();

//            $user = User::where('user_type', 4)->where('direct_upline_id', Auth::user()->id)->where('id', $request->vip_id)->first();
            if (!$user) {
                return redirect()->route('user.cart');
            }
            $selected_user_id = $request->vip_id;
        }

        // If not allow order, redirect back.
        if(Auth::user()->allow_order_status == 2) {
            return redirect()->route('user.cart');
        }

        $wallet_id = $request->wallet_id;
        if (!$wallet_id) {
            return abort(404);
        } else if ($wallet_id == 1) {
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
        } else if ($wallet_id == 2) {
            if (Auth::user()->roles[0]->id == 3) {
                return abort(404);
            } else if (Auth::user()->roles[0]->id == 4) {

            } else if (Auth::user()->roles[0]->id == 2) {
                if (getUserManagerPointBalance(Auth::user()->id) == 0) {
                    return abort(404);
                }
            }
        } else if ($wallet_id == 3) {
            if (Auth::user()->roles[0]->id == 3) {
                return abort(404);
            } else if (Auth::user()->roles[0]->id == 4) {
                return abort(404);
            } else if (Auth::user()->roles[0]->id == 2) {

            }
        }
        $carts = Cart::whereUserId(Auth::user()->id)->where('status', 1)->where(function ($query) use ($selected_user_id) {
            if ($selected_user_id == Auth::user()->id) {
                $query->where('to_user_id', Auth::user()->id)
                    ->orWhereNull('to_user_id');
            } else {
                $query->where('to_user_id', $selected_user_id);
            }

        })->whereHas('product_variant', function ($q) {
            $q->whereIn('type', [1, 2]);
        })->get();
        $addressBooks = AddressBook::whereUserId($selected_user_id)->where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        $pickupLocations = PickUpLocation::where('status', 1)->get();

//        $downlines = User::where('upline_user_id', Auth::user()->id)->role(['Agent-Executive','Agent-Manager'])->where('user_type', '!=',4)->pluck('id');
//
//        $my_vips = User::where(function ($q) use ($downlines) {
//            $q->where('direct_upline_id', Auth::user()->id)
//                ->orWhereIn('direct_upline_id', $downlines);
//        })->where('user_type', 4)->get();

        $my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 99)->get();

        return view('user.confirm-order2', compact('carts', 'addressBooks', 'wallet_id', 'countries', 'pickupLocations', 'my_vips', 'selected_user_id'));
    }

    public function confirmOrderRedeem(Request $request)
    {
        if (!$request->has('vip_id')) {
            return redirect()->route('user.redeem-cart');
        }

        // If not allow order, redirect back.
        if(Auth::user()->allow_order_status == 2) {
            return redirect()->route('user.redeem-cart');
        }

        $selected_user_id = $request->vip_id;
        $wallet_id = 4;
        $carts = Cart::whereUserId(Auth::user()->id)->where('status', 1)->where(function ($query) use ($selected_user_id) {
            $query->where('to_user_id', $selected_user_id);
        })->whereHas('product_variant', function ($q) {
            $q->whereIn('type', [3]);
        })->get();
        $addressBooks = AddressBook::whereUserId($selected_user_id)->where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        $pickupLocations = PickUpLocation::where('status', 1)->get();
        $my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 4)->get();


        return view('user.confirm-order-redeem', compact('carts', 'addressBooks', 'wallet_id', 'countries', 'pickupLocations', 'my_vips', 'selected_user_id'));
    }

    public function cartUpdateQuantity(Request $request)
    {
        $cart_id = $request->cart_id;
        $quantity = $request->quantity;
        if ($quantity != 0) {
            $cart_update = Cart::whereId($cart_id)->update([
                'quantity' => $quantity,
            ]);
        } else {
            $cart_update = Cart::whereId($cart_id)->delete();
        }
        promotionItemUpdate(Auth::user()->id);
        if ($cart_update) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }

    }

    public function showCheckout(Request $request)
    {
        return view('user.checkout');
    }

    public function checkout(Request $request)
    {
        $selected_user_id = $request->selected_user_id;
        $carts = Cart::with(['product_variant'])->whereUserId(request('user_id'))->whereStatus(1)
            ->where('status', 1)->where(function ($query) use ($selected_user_id) {
                if ($selected_user_id == Auth::user()->id) {
                    $query->where('to_user_id', Auth::user()->id)
                        ->orWhereNull('to_user_id');
                } else {
                    $query->where('to_user_id', $selected_user_id);
                }

            })->whereHas('product_variant', function ($q) {
                $q->whereIn('type', [1, 2]);
            })->get();

        $wallet_id = $request->wallet_id;
        if (count($carts) > 0) {
            $user = Auth::user();
            if ($request->select_address) {
                $address_books = AddressBook::find($request->select_address);
                $state = $address_books->state;
            } else {
                $state = State::find($request->state);
            }

            $total_item_qty = 0;

            foreach ($carts as $key => $cart) {
                $total_item_qty += $cart->quantity;
            }

            $shippingFees = ShippingFee::whereHas('states', function ($q) use ($state, $total_item_qty) {
                $q->where('state_id', $state->id);
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
            $shipping_fee = $total_item_qty == 0 ? 0 : ($use_sf->price);
            $shipping_add_on = $use_sf->add_on;


            $productTotalPrice = 0;
            $productTotalAddon = 0;
            $productTotalQuantity = 0;

            $total_deduct_for_cash_voucher_count = 0;
            $total_vip_price = 0;
            foreach ($carts as $key => $cart) {
                if ($wallet_id == 1) {
                    $price = $cart->product_variant->agent_executive_price;
                } elseif ($wallet_id == 2) {
                    $price = $cart->product_variant->agent_director_price;
                } elseif ($wallet_id == 3) {
                    $price = $cart->product_variant->merchant_president_price;
                }
                $productTotalQuantity += $cart->quantity;
                $productTotalPrice += $price * $cart->quantity;
                if ($use_product_add_on) {
                    $productTotalAddon += $cart->product_variant->price_add_on * ($cart->quantity);
                }

                if($cart->product_variant->type == 1){
                    $total_deduct_for_cash_voucher_count += $cart->quantity;
                }
            }

            $total_deduct_for_cash_voucher = ((intval($total_deduct_for_cash_voucher_count/5) * 100) + ($total_deduct_for_cash_voucher_count % 5 * 15));

            if (!$use_product_add_on) {
                if ($total_item_qty > $max_quantity_b4_shipping_add_on) {
                    $productTotalAddon += $shipping_add_on * ($total_item_qty - $max_quantity_b4_shipping_add_on);

                } else {
                    $productTotalAddon += 0;
                }
            } else {
                if ($total_item_qty <= $max_quantity_b4_shipping_add_on) {
                    $productTotalAddon = 0;
                }
            }

            //calculate only for mother's day special
            foreach ($carts as $key => $cart) {
                if($cart->product_variant->id == 126){
                    $productTotalAddon += $cart->product_variant->price_add_on * ($cart->quantity);
                }
            }

            $totalAmount = $productTotalPrice;

            if ($wallet_id == 1) {
                $balance = getUserExecutivePointBalance(request('user_id'));
            } elseif ($wallet_id == 2) {
                $balance = getUserManagerPointBalance(request('user_id'));
            } elseif ($wallet_id == 3) {
                $balance = getUserPointBalance(request('user_id'));
            }

            //user balance add (if user is merchant then calculate voucher point also , will deduct all of voucher point then point
            if ($balance + ((Auth::user()->roles[0]->id == 2 && $wallet_id == 3) ? getUserVoucherBalance(Auth::user()->id) : 0) < $totalAmount) {
                return back()->withErrors(['balance' => trans('user-portal.insufficient_point_balance')]);
            }

            if ($request->collect_type == 2) { //collect type = delivery
                //check if shipping point enough
                if (getUserShippingBalance(request('user_id')) < ($shipping_fee + $productTotalAddon)) {
                    return back()->withErrors(['balance' => trans('user-portal.insufficient_shipping_point_balance')]);
                }

            } else {//collect type = pickup
                $productTotalAddon = 0;
                $shipping_fee = 0;
            }

            DB::beginTransaction();
            try {
                if (Auth::user()->roles[0]->id == 2 && $wallet_id == 3) {
                    $voucher_balance = getUserVoucherBalance(Auth::user()->id);

                    if ($voucher_balance > $totalAmount) {
                        $voucher_amount = $totalAmount;
                        $amount = 0;
                    } else {
                        $voucher_amount = $voucher_balance;
                        $amount = $totalAmount - $voucher_amount;
                    }
                } else {
                    $amount = $totalAmount;
                    $voucher_amount = 0;
                }
                if ($request->collect_type == 2) { // delivery then record
                    if ($request->select_address) {
                        $request->request->add(['receiver_name' => $address_books->name]);
                        $request->request->add(['receiver_phone' => $address_books->phone]);
                        $request->request->add(['receiver_address_1' => $address_books->address_1]);
                        $request->request->add(['receiver_address_2' => $address_books->address_2]);
                        $request->request->add(['receiver_city' => $address_books->city]);
                        $request->request->add(['receiver_state' => $address_books->state->name]);
                        $request->request->add(['receiver_postcode' => $address_books->postcode]);
                    } else {
                        $request->request->add(['receiver_name' => $request->name]);
                        $request->request->add(['receiver_phone' => $request->phone]);
                        $request->request->add(['receiver_address_1' => $request->address_1]);
                        $request->request->add(['receiver_address_2' => $request->address_2]);
                        $request->request->add(['receiver_city' => $request->city]);
                        $request->request->add(['receiver_state' => $state->name]);
                        $request->request->add(['receiver_postcode' => $request->postcode]);
                    }
                }

                $request->request->add(['pre_point_balance' => getUserPointBalance(request('user_id'))]);
                $request->request->add(['post_point_balance' => getUserPointBalance(request('user_id')) - $totalAmount]);
                $request->request->add(['amount' => $amount]);
                $request->request->add(['wallet_type' => $wallet_id]);
                $request->request->add(['voucher_amount' => $voucher_amount]);
                $request->request->add(['sub_total' => $productTotalPrice]);
                $request->request->add(['total_add_on' => $productTotalAddon]); //deduct from shipping point
                $request->request->add(['total_shipping' => $shipping_fee]); //deduct from shipping point
                $request->request->add(['cash_voucher_amount' => $selected_user_id != Auth::guard('user')->user()->id ? $total_deduct_for_cash_voucher : 0]); //deduct from shipping point
                $request->request->add(['payment_method_id' => 4]);
                $request->request->add(['collect_type' => request('collect_type')]);
                $request->request->add(['invoice_user_id' => (Auth::user()->roles[0]->id == 2) ? $user->id : $user->upline_user->id]);
                if (request('collect_type') == 1) {
                    $request->request->add(['pickup_location_id' => request('select_pickup')]);
                }
                $request->request->add(['status' => 1]);
                $request->request->add(['order_user_id' => $request->order_user_id]);

                $order = Order::create($request->all());

                if ($order) {
                    if ($selected_user_id != Auth::user()->id) {
                        $total_deduct_for_cash_voucher_count = 0;
                        $total_vip_price = 0;
                    }
                    foreach ($carts as $cart) {
                        if ($selected_user_id != Auth::user()->id) {
                            if ($cart->product_variant->type == 1) {
                                $total_deduct_for_cash_voucher_count += $cart->quantity;
                            }

                            $total_vip_price += ($cart->product_variant->sales_price * $cart->quantity);
                        }

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
                            'product_color' => $cart->product_variant->color->name,
                            'product_size' => $cart->product_variant->size->name,
                            'product_sku' => $cart->product_variant->sku,
                            'sales_price' => $cart->product_variant->sales_price,
                            'merchant_president_price' => $cart->product_variant->merchant_president_price,
                            'agent_director_price' => $cart->product_variant->agent_director_price,
                            'agent_executive_price' => $cart->product_variant->agent_executive_price,
                            'vip_redeem_pv' => $cart->product_variant->vip_redeem_pv,
                            'purchase_price' => $cart->product_variant->price,
                            'price_add_on' => $cart->product_variant->price_add_on,
                            'type' => $cart->type,
                        ]);
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
                            'user_id' => request('user_id'),
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ];
                        if ($wallet_id == 1) {
                            PointExecutiveBalance::create($point_balance_data);
                        } elseif ($wallet_id == 2) {
                            PointManagerBalance::create($point_balance_data);
                        } elseif ($wallet_id == 3) {
                            PointBalance::create($point_balance_data);
                        }

                    }

                    if ($voucher_amount != 0) {
                        VoucherBalance::create([
                            'amount' => '-' . $voucher_amount,
                            'user_id' => request('user_id'),
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }

                    if ($productTotalAddon + $shipping_fee != 0) {
                        ShippingBalance::create([
                            'amount' => '-' . ($productTotalAddon + $shipping_fee),
                            'user_id' => request('user_id'),
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }

                    //vip cash voucher part
                    if ($selected_user_id != Auth::user()->id) {
                        $total_deduct_for_cash_voucher = ((intval($total_deduct_for_cash_voucher_count / 5) * 100) + ($total_deduct_for_cash_voucher_count % 5 * 15));
                        $balance = 0;
                        if (getCashVoucherBalance($selected_user_id) > $total_deduct_for_cash_voucher) {
                            $balance = getCashVoucherBalance($selected_user_id) - $total_deduct_for_cash_voucher;
                        } else {
                            $total_deduct_for_cash_voucher = getCashVoucherBalance($selected_user_id);
                        }

                        $cart_user = User::find($selected_user_id);
                        if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
                            if(!checkIfVIPOrderedThisMonth($selected_user_id)){ //only accept one order per birthday user.
                                $total_deduct_for_cash_voucher = 0;

                                $total_deduct_for_cash_voucher += (intval($total_deduct_for_cash_voucher_count/5) * 160);
                                $item_left = $total_deduct_for_cash_voucher_count % 5;
                                if($item_left <= 3){
                                    $total_deduct_for_cash_voucher += $item_left * 25;
                                }else if($item_left == 4){
                                    $total_deduct_for_cash_voucher += 90;
                                }
                                $balance = 0;
                                if(getCashVoucherBalance($selected_user_id) > $total_deduct_for_cash_voucher){
                                    $balance = getCashVoucherBalance($selected_user_id) - $total_deduct_for_cash_voucher;
                                }else{
                                    $total_deduct_for_cash_voucher = getCashVoucherBalance($selected_user_id);
                                }
                            }
                        }

                        CashVoucherBalance::create([
                            'user_id' => $selected_user_id,
                            'amount' => -($total_deduct_for_cash_voucher),
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
                return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);
            }

        } else {
            return back()->withErrors(['error' => trans('cruds.order.no_items_in_cart')]);
        }


    }

    public function checkoutRedeem(Request $request)
    {
        $selected_user_id = $request->selected_user_id;
        $carts = Cart::with(['product_variant'])->whereUserId(Auth::guard('user')->user()->id)->whereStatus(1)
            ->where('status', 1)->where(function ($query) use ($selected_user_id) {
                $query->where('to_user_id', $selected_user_id);
            })->whereHas('product_variant', function ($q) {
                $q->whereIn('type', [3]);
            })->get();

        $wallet_id = $request->wallet_id;

        if (count($carts) > 0) {
            $user = Auth::user();
            if ($request->select_address) {
                $address_books = AddressBook::find($request->select_address);
                $state = $address_books->state;
            } else {
                $state = State::find($request->state);
            }

            //get actual shipping fee
            $total_item_qty = 0;
            foreach ($carts as $key => $cart) {
                $total_item_qty += $cart->quantity;
            }

            $shippingFees = ShippingFee::whereHas('states', function ($q) use ($state, $total_item_qty) {
                $q->where('state_id', $state->id);
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
            $shipping_fee = $use_sf->price;
            $shipping_add_on = $use_sf->add_on;

            $productTotalPrice = 0;
            $productTotalAddon = 0;
            $productTotalQuantity = 0;
            foreach ($carts as $key => $cart) {

                $price = $cart->product_variant->vip_redeem_pv;

                $productTotalQuantity += $cart->quantity;
                $productTotalPrice += $price * $cart->quantity;

                if ($use_product_add_on) {
                    $productTotalAddon += $cart->product_variant->price_add_on * ($cart->quantity);
                }
            }

            if (!$use_product_add_on) {
                if ($total_item_qty > $max_quantity_b4_shipping_add_on) {
                    $productTotalAddon += $shipping_add_on * ($total_item_qty - $max_quantity_b4_shipping_add_on);

                } else {
                    $productTotalAddon += 0;
                }
            } else {
                if ($productTotalQuantity <= $max_quantity_b4_shipping_add_on) {
                    $productTotalAddon = 0;
                }
            }

            $totalAmount = $productTotalPrice;

            $balance = getPvBalance($selected_user_id);

            //user balance add (if user is merchant then calculate voucher point also , will deduct all of voucher point then point
            if ($balance < $totalAmount) {
                return back()->withErrors(['balance' => trans('user-portal.insufficient_point_balance')]);
            }

            if ($request->collect_type == 2) { //collect type = delivery
                //check if shipping point enough
                if (getUserShippingBalance(Auth::guard('user')->user()->id) < ($shipping_fee + $productTotalAddon)) {
                    return back()->withErrors(['balance' => trans('user-portal.insufficient_shipping_point_balance')]);
                }

            } else {//collect type = pickup
                $productTotalAddon = 0;
                $shipping_fee = 0;
            }

            DB::beginTransaction();
            try {

                $amount = $totalAmount;
                $voucher_amount = 0;

                if ($request->collect_type == 2) { // delivery then record
                    if ($request->select_address) {
                        $request->request->add(['receiver_name' => $address_books->name]);
                        $request->request->add(['receiver_phone' => $address_books->phone]);
                        $request->request->add(['receiver_address_1' => $address_books->address_1]);
                        $request->request->add(['receiver_address_2' => $address_books->address_2]);
                        $request->request->add(['receiver_city' => $address_books->city]);
                        $request->request->add(['receiver_state' => $address_books->state->name]);
                        $request->request->add(['receiver_postcode' => $address_books->postcode]);
                    } else {
                        $request->request->add(['receiver_name' => $request->name]);
                        $request->request->add(['receiver_phone' => $request->phone]);
                        $request->request->add(['receiver_address_1' => $request->address_1]);
                        $request->request->add(['receiver_address_2' => $request->address_2]);
                        $request->request->add(['receiver_city' => $request->city]);
                        $request->request->add(['receiver_state' => $state->name]);
                        $request->request->add(['receiver_postcode' => $request->postcode]);
                    }
                }

                $request->request->add(['pre_point_balance' => getPvBalance($selected_user_id)]);
                $request->request->add(['post_point_balance' => getPvBalance($selected_user_id) - $totalAmount]);
                $request->request->add(['amount' => $amount]);
                $request->request->add(['wallet_type' => 5]);
                $request->request->add(['voucher_amount' => $voucher_amount]);
                $request->request->add(['sub_total' => $productTotalPrice]);
                $request->request->add(['total_add_on' => $productTotalAddon]); //deduct from shipping point
                $request->request->add(['total_shipping' => $shipping_fee]); //deduct from shipping point
                $request->request->add(['payment_method_id' => 4]);
                $request->request->add(['collect_type' => request('collect_type')]);
                $request->request->add(['invoice_user_id' => (Auth::user()->roles[0]->id == 2) ? $user->id : $user->upline_user->id]);
                if (request('collect_type') == 1) {
                    $request->request->add(['pickup_location_id' => request('select_pickup')]);
                }
                $request->request->add(['status' => 1]);
                $request->request->add(['order_user_id' => $request->order_user_id]);

                $order = Order::create($request->all());

                if ($order) {

                    foreach ($carts as $cart) {

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
                            'product_color' => $cart->product_variant->color->name,
                            'product_size' => $cart->product_variant->size->name,
                            'product_sku' => $cart->product_variant->sku,
                            'sales_price' => $cart->product_variant->sales_price,
                            'merchant_president_price' => $cart->product_variant->merchant_president_price,
                            'agent_director_price' => $cart->product_variant->agent_director_price,
                            'agent_executive_price' => $cart->product_variant->agent_executive_price,
                            'vip_redeem_pv' => $cart->product_variant->vip_redeem_pv,
                            'purchase_price' => $cart->product_variant->price,
                            'price_add_on' => $cart->product_variant->price_add_on,
                            'type' => $cart->type,
                        ]);
                        //update cart to check out
                        $cart->update([
                            'status' => 2
                        ]);
                    }
                    $order_number = TransactionIdLog::generateTransactionId(2, $order->user_id, $order->id);
                    $order->update([
                        'order_number' => $order_number,
                    ]);

                    if ($productTotalPrice != 0) {
                        $point_balance_data = [
                            'amount' => '-' . $productTotalPrice,
                            'user_id' => $selected_user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $order_number,
                        ];

                        PvBalance::create($point_balance_data);
                    }

                    if ($productTotalAddon + $shipping_fee != 0) {
                        ShippingBalance::create([
                            'amount' => '-' . ($productTotalAddon + $shipping_fee),
                            'user_id' => Auth::guard('user')->user()->id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $order_number,
                        ]);
                    }

                    DB::commit();

                    return redirect()->route('user.purchase-success-redeem', ['order_id' => $order->id]);
                }

            } catch (\Exception $e) {
                DB::rollBack();
                Log::info($e);
                return redirect()->back()->withErrors(['message' => 'Some error occur. Please contact admin.']);


            }

        } else {
            return back()->withErrors(['error' => trans('cruds.order.no_items_in_cart')]);
        }


    }

    public function getShippingFee(Request $request)
    {
        $state = State::find($request->state_id);
        $quantity = $request->qty;


        $shippingFees = ShippingFee::whereHas('states', function ($q) use ($state, $quantity) {
            $q->where('state_id', $state->id);
        })->orderBy('quantity', 'asc')->pluck('id');


        $shippingFees = ShippingFee::whereIn('id', $shippingFees)->orderByRaw("CAST(quantity as UNSIGNED) ASC")->get();

        $use_sf = null;
        foreach ($shippingFees as $shippingFee) {
            if ($quantity <= $shippingFee->quantity) {
                $use_sf = $shippingFee;
                break;
            }
        }
        if (!($use_sf)) {
            $use_sf = $shippingFees[count($shippingFees) - 1];
        }

        if($request->qty == 0){
            $use_sf->price = 0;
        }

        return json_encode(['success' => true, 'shipping_fee' => $use_sf->price, 'max_quantity' => $use_sf->quantity, 'shipping_fee_add_on' => $use_sf->add_on, 'state_name' => $state->name]);
    }

    public function purchaseSuccess(Request $request)
    {
        $order = Order::find($request->order_id);

        return view('user.purchase-success', compact('order'));
    }

    public function purchaseSuccessRedeem(Request $request)
    {
        $order = Order::find($request->order_id);

        return view('user.purchase-success', compact('order'));
    }


    public function myOrder()
    {
        if (Auth::guard('user')->user()->user_type == 4) {
            $orders = Order::where('order_user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            foreach ($orders as $order) {
                $order_carts = $order->order_item;
                $order->sub_total = 0;
                foreach ($order_carts as $order_cart) {
                    if ($order->wallet_type != 5) {
                        $order->sub_total += $order_cart->sales_price * $order_cart->product_quantity;
                    } else {
                        $order->sub_total += $order_cart->vip_redeem_pv * $order_cart->product_quantity;
                    }
                }
            }
            $to_ship_orders = Order::where('order_user_id', Auth::user()->id)->where('status', 1)->count();
            $to_receive_orders = Order::where('order_user_id', Auth::user()->id)->where('status', 2)->count();
            $cancelled_orders = Order::where('order_user_id', Auth::user()->id)->where('status', 4)->count();
        } else {
            $orders = Order::whereUserId(Auth::user()->id)->orderBy('created_at', 'desc')->get();
            $to_ship_orders = Order::whereUserId(Auth::user()->id)->where('status', 1)->count();
            $to_receive_orders = Order::whereUserId(Auth::user()->id)->where('status', 2)->count();
            $cancelled_orders = Order::whereUserId(Auth::user()->id)->where('status', 4)->count();
        }


        return view('user.my-order', compact('orders', 'to_ship_orders', 'to_receive_orders', 'cancelled_orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::find($id);
        return view('user.order-details', compact('order'));
    }

    public function trackingOrder($id)
    {
        $order = Order::find($id);

        return view('user.order-track', compact('order'));
    }

    public function orderReceiptPDF($id)
    {

//        $invoice = Order::find($id);
//        if ($invoice->user_id != Auth::user()->id) {
//            abort(404);
//        }
//        $invoice->name = "Order Receipt";
//        $invoice->footnote = "Foot Note";
//
//        $invoice_logs = DocumentInvoiceLog::where('name', $invoice->new_invoice_number)->first();
//        if($invoice_logs) {
//            $from_user = User::where('id', $invoice_logs->from_user_id)->first();
//            if(!in_array($from_user->id, [1,2,3], true)) {
//                $invoice->from_name = $from_user->name;
//                $invoice->from_email = $from_user->email;
//                $invoice->from_phone = $from_user->phone;
//            }
//        }
//
//        $pdf = PDF::loadView('user.print.order-invoice', compact('invoice'));
//        $pdf->setOption('print-media-type', true);
//        $pdf->setOption('margin-bottom', '0mm');
//        $pdf->setOption('margin-top', '1mm');
//        $pdf->setOption('margin-right', '3mm');
//        $pdf->setOption('margin-left', '0mm');
//        return $pdf->inline($invoice->name . ".pdf");

        $newInvoice = Order::findOrFail($id);

        if ($newInvoice->invoice_number == null) {
            $newInvoice->update([
                'invoice_number' => DocumentNumberLog::generateDocumentNumber(1, $newInvoice->user_id),
                'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($newInvoice->user_id)
            ]);
        }

        $invoice = Order::findOrFail($newInvoice->id); // Check order order_user_id and decide display different price
        $invoice->name = "Order Invoice-" . $invoice->new_invoice_number;
        $invoice->footnote = "Foot Note";

        $invoice_logs = DocumentInvoiceLog::where('name', $invoice->new_invoice_number)->first();
        if($invoice_logs) {
            $from_user = User::where('id', $invoice_logs->from_user_id)->first();
            if(!in_array($from_user->id, [1,2,3], true)) {
                $invoice->from_name = $from_user->name;
                $invoice->from_email = $from_user->email;
                $invoice->from_phone = $from_user->phone;
            }
        }

        // $role = ModelHasRole::where('model_id', $invoice->order_user_id)->where('model_type', 'App\Models\User')->first();
        // Invoice_user_id confirm is millionaire
        // Document invoice_log user_id is millionaire invoice_user_id,
        // Order's Invoice_user_Id created_at must be late than user_agreement_logs's signature_at, user_agreement_id = 3
        $user_entries = UserAgreementLog::where('user_id', $invoice->user_id)->orderBy('id', 'ASC')->get();
        if($user_entries) {
            foreach($user_entries as $item) {
                if($invoice->completed_at >= $item->signature_at) {
                    // echo "ID: " . $item->id . " AgreementID: " . $item->user_agreement_id . " Created Time: " . $item->created_at . "<br>";
                    switch($item->user_agreement_id) {
                        case 1:
                            $roleNo = 4;
                            break;
                        case 2:
                            $roleNo = 3;
                            break;
                        case 3:
                            $roleNo = 2;
                            break;
                        default:
                            $roleNo = 2;
                    }
                }
            }
        } else {
            $role = ModelHasRole::where('model_id', $invoice_logs->user_id)->where('model_type', 'App\Models\User')->first();
            $roleNo = $role->role_id;
        }
        // dd($invoice, $user_entries, $roleNo);

        $order_item = OrderItem::where('order_id', $invoice->id)->get();

        // dd($role, $invoice->order_user_id, $invoice_logs->user_id);
        $invoice_item_from_user = [];
        $display_price = [];
        $total_per_variant = [];
        $product_name = [];
        $product_description = [];
        $product_quantity = [];

        foreach($order_item as $key => $item) {
            if($item->product_variant_id != null){
                $invoice_item_from_user['record'][$key]['product_name'] = $item->name;
                $invoice_item_from_user['record'][$key]['product_description'] = $item->product_color.', '. $item->product_size;
                $invoice_item_from_user['record'][$key]['product_quantity'] = $item->product_quantity;
                $invoice_item_from_user['record'][$key]['type'] = $item->type;

                switch($roleNo) {
                    case 2: // Millionaire
                        $invoice_item_from_user['record'][$key]['product_price'] = $item->merchant_president_price;
                        $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->merchant_president_price * $item->product_quantity;
                        break;
                    case 4: // Manager
                        $invoice_item_from_user['record'][$key]['product_price'] = $item->agent_director_price;
                        $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->agent_director_price * $item->product_quantity;
                        break;
                    case 3: // Executive
                        $invoice_item_from_user['record'][$key]['product_price'] = $item->agent_executive_price;
                        $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->agent_executive_price * $item->product_quantity;
                        break;
                    case 8: // VIP
                        $invoice_item_from_user['record'][$key]['product_price'] = $item->sales_price;
                        $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->sales_price * $item->product_quantity;
                        break;
                    default:
                        $invoice_item_from_user['record'][$key]['product_price'] = $item->merchant_president_price;
                        $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->merchant_president_price * $item->product_quantity;
                }
            }
        }

        $subtotal = 0;
        foreach($invoice_item_from_user['record'] as $item) {
            if($item['type'] == 1){
                $subtotal += $item['total_per_variant'];
            }
        }

        $invoice_item_from_user['subtotal'] = $subtotal;

        // dd($invoice, $role, $display_price, $total_per_variant, $subtotal, $invoice_item_from_user);

        $pdf = PDF::loadView('user.print.order-invoice', compact('invoice', 'invoice_item_from_user'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($invoice->name . ".pdf");
    }
}
