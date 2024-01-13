<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreOrderShipRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\AddressBook;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\DepositBank;
use App\Models\DocumentNumberLog;
use App\Models\DocumentCreditNoteLog;
use App\Models\DocumentInvoiceLog;
use App\Models\DocumentShippingInvoiceLog;
use App\Models\DocumentMBRInvoiceLog;
use App\Models\ModelHasRole;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\PointBalance;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\CashVoucherBalance;
use App\Models\PvBalance;
use App\Models\ProductQuantity;
use App\Models\ProductVariant;
use App\Models\ScanLog;
use App\Models\ShippingBalance;
use App\Models\ShippingCompany;
use App\Models\ShippingFee;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\VoucherBalance;
use App\Models\UserAgreementLog;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->vip_voucher_product_id = 18;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->is('admin/orders/new')) {
                $request->request->add(['status' => 1]);
            } else if ($request->is('admin/orders/shipped')) {
                $request->request->add(['status' => 2]);
            } else if ($request->is('admin/orders/picked-up')) {
                $request->request->add(['status' => 3]);
            } else if ($request->is('admin/orders/completed')) {
                $request->request->add(['status' => 5]);
            } else if ($request->is('admin/orders/cancelled')) {
                $request->request->add(['status' => 4]);
            }

            $query = Order::with(['user', 'cart', 'payment_method', 'shipped_by', 'picked_up_by', 'completed_by', 'refund_by', 'shipping_company'])->search($request)->select(sprintf('%s.*', (new Order())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_show';
                $editGate = 'order_edit';
                $deleteGate = 'order_delete';
                $toShipGate = 'order_to_ship';
                $toPickUpGate = 'order_to_pick_up';
                $cancelGate = 'order_cancel';
                $completeGate = 'order_complete';
                $crudRoutePart = 'orders';

                return view('partials.datatablesActions_Order', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'toShipGate',
                    'toPickUpGate',
                    'cancelGate',
                    'completeGate',
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

            $table->addColumn('cart_quantity', function ($row) {
                return $row->cart ? $row->cart->quantity : '';
            });

            $table->editColumn('order_number', function ($row) {
                return $row->order_number ? $row->order_number : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->editColumn('receiver_name', function ($row) {
                return $row->receiver_name ? $row->receiver_name : '';
            });
            $table->editColumn('receiver_phone', function ($row) {
                return $row->receiver_phone ? $row->receiver_phone : '';
            });
            $table->editColumn('receiver_address_1', function ($row) {
                return $row->receiver_address_1 ? $row->receiver_address_1 : '';
            });
            $table->editColumn('receiver_address_2', function ($row) {
                return $row->receiver_address_2 ? $row->receiver_address_2 : '';
            });
            $table->editColumn('receiver_city', function ($row) {
                return $row->receiver_city ? $row->receiver_city : '';
            });
            $table->editColumn('receiver_state', function ($row) {
                return $row->receiver_state ? $row->receiver_state : '';
            });
            $table->editColumn('receiver_postcode', function ($row) {
                return $row->receiver_postcode ? $row->receiver_postcode : '';
            });
            $table->editColumn('pre_point_balance', function ($row) {
                return $row->pre_point_balance ? $row->pre_point_balance : '';
            });
            $table->editColumn('post_point_balance', function ($row) {
                return $row->post_point_balance ? $row->post_point_balance : '';
            });
            $table->editColumn('collect_type', function ($row) {
                if ($row->collect_type == 1) {
                    return $row->collect_type ? Order::COLLECT_TYPE_SELECT[$row->collect_type] . ($row->pickup_location ? " (" . $row->pickup_location->name . ")" : '') : '';
                } else {
                    return $row->collect_type ? Order::COLLECT_TYPE_SELECT[$row->collect_type] . ($row->receiver_state ? " (" . $row->receiver_state . ")" : '') : '';
                }

            });
            $table->addColumn('shipped_by_name', function ($row) {
                return $row->shipped_by ? $row->shipped_by->name : '';
            });

            $table->addColumn('picked_up_by_name', function ($row) {
                return $row->picked_up_by ? $row->picked_up_by->name : '';
            });

            $table->addColumn('completed_by_name', function ($row) {
                return $row->completed_by ? $row->completed_by->name : '';
            });

            $table->addColumn('refund_by_name', function ($row) {
                return $row->refund_by ? $row->refund_by->name : '';
            });

            $table->addColumn('shipping_company_name', function ($row) {
                return $row->shipping_company ? $row->shipping_company->name : '';
            });

            $table->editColumn('tracking_code', function ($row) {
                return $row->tracking_code ? $row->tracking_code : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Order::STATUS_SELECT[$row->status] : '';
            });

            $table->editColumn('receiver_location', function ($row) {
                if ($row->collect_type == 1) {
                    return $row->pickup_location ? $row->pickup_location->name : '';
                } else {
                    return $row->receiver_state ? $row->receiver_state : '';
                }

            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'cart', 'payment_method', 'shipped_by', 'picked_up_by', 'completed_by', 'refund_by', 'shipping_company']);

            return $table->make(true);
        }

        return view('admin.orders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::whereNotIn('user_type',[4])->get();

        $carts = Cart::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipped_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $picked_up_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $completed_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refund_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ShippingCompany::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('users', 'carts', 'payment_methods', 'shipped_bies', 'picked_up_bies', 'completed_bies', 'refund_bies', 'shipping_companies'));
    }

    public function store(StoreOrderRequest $request)
    {
        $carts = Cart::with(['product_variant'])->whereUserId(request('user_id'))->whereStatus(1)->get();

        if (count($carts) > 0) {

            $wallet_id = $request->wallet_id;
            $wallet_type = 1;

            $user = User::findOrFail(request('user_id'));

            $address_books = AddressBook::whereUserId($user->id)->whereSetDefault(1)->whereStatus(1)->first();
            $shipping_fee = $address_books->state->shippingFees[0]->price;

            $productTotalPrice = 0;
            $productTotalAddon = 0;

            $to_user_id = 0;

            foreach ($carts as $cart) {

                if($wallet_id == NULL){
                    if ($user->roles[0]->id == 3) {
                        $productTotalPrice += $cart->product_variant->agent_executive_price * $cart->quantity;
                    } elseif ($user->roles[0]->id == 4) {
                        $productTotalPrice += $cart->product_variant->agent_director_price * $cart->quantity;
                    } elseif ($user->roles[0]->id == 2) {
                        $productTotalPrice += $cart->product_variant->merchant_president_price * $cart->quantity;
                    }
                }else if($wallet_id == "1"){
                    $productTotalPrice += $cart->product_variant->agent_executive_price * $cart->quantity;
                }else if($wallet_id == "2"){
                    $productTotalPrice += $cart->product_variant->agent_director_price * $cart->quantity;
                }else if($wallet_id == "3"){
                    $productTotalPrice += $cart->product_variant->merchant_president_price * $cart->quantity;
                }
                $productTotalAddon += $cart->product_variant->price_add_on * $cart->quantity;

                $to_user_id = $cart->to_user_id;
            }

            $totalAmount = $productTotalPrice;

            if($wallet_id == NULL){
                if ($user->roles[0]->id == 3) {
                    $balance = getUserExecutivePointBalance($user->id);
                    $wallet_type = 1;
                } elseif ($user->roles[0]->id == 4) {
                    $balance = getUserManagerPointBalance($user->id);
                    $wallet_type = 2;
                } elseif ($user->roles[0]->id == 2) {
                    $balance = getUserPointBalance($user->id);
                    $wallet_type = 3;
                }
            }else if($wallet_id == "1"){
                $balance = getUserExecutivePointBalance($user->id);
                $wallet_type = 1;
            }else if($wallet_id == "2"){
                $balance = getUserManagerPointBalance($user->id);
                $wallet_type = 2;
            }else if($wallet_id == "3"){
                $balance = getUserPointBalance($user->id);
                $wallet_type = 3;
            }


//            user balance add (if user is merchant then calculate voucher point also , will deduct all of voucher point then point
//            if (getUserPointBalance($user->id) + ($user->roles[0]->id == 2 ? getUserVoucherBalance($user->id) : 0) < $totalAmount) {
//                return back()->with('error', trans('cruds.order.fields.insufficient_point'));
//            }

            if ($balance < $totalAmount) {
                return back()->with('error', trans('cruds.order.fields.insufficient_point'));
            }

            if ($request->collect_type == 2) { //collect type = delivery
                //check if shipping point enough
                if (getUserShippingBalance($user->id) < ($shipping_fee + $productTotalAddon)) {
                    return back()->with('error', trans('cruds.order.fields.insufficient_shipping_point'));
                }
            } else { //collect type = pickup
                $productTotalAddon = 0;
                $shipping_fee = 0;
            }

            DB::beginTransaction();

            try {
                if ($user->roles[0]->id == 2) {
                    $voucher_balance = getUserVoucherBalance($user->id);
                    $point_balance  = getUserPointBalance($user->id);

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

                $request->request->add(['receiver_name' => $address_books->name]);
                $request->request->add(['receiver_phone' => $address_books->phone]);
                $request->request->add(['receiver_address_1' => $address_books->address_1]);
                $request->request->add(['receiver_address_2' => $address_books->address_2]);
                $request->request->add(['receiver_city' => $address_books->city]);
                $request->request->add(['receiver_state' => $address_books->state->name]);
                $request->request->add(['receiver_postcode' => $address_books->postcode]);
                $request->request->add(['pre_point_balance' => getUserPointBalance(request('user_id'))]);
                $request->request->add(['post_point_balance' => getUserPointBalance(request('user_id')) - $amount]);
                $request->request->add(['amount' => $amount]);
                $request->request->add(['voucher_amount' => $voucher_amount]);
                $request->request->add(['sub_total' => $productTotalPrice]);
                $request->request->add(['total_add_on' => $productTotalAddon]);
                $request->request->add(['total_shipping' => $shipping_fee]);
                $request->request->add(['payment_method_id' => 4]);
                $request->request->add(['collect_type' => request('collect_type')]);
                $request->request->add(['wallet_type' => $wallet_type]);

                $request->request->add(['invoice_user_id' => ($user->roles[0]->id == 2) ? $user->id : $user->upline_user->id]);

                $request->request->add(['user_id' => $user->id]);
                $request->request->add(['order_user_id' => $to_user_id]);

                $request->request->add(['status' => 1]);

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
                            'product_quantity' => $cart->quantity,
                            'product_color' => $cart->product_variant->color->name,
                            'product_size' => $cart->product_variant->size->name,
                            'product_sku' => $cart->product_variant->sku,
                            'sales_price' => $cart->product_variant->sales_price,
                            'merchant_president_price' => $cart->product_variant->merchant_president_price,
                            'agent_director_price' => $cart->product_variant->agent_director_price,
                            'agent_executive_price' => $cart->product_variant->agent_executive_price,
                            'purchase_price' => (($wallet_type == 1) ? $cart->product_variant->agent_executive_price: (($wallet_type == 2) ? $cart->product_variant->agent_director_price: $cart->product_variant->merchant_president_price)),
                            'price_add_on' => $cart->product_variant->price_add_on,
                            'type' => $cart->type,
                            'admin_id' => Auth::guard('admin')->user()->id,
                            'is_new' => 1,
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

                    $point_balance_data = [
                        'amount' => '-' . $productTotalPrice,
                        'user_id' => $user->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "redeem order " . $order_number,
                    ];

                    if($wallet_id == NULL){
                        if ($user->roles[0]->id == 3) {
                            PointExecutiveBalance::create($point_balance_data);
                        } elseif ($user->roles[0]->id == 4) {
                            PointManagerBalance::create($point_balance_data);
                        } elseif ($user->roles[0]->id == 2) {
                            PointBalance::create($point_balance_data);
                        }
                    } else if($wallet_id == "1"){
                        PointExecutiveBalance::create($point_balance_data);
                    }else if($wallet_id == "2"){
                        PointManagerBalance::create($point_balance_data);
                    }else if($wallet_id == "3"){
                        PointBalance::create($point_balance_data);
                    }

//                    PointBalance::create([
//                        'amount' => '-' . $totalAmount,
//                        'user_id' => request('user_id'),
//                        'status' => 1,
//                        'settlement' => 1,
//                        'remark' => "redeem order " . $order_number,
//                    ]);
                    DB::commit();
                    return redirect()->route('admin.orders.index');
                } else {
                    DB::rollBack();
                    return back();
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Log::info($e);
                return back();
            }
        } else {
            return back()->with('error', trans('cruds.order.fields.no_items_in_cart'));
        }


    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carts = Cart::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipped_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $picked_up_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $completed_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refund_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ShippingCompany::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('user', 'cart', 'payment_method', 'shipped_by', 'picked_up_by', 'completed_by', 'refund_by', 'shipping_company');

        return view('admin.orders.edit', compact('users', 'carts', 'payment_methods', 'shipped_bies', 'picked_up_bies', 'completed_bies', 'refund_bies', 'shipping_companies', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shipping_companies = ShippingCompany::whereStatus('1')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $order->load('user', 'cart', 'payment_method', 'shipped_by', 'picked_up_by', 'completed_by', 'refund_by', 'shipping_company');

        $order_user_role = ModelHasRole::where('model_id', $order->order_user_id)->where('model_type', 'App\Models\User')->first();
        $is_vip = ($order_user_role && $order_user_role->role_id == 8) ? true : false;

        $product_count = 0;
        $quantity_count = 0;
        foreach ($order->order_item as $item) {
            if($item->is_new == 1 && $item->parent_id == null) {

            } else {
                $product_count += count($item->product_detail);
                $quantity_count += $item->product_quantity;
            }
        }

        return view('admin.orders.show', compact('order', 'shipping_companies', 'product_count', 'quantity_count', 'is_vip'));
    }

    public function orderAddOrderItem(Request $request)
    {
        $method = $request->method();

        if ($request->isMethod('post')) {
            $order_id = request('id');
            $product_variant_id = request('product_variant_id');
            $product_quantity = request('quantity');
            $type = request('type');

            $order = Order::findOrFail($order_id);
            $product_variant = ProductVariant::findOrFail($product_variant_id);
            $user = $order->user;

            $purchase_price = 0;

            if($user->user_type == 1){
                $purchase_price = $product_variant->agent_executive_price;
            }else if($user->user_type == 2){
                $purchase_price = $product_variant->agent_director_price;
            }else if($user->user_type == 3){
                $purchase_price = $product_variant->merchant_president_price;
            }

//            if ($order->status == 4 || $order->status == 5){
//                return redirect()->route('admin.orders.show', $order_id);
//            }else{

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product_variant->product->id,
                    'product_variant_id' => $product_variant_id,
                    'product_name_en' => $product_variant->product->name_en,
                    'product_name_zh' => $product_variant->product->name_zh,
                    'product_desc_en' => $product_variant->product->desc_en,
                    'product_desc_zh' => $product_variant->product->desc_zh,
                    'product_quantity' => $product_quantity,
                    'product_color' => $product_variant->color->name,
                    'product_size' => $product_variant->size->name,
                    'product_sku' => $product_variant->sku,
                    'purchase_price' => ($type == 1) ? $purchase_price : "0",
                    'sales_price' => $product_variant->sales_price,
                    'merchant_president_price' => $product_variant->merchant_president_price,
                    'agent_director_price' => $product_variant->agent_director_price,
                    'agent_executive_price' => $product_variant->agent_executive_price,
                    'price_add_on' => $product_variant->price_add_on,
                    'type' => $type,
                    'is_new' => 1,
                    'admin_id' => Auth::user()->id
                ]);

                return redirect()->route('admin.orders.show', $order_id);
//            }
        }else{

            $order_id = request('id');

            $order = Order::findOrFail($order_id);

//            if ($order->status == 4 || $order->status == 5){
//                return redirect()->route('admin.orders.show', $order_id);
//            }else{

                $product_variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

                return view('admin.orders.add_order_item', compact('product_variants', 'order'));
//            }
//            echo $order;
        }
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function toShip(Request $request)
    {
        $order = Order::findOrFail(request('id'));

        $variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ShippingCompany::whereStatus('1')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.to_ship', compact('shipping_companies', 'variants', 'order'));
    }

    public function confirmShip(StoreOrderShipRequest $request)
    {
        DB::beginTransaction();

        try {

            // Loop Order Item, if have contain this voucher product 16.
            // If yes check order'table user_ID, If exist user_id give user_id, else give order_user_id.
            $order = Order::findOrFail(request('id'));
            $order_id = $order->id;
            $voucher_order_item = OrderItem::leftJoin('products AS p', 'order_items.product_id', 'p.id')
                ->leftJoin('product_categories AS pc', 'p.category_id', 'pc.id')
                ->where('order_id', $order_id)
                ->where('product_id', $this->vip_voucher_product_id)
                ->select(
                    'order_items.product_quantity AS productQuantity',
                    'pc.id AS productCategoryId',
                )
                ->where('pc.id', 6)
                ->first();

            if ($voucher_order_item) {
                $beneficial_user_id = null;
                if ($order->order_user_id != null) {
                    if ($order->user_id != $order->order_user_id) {
                        $beneficial_user_id = $order->order_user_id;
                    } else {
                        $beneficial_user_id = $order->user_id;
                    }
                } else {
                    $beneficial_user_id = $order->user_id;
                }

                for ($x = 1; $x <= $voucher_order_item->productQuantity; $x += 1) {
                    CashVoucherBalance::create([
                        'amount' => '688',
                        'status' => '1',
                        'settlement' => '1',
                        'remark' => 'VIP cash voucher ' . $order->order_number . " (" . $x . ")",
                        'user_id' => $beneficial_user_id
                    ]);
                }
            }
            // If user_id is different order_user_id. If got cash voucher - subtotal - cash_voucher to order user_id.
            // Also check order_user_id is VIP(role ID - 8) or not. If yes PV Balance
            // VIP's sales price * product_quantity - cash_voucher_amount;
            if ($order) {
                if ($order->user_id != $order->order_user_id) {
                    $checkVIP = ModelHasRole::where('model_id', $order->order_user_id)->where('model_type', 'App\Models\User')->first();
                    if ($checkVIP && $checkVIP->role_id == 8) {
                        $order_item = OrderItem::leftJoin('products AS p', 'order_items.product_id', 'p.id')
                            ->leftJoin('product_categories AS pc', 'p.category_id', 'pc.id')
                            ->select('sales_price', 'product_quantity')
                            ->where('order_id', $order_id)
                            ->get();

                        $salesAmount = 0;
                        foreach ($order_item as $item) {
                            $salesAmount += $item->sales_price * $item->product_quantity;
                        }
                        if ($order->cash_voucher_amount != null || $order->cash_voucher_amount != 0) {
                            $pvAmount = $salesAmount - $order->cash_voucher_amount;
                            $exRemark = " with cash voucher amount: " . $order->cash_voucher_amount;
                        } else {
                            $pvAmount = $salesAmount;
                            $exRemark = "";
                        }

                        $cart_user = User::find($order->order_user_id);
                        if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
                            // Problem - Scenario - When Have Three Record, Only The Admin Pending The Last Remaining Record, VIP will able to get the Double PV
                            $orders = Order::where("order_user_id", $order->order_user_id)->where('status' ,'!=' , '4')->whereMonth('created_at', '=', date('n'))->whereYear('created_at', '=', date('Y'))->count();
                            if(($orders - 1) == 0) {
                                $pvAmount = $pvAmount * 2;
                            }

                            // Problem - This work for Admin Approve First Record and Double VIP Amount. But No Care About VIP first Order.
                            // $orderExist = Order::where("order_user_id", $order->order_user_id)->whereIn('status', [2,3,5])->whereMonth('created_at', '=', date('n'))->whereYear('created_at', '=', date('Y'))->first();
                            // if(!$orderExist) {
                            //     $pvAmount = $pvAmount * 2;
                            // }

                            // Check All Current Exist VIP Order in this month order by id.
                            // $allExistedOrder = Order::select('id', 'status')->where("order_user_id", $order->order_user_id)->whereIn('status', [1,2,3,5])
                            // ->whereMonth('created_at', '=', date('n'))->whereYear('created_at', '=', date('Y'))->orderBy('id', 'asc')->get();
                            // foreach($allExistedOrder as $item) {
                            //     // If Current Pending Record where its earlier record existed Shipped, Pick Up, Completed mean already get the bonus.
                            //     if($item->status == 2 && $item->status == 3 && $item->status == 5) {
                            //         break 1; // Already Get The Bonus
                            //     } else {
                            //         // Check The First order's status is still pending or not.
                            //         if($allExistedOrder[0]->status == 1) {
                            //             // Check Admin is Currently Pending Order is First Record of the order in this month.
                            //             if($order->id == $allExistedOrder[0]->id) {
                            //                 $pvAmount = $pvAmount * 2; // When Admin Perform The VIP First Order In Birthday Month Than Double the PV Amount
                            //                 break 1;
                            //             }
                            //         }
                            //     }
                            // }

                        }

                        PVBalance::create([
                            'amount' => $pvAmount,
                            'status' => '1',
                            'settlement' => '1',
                            'remark' => 'PV Balance Confirm Shipping ' . $order->order_number . $exRemark,
                            'user_id' => $order->order_user_id
                        ]);
                    }
                }
            }

            // Document Logs
            $user = User::where('id', $order->user_id)->first();
            if($user) {

                $check_user_role = ModelHasRole::where('model_id', $order->user_id)->where('model_type', 'App\Models\User')->first();
                $check_upline_role = ModelHasRole::where('model_id', $user->upline_user_id)->where('model_type', 'App\Models\User')->first();
                $shipping_invoice_status = ($check_user_role->role_id != $check_upline_role->role_id) ? true : false;
                $upline_user_id = $user->upline_user_id;
            }

            $user_id = $order->user_id;
            $order->update([
                'shipping_company_id' => request('shipping_company_id'),
                'tracking_code' => request('tracking_code'),
                'status' => 2,
                'shipped_by_id' => Auth::guard('admin')->user()->id,
                'shipout_at' => Carbon::now(),
                'invoice_number' => DocumentNumberLog::generateDocumentNumber("1", $user_id),
                'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($user_id, $upline_user_id),
                'shipping_invoice_number' => $shipping_invoice_status ? DocumentShippingInvoiceLog::generateDocumentNumber(1, $user_id) : null
            ]);

            $order = Order::findOrFail(request('id'));
            $order_item = OrderItem::where('order_id', $order_id)->select(DB::raw('SUM(product_quantity) AS product_quantity'))->first();
            $product_quantity = 1;
            if($order_item) {
                $product_quantity = $order_item->product_quantity;
            }
//            $documentMBRInvoiceLog = DocumentMBRInvoiceLog::generateDocumentNumber($user_id, $upline_user_id, null, $order->amount, 0);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return back();
    }

    public function toCancel(Request $request)
    {
        DB::beginTransaction();

        try {
            // VIP Bonus Cancellation
            // WALLET TYPE = 5, If 5 Add BACK PV balance. Wallet Type 5 - Agent help VIP redeem product.
            // Check Cash Voucher is not equal 0, then return how much to them.
            // Only VIP have PV balance - Order's order_user_id.

            $model = Order::findOrFail(request('id'));
            $amount = $model->amount;
            $voucher_amount = $model->voucher_amount;
            $total_add_on = $model->total_add_on;
            $total_shipping = $model->total_shipping;
            $user_id = $model->user_id;
            $order_number = $model->order_number;
            $order_item = $model->order_item;
            $wallet_type = $model->wallet_type;
            $model->update([
                'status' => 4,
                'refund_by_id' => Auth::guard('admin')->user()->id,
                'refund_at' => Carbon::now(),
                'credit_note_number' => DocumentCreditNoteLog::generateDocumentNumber($user_id)
            ]);

            $order = Order::findOrFail(request('id'));
            if ($order->wallet_type == 5) {
                if ($order->cash_voucher_amount != null && $order->cash_voucher_amount != 0) {
                    PvBalance::create([
                        'amount' => $order->cash_voucher_amount,
                        'status' => '1',
                        'settlement' => '1',
                        'remark' => 'refund order ' . $order_number,
                        'user_id' => $order->order_user_id
                    ]);
                }
            }

            $user_id = $order->user_id;

//            if($order->order_type == 1){
                if ($wallet_type == 1) {
                    $modelCheck = PointExecutiveBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                    if($modelCheck == 1){
                        PointExecutiveBalance::create([
                            'amount' => $amount,
                            'user_id' => $user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "refund order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }

                } else if ($wallet_type == 2) {

                    $modelCheck = PointManagerBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                    if($modelCheck == 1){
                        PointManagerBalance::create([
                            'amount' => $amount,
                            'user_id' => $user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "refund order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }

                } else if ($wallet_type == 3) {

                    $modelCheck = PointBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                    if($modelCheck == 1){
                        PointBalance::create([
                            'amount' => $amount,
                            'user_id' => $user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "refund order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }

                }
                // else if ($wallet_type == 4) {
                //     CashVoucherBalance::create([
                //         'amount' => $amount,
                //         'user_id' => $user_id,
                //         'status' => 1,
                //         'settlement' => 1,
                //         'remark' => "refund order " . $order_number,
                //     ]);
                // }
                else if ($wallet_type == 5) {
                    $modelCheck = PvBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                    if($modelCheck == 1){
                        PvBalance::create([
                            'amount' => $amount,
                            'user_id' => $user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "refund order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }
                }

                if($order->user_id != $order->order_user_id) {
                    if($order->cash_voucher_amount != null && $order->cash_voucher_amount != 0) {

                        $modelCheck = CashVoucherBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                        if($modelCheck == 1){
                            CashVoucherBalance::create([
                                'amount' => $amount,
                                'user_id' => $user_id,
                                'status' => 1,
                                'settlement' => 1,
                                'remark' => "refund order " . $order_number,
                                'model_type' => '\App\Models\Order',
                                'model' => $order->id,
                            ]);
                        }

                    }
                }

                if ($voucher_amount != 0) {

                    $modelCheck = VoucherBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                    if($modelCheck == 1){
                        VoucherBalance::create([
                            'amount' => $voucher_amount,
                            'user_id' => $user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "refund order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }
                }

                if ($total_shipping != 0) {

                    $modelCheck = ShippingBalance::where('model_type', '\App\Models\Order')->where('model', $order->id)->where('user_id', $user_id)->count();

                    if($modelCheck == 1){
                        ShippingBalance::create([
                            'amount' => $total_shipping + $total_add_on,
                            'user_id' => $user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "refund order " . $order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $order->id,
                        ]);
                    }

                }










            foreach ($order_item as $item) {
                ProductQuantity::whereOrderItemId($item->id)->update([
                    'order_item_id' => null,
                    'sold_to_user_id' => null,
                    'status' => 2
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return back();
    }

    public function toComplete(Request $request)
    {
        $model = Order::findOrFail(request('id'));

        $orderItem = $model->order_item;

        $model->update([
            'status' => 5,
            'completed_by_id' => Auth::guard('admin')->user()->id,
            'completed_at' => Carbon::now(),
        ]);

        if ($model) {
            foreach ($orderItem as $item) {
                ProductQuantity::whereOrderItemId($item->id)->update([
                    'status' => 4
                ]);
            }
        }

        return back();
    }

    public function toPickUp(Request $request)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail(request('id'));
            $order_id = $order->id;
            // $order_item = OrderItem::where('order_id', $order_id)->where('product_id', $this->vip_voucher_product_id)->first();
            $voucher_order_item = OrderItem::leftJoin('products AS p', 'order_items.product_id', 'p.id')
                ->leftJoin('product_categories AS pc', 'p.category_id', 'pc.id')
                ->where('order_id', $order_id)
                ->where('product_id', $this->vip_voucher_product_id)
                ->select(
                    'order_items.product_quantity AS productQuantity',
                    'pc.id AS productCategoryId',
                )
                ->where('pc.id', 6)
                ->first();

            if ($voucher_order_item) {
                $beneficial_user_id = null;
                if ($order->order_user_id != null) {
                    if ($order->user_id != $order->order_user_id) {
                        $beneficial_user_id = $order->order_user_id;
                    } else {
                        $beneficial_user_id = $order->user_id;
                    }
                } else {
                    $beneficial_user_id = $order->user_id;
                }

                for ($x = 1; $x <= $voucher_order_item->productQuantity; $x += 1) {
                    CashVoucherBalance::create([
                        'amount' => '688',
                        'status' => '1',
                        'settlement' => '1',
                        'remark' => 'VIP cash voucher ' . $order->order_number . " (" . $x . ")",
                        'user_id' => $beneficial_user_id
                    ]);
                }
            }

            if ($order) {
                if ($order->user_id != $order->order_user_id) {
                    $checkVIP = ModelHasRole::where('model_id', $order->order_user_id)->where('model_type', 'App\Models\User')->first();
                    if ($checkVIP && $checkVIP->role_id == 8) {
                        $order_item = OrderItem::leftJoin('products AS p', 'order_items.product_id', 'p.id')
                            ->leftJoin('product_categories AS pc', 'p.category_id', 'pc.id')
                            ->select('sales_price', 'product_quantity')
                            ->where('order_id', $order_id)
                            ->get();

                        $salesAmount = 0;
                        foreach ($order_item as $item) {
                            $salesAmount += $item->sales_price * $item->product_quantity;
                        }
                        if ($order->cash_voucher_amount != null || $order->cash_voucher_amount != 0) {
                            $pvAmount = $salesAmount - $order->cash_voucher_amount;
                            $exRemark = " with cash voucher amount: " . $order->cash_voucher_amount;
                        } else {
                            $pvAmount = $salesAmount;
                            $exRemark = "";
                        }

                        $cart_user = User::find($order->order_user_id);
                        if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
                            $orders = Order::where("order_user_id", $order->order_user_id)->where('status' ,'!=' , '4')->whereMonth('created_at', '=', date('n'))->whereYear('created_at', '=', date('Y'))->count();
                            if(($orders - 1) == 0) {
                                $pvAmount = $pvAmount * 2;
                            }

                            // NEED UPDATE
                        }

                        PVBalance::create([
                            'amount' => $pvAmount,
                            'status' => '1',
                            'settlement' => '1',
                            'remark' => 'PV Balance Confirm Pickup ' . $order->order_number . $exRemark,
                            'user_id' => $order->order_user_id
                        ]);
                    }
                }
            }

            // Document Logs
            $user = User::where('id', $order->user_id)->first();
            if($user) {
                $upline_user_id = $user->upline_user_id;
            }

            $user_id = $order->user_id;

            $order->update([
                'status' => 3,
                'picked_up_by_id' => Auth::guard('admin')->user()->id,
                'pickup_at' => Carbon::now(),
                'invoice_number' => DocumentNumberLog::generateDocumentNumber("1", $user_id),
                'new_invoice_number' => DocumentInvoiceLog::generateDocumentNumber($user_id, $upline_user_id),
            ]);

            $order = Order::findOrFail(request('id'));
            $order_item = OrderItem::where('order_id', $order_id)->select(DB::raw('SUM(product_quantity) AS product_quantity'))->first();
            $product_quantity = 1;
            if($order_item) {
                $product_quantity = $order_item->product_quantity;
            }
//            $documentMBRInvoiceLog = DocumentMBRInvoiceLog::generateDocumentNumber($user_id, $upline_user_id, null, $order->amount, $product_quantity);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back();
        }

        return back();
    }

    public function readyToPick(Request $request)
    {
        $model = Order::findOrFail(request('id'));

        $model->update([
            'status' => 3,
        ]);

        return back();
    }

    public function orderAddProduct(Request $request)
    {
        $orderItem = OrderItem::findOrFail(request('order_item_id'));

        $product_qr = str_replace(' ', '', request('product_qr'));

        ScanLog::create([
            'qr_code' => $product_qr,
            'product_variant_id' => request('product_variant_id')
        ]);

        $productQuantity = ProductQuantity::whereProductVariantId(request('product_variant_id'))
            ->where('qr_code','like', '%'. $product_qr. '%')->whereStatus(2)->first();

        if ($productQuantity) {
            if ($productQuantity->status == 2) {

                if($orderItem->type == 2){
                    $productQuantity->update([
                        'order_item_id' => $orderItem->id,
                        'sold_to_user_id' => $orderItem->order->user_id,
                        'status' => 7
                    ]);
                }else{
                    $productQuantity->update([
                        'order_item_id' => $orderItem->id,
                        'sold_to_user_id' => $orderItem->order->user_id,
                        'status' => 3
                    ]);
                }
                return back();
            } else {
                if ($productQuantity->status == 1) {
                    return back()->with('error-' . $orderItem->id, trans('cruds.order.fields.product_qr_not_found') . " " . $product_qr);
                } else if ($productQuantity->status == 3 || $productQuantity->status == 4) {
                    return back()->with('error-' . $orderItem->id, trans('cruds.order.fields.product_unavailable'));
                }
            }
        }else{
            return back()->with('error-'.$orderItem->id, trans('cruds.order.fields.product_qr_not_found')." ".$product_qr);
        }
    }

    public function orderReleaseProduct(Request $request)
    {
        $productQuantity = ProductQuantity::findOrFail(request('product_quantity_id'));

        $productQuantity->update([
            'order_item_id' => null,
            'sold_to_user_id' => null,
            'status' => 2
        ]);
        return back();
    }

    public function orderDamageProduct(Request $request)
    {
        $productQuantity = ProductQuantity::findOrFail(request('product_quantity_id'));

        $productQuantity->update([
            'status' => 6
        ]);

        return back();
    }

    public function orderRemoveProduct(Request $request)
    {
        $orderItem = OrderItem::findOrFail(request('order_item_id'));
        $orderItem->delete();

        return back();
    }

    public function orderInvoicePdf($id)
    {

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

            $invoice_item_from_user['record'][$key]['type'] = $item->type;

            if($item->product_variant_id != null){
                $invoice_item_from_user['record'][$key]['product_name'] = $item->name;
                $invoice_item_from_user['record'][$key]['product_description'] = $item->product_color.', '. $item->product_size;
                $invoice_item_from_user['record'][$key]['product_quantity'] = $item->product_quantity;

                if($invoice->order_type == 2){
                    $invoice_item_from_user['record'][$key]['sales_price'] = $item->sales_price;
                    $invoice_item_from_user['record'][$key]['product_price'] = $item->purchase_price;
                    $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->purchase_price * $item->product_quantity;
                }else{
                    switch($roleNo) {
                        case 2: // Millionaire
                            $invoice_item_from_user['record'][$key]['sales_price'] = $item->sales_price;
                            $invoice_item_from_user['record'][$key]['product_price'] = $item->merchant_president_price;
                            $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->merchant_president_price * $item->product_quantity;
                            break;
                        case 4: // Manager
                            $invoice_item_from_user['record'][$key]['sales_price'] = $item->sales_price;
                            $invoice_item_from_user['record'][$key]['product_price'] = $item->agent_director_price;
                            $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->agent_director_price * $item->product_quantity;
                            break;
                        case 3: // Executive
                            $invoice_item_from_user['record'][$key]['sales_price'] = $item->sales_price;
                            $invoice_item_from_user['record'][$key]['product_price'] = $item->agent_executive_price;
                            $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->agent_executive_price * $item->product_quantity;
                            break;
                        case 8: // VIP
                            $invoice_item_from_user['record'][$key]['sales_price'] = $item->sales_price;
                            $invoice_item_from_user['record'][$key]['product_price'] = $item->sales_price;
                            $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->sales_price * $item->product_quantity;
                            break;
                        default:
                            $invoice_item_from_user['record'][$key]['sales_price'] = $item->sales_price;
                            $invoice_item_from_user['record'][$key]['product_price'] = $item->merchant_president_price;
                            $invoice_item_from_user['record'][$key]['total_per_variant'] = $item->merchant_president_price * $item->product_quantity;
                    }
                }

            }

        }

        $deposit_bank = DepositBank::whereId(1)->first();

        $subtotal = 0;
        foreach($invoice_item_from_user['record'] as $item) {
            $subtotal += $item['total_per_variant'];
        }

        $invoice_item_from_user['subtotal'] = $invoice->sub_total;

        // dd($invoice, $role, $display_price, $total_per_variant, $subtotal, $invoice_item_from_user);

        $pdf = PDF::loadView('user.print.order-invoice', compact('invoice', 'invoice_item_from_user', 'deposit_bank'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($invoice->name . ".pdf");
    }

    public function test()
    {
        foreach (Order::whereCollectType(1)->orderBy('created_at')->cursor() as $value){

            if($value->total_add_on != 0){
                echo $value->id." - ".$value->order_number." - ".$value->total_add_on." - ".$value->user_id."<br/>";

//                ShippingBalance::create([
//                    'amount' => $value->total_add_on,
//                    'user_id' => $value->user_id,
//                    'status' => 1,
//                    'settlement' => 1,
//                    'remark' => "refund order " . $value->order_number,
//                ]);
            }
        }
    }
}
