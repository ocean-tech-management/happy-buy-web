<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCartRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\CashVoucherBalance;
use App\Models\ModelHasRole;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\State;
use App\Models\TransactionIdLog;
use App\Models\User;
use App\Models\PvBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CartController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cart_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Cart::with(['user', 'product', 'product_variant'])->search($request)->select(sprintf('%s.*', (new Cart())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cart_show';
                $editGate = 'cart_edit';
                $deleteGate = 'cart_delete';
                $crudRoutePart = 'carts';

                return view('partials.datatablesActions_Cart', compact(
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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('product_name_en', function ($row) {
                return $row->product ? $row->product->name_en : '';
            });

            $table->addColumn('product_variant_quantity', function ($row) {
                return $row->product_variant ? $row->product_variant->color->name.", ".$row->product_variant->size->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Cart::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Cart::TYPE_SELECT[$row->type] : 'Sales';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'product', 'product_variant']);

            return $table->make(true);
        }

        return view('admin.carts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cart_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $from_users = User::whereHas(
            'roles', function($q) {
                $q->where('name', '!=', 'VIP');
            }
        )->whereNotIn('id', [2,3])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $to_users = User::whereNotIn('id', [1,2,3])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.carts.create', compact('from_users', 'to_users', 'products', 'product_variants'));
    }

    public function store(StoreCartRequest $request)
    {
        DB::beginTransaction();
        try {
            $variant = ProductVariant::findOrFail($request->product_variant_id);
            $request->request->add(['product_id' => $variant->product_id]);
            $request->request->add(['quantity' => request('quantity')]);
            $request->request->add(['admin_id' => Auth::user()->id]);
            $cart = Cart::create($request->all());

            promotionItemUpdate($request->user_id);

            $checkIsVIP = ModelHasRole::where('model_id', $request->to_user_id)
            ->where('role_id', 8)->first();

            if($request->user_id == 1 && $checkIsVIP) {
                // $data = (new OrderController)->checkout($request);
                // Auto Checkout if from user is 1 (Erya)

                // $erya_user = User::where('id', 1)->first();
                $remark = "Erya help VIP buy product";
                $collect_type = 2; // Shipping
                $vip_user = User::where('id', $request->to_user_id)->first();
                $vip_address_books = AddressBook::where('user_id',$vip_user->id)->first();

                $total_deduct_for_cash_voucher_count = 0;
                if($cart->product_variant->type == 1){
                    $total_deduct_for_cash_voucher_count += $cart->quantity;
                }
                $total_deduct_for_cash_voucher = ((intval($total_deduct_for_cash_voucher_count / 5) * 100) + ($total_deduct_for_cash_voucher_count % 5 * 15));
                $total_vip_price = $variant->sales_price * $request->quantity;

                // dd($request->all(), $vip_user, $vip_address_books, $variant, $cart, $total_vip_price, $total_deduct_for_cash_voucher, getUserPointBalance(1));

                $request->request->add(['receiver_name' => $vip_address_books->name]);
                $request->request->add(['receiver_phone' => $vip_address_books->phone]);
                $request->request->add(['receiver_address_1' => $vip_address_books->address_1]);
                $request->request->add(['receiver_address_2' => $vip_address_books->address_2]);
                $request->request->add(['receiver_city' => $vip_address_books->city]);
                $request->request->add(['receiver_state' => $vip_address_books->state->name]);
                $request->request->add(['receiver_postcode' => $vip_address_books->postcode]);

                $request->request->add(['pre_point_balance' => getUserPointBalance(1)]);
                $request->request->add(['post_point_balance' => getUserPointBalance(1) - $total_vip_price]);
                $request->request->add(['amount' => $total_vip_price]);
                $request->request->add(['wallet_type' => '4']);
                $request->request->add(['voucher_amount' => 0]);
                $request->request->add(['sub_total' => $total_vip_price]);
                $request->request->add(['total_add_on' => 0]);
                $request->request->add(['total_shipping' => 0]);
                $request->request->add(['cash_voucher_amount' => $total_deduct_for_cash_voucher]);
                $request->request->add(['payment_method_id' => 4]);
                $request->request->add(['collect_type' => $collect_type]);
                $request->request->add(['invoice_user_id' => 1]);
                $request->request->add(['order_user_id' => $vip_user->id]);
                $request->request->add(['remark' => $remark]);

                $order = Order::create($request->all());

                if ($order) {
                    $total_deduct_for_cash_voucher_count = 0;
                    $total_vip_price = 0;

                    if ($cart->product_variant->type == 1) {
                        $total_deduct_for_cash_voucher_count += $cart->quantity;
                    }
                    $total_vip_price += ($cart->product_variant->sales_price * $cart->quantity);
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
                    ]);
                    //update cart to check out
                    $cart->update([
                        'status' => 2
                    ]);

                    $order_number = TransactionIdLog::generateTransactionId(2, $order->user_id, $order->id);
                    $order->update([
                        'order_number' => $order_number,
                    ]);

                    PvBalance::create([
                        'amount' => '-' . $total_vip_price,
                        'user_id' => $vip_user->id,
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "redeem order " . $order_number,
                    ]);

                    // Vip Cash Voucher Part
                    $total_deduct_for_cash_voucher = ((intval($total_deduct_for_cash_voucher_count / 5) * 100) + ($total_deduct_for_cash_voucher_count % 5 * 15));
                    $balance = 0;
                    if (getCashVoucherBalance($vip_user->id) > $total_deduct_for_cash_voucher) {
                        $balance = getCashVoucherBalance($vip_user->id) - $total_deduct_for_cash_voucher;
                    } else {
                        $total_deduct_for_cash_voucher = getCashVoucherBalance($vip_user->id);
                    }
                    $cart_user = User::find($vip_user->id);
                    if(Carbon::parse($cart_user->date_of_birth)->month == date('n')){
                        if(!checkIfVIPOrderedThisMonth($vip_user->id)){ //only accept one order per birthday user.
                            $total_deduct_for_cash_voucher = 0;
                            $total_deduct_for_cash_voucher += (intval($total_deduct_for_cash_voucher_count/5) * 160);
                            $item_left = $total_deduct_for_cash_voucher_count % 5;
                            if($item_left <= 3){
                                $total_deduct_for_cash_voucher += $item_left * 25;
                            }else if($item_left == 4){
                                $total_deduct_for_cash_voucher += 90;
                            }
                            $balance = 0;
                            if(getCashVoucherBalance($vip_user->id) > $total_deduct_for_cash_voucher){
                                $balance = getCashVoucherBalance($vip_user->id) - $total_deduct_for_cash_voucher;
                            }else{
                                $total_deduct_for_cash_voucher = getCashVoucherBalance($vip_user->id);
                            }
                        }
                    }

                    CashVoucherBalance::create([
                        'user_id' => $vip_user->id,
                        'amount' => -($total_deduct_for_cash_voucher),
                        'status' => 1,
                        'settlement' => 1,
                        'remark' => "vip redeem order " . $order_number,
                    ]);

                }

            }
            // dd("STOP",$request->all());

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
        }

        return redirect()->route('admin.carts.index');
    }

    public function fetchAddressBook(Request $request) {
        $select = $request->select;
        $value = $request->value;
        $dependent = $request->dependent;
        $output = null;
        $output .= '<option value="">Address Book</option>';
        //$output .= '<option value="">'trans('custom.email-blast.fields.sub-target-group')'</option>';
        // dd($request->all());
        if($select == "to_user_id")
        {
            $data = AddressBook::where('user_id', $request->value)->get();
            foreach($data as $row) {
                $output .= '<option value="'.$row->id.'">'.$row->name. ' ' . $row->phone . ' ' . $row->address_1. ' ' . $row->address_2 . ' ' . $row->postcode . ' ' . $row->city . ' ' .  $row->state->name . '</option>';
            }
        }

        echo $output;
    }

    public function fetchCart(Request $request) {

        $user_id = $request->user_id;

        $carts = Cart::with(['product_variant'])->whereUserId($user_id)->whereStatus(1)->get();


        if(count($carts)>0){
            $output = "<div><strong>Cart Item</strong></div>";
            $output .= "<table class='table'>";
            $output .= "<th>SKU</th>";
            $output .= "<th>Product Name</th>";
            $output .= "<th>Color</th>";
            $output .= "<th>Size</th>";
            $output .= "<th>Millionaire Price</th>";
            $output .= "<th>Manager Price</th>";
            $output .= "<th>Executive Price</th>";
            $output .= "<th>Quantity</th>";
            foreach($carts as $item) {

                if($item->product_variant != NULL){
                    $output .= "<tr>";
                    $output .= "<td>".$item->product_variant->sku."</td><td>".$item->product_variant->product->name_en." - ".$item->product_variant->product->name_zh."</td><td>".$item->product_variant->color->name."</td><td>".$item->product_variant->size->name."</td><td>".$item->product_variant->merchant_president_price."</td><td>".$item->product_variant->agent_director_price."</td><td>".$item->product_variant->agent_executive_price."</td><td>".$item->quantity."</td><td>";
                    $output .= "</tr>";
                }
            }
            $output .= "</table>";
        }else{
            $output = "<div><strong>Cart empty</strong></div>";
        }


        return $output;
    }

    public function edit(Cart $cart)
    {
        abort_if(Gate::denies('cart_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cart->load('user', 'product', 'product_variant');

        return view('admin.carts.edit', compact('users', 'products', 'product_variants', 'cart'));
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $variant = ProductVariant::findOrFail($request->product_variant_id);
        $request->request->add(['product_id' => $variant->product_id]);
        $request->request->add(['quantity' => request('quantity')]);
        $cart->update($request->all());

        return redirect()->route('admin.carts.index');
    }

    public function show(Cart $cart)
    {
        abort_if(Gate::denies('cart_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cart->load('user', 'product', 'product_variant');

        return view('admin.carts.show', compact('cart'));
    }

    public function destroy(Cart $cart)
    {
        abort_if(Gate::denies('cart_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cart->delete();

        return back();
    }

    public function massDestroy(MassDestroyCartRequest $request)
    {
        Cart::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
