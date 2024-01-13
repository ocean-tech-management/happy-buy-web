<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Cart as CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Cart extends Component
{
    public $carts;
    public $selected_user_id;
    public $my_vips;
    public $modal_product_id;
    public $modal_product;
    public $modal_cart_id;
    public $fffff;
    protected $listeners = ['get_cart' => 'getCart'];

    public $can_check_out = false;
    //Summary
    public $wallet;
    public $productSubtotal = 0;

    public function mount(Request $request)
    {
        $this->selected_user_id = Auth::user()->id;
        if ($request->has('vip_id')) {
            //check if selected vip is own vip
            $user = User::where('user_type', 4)->where('direct_upline_id', Auth::user()->id)->where('id', $request->vip_id)->first();
            if (!$user) {
                return redirect()->route('user.cart2');
            }
            $this->selected_user_id = $request->vip_id;
        }
        $this->getCart();

        $this->my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 5)->get();

        $this->calculationSubtotal();

        $this->modal_product = [];
        $this->modal_cart_id = 0;

    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function removeCart($id)
    {
        \App\Models\Cart::whereId($id)->delete();

        $this->getCart();
        $this->calculationSubtotal();
        $this->emit('update_cart_vip_pv_summary');
    }

    public function removePackageCart($id)
    {
        $cart = \App\Models\Cart::whereId($id)->first();

        \App\Models\Cart::whereId($id)->delete();

        \App\Models\Cart::wherePackageId($id)->delete();

        if($cart->product_id == 59) {
            addToCart(Auth::user()->id, 127, 2);
        }else if($cart->product_id == 60){
            addToCart(Auth::user()->id, 127, 5);
        }else if($cart->product_id == 61){
            addToCart(Auth::user()->id, 127, 7);
        }

        $this->getCart();
        $this->calculationSubtotal();
        $this->emit('update_cart_vip_pv_summary');
    }

    public function updateQtyCart($id, $qty)
    {
        $cart = \App\Models\Cart::whereId($id)->first();
        $cart->quantity += $qty;
        $cart->save();

        $this->getCart();
        $this->calculationSubtotal();
        $this->emit('update_cart_vip_pv_summary');

    }

    public function getCart()
    {
//        $this->carts = CartModel::whereUserId(Auth::user()->id)->where('status', 1)
//            ->where(function ($query) {
//                if ($this->selected_user_id == Auth::user()->id) {
//                    $query->where('to_user_id', Auth::user()->id)
//                        ->orWhereNull('to_user_id');
//                } else {
//                    $query->where('to_user_id', $this->selected_user_id);
//                }
//
//            })->whereHas('product_variant', function ($q) {
//                $q->whereIn('type', [1, 2]);
//            })->get();

        $this->carts = CartModel::whereUserId(Auth::user()->id)->where('status', 1)
            ->where(function ($query) {
                if ($this->selected_user_id == Auth::user()->id) {
                    $query->where('to_user_id', Auth::user()->id)
                        ->orWhereNull('to_user_id');
                } else {
                    $query->where('to_user_id', $this->selected_user_id);
                }

            })->get();


        $total_product_variant_quantity = 0;

        $total_cart_quantity = 0;

        foreach ($this->carts as $cart){
            if($cart->is_package == 1){
                $total_product_variant_quantity += $cart->product->product_variant_quantity;
            }

            if($cart->is_package == 3){
                $total_cart_quantity += $cart->quantity;
            }
        }

        if($total_product_variant_quantity == $total_cart_quantity){
            $this->can_check_out = true;
        }else{
            $this->can_check_out = false;
        }


//        foreach ($this->carts as $item){
//
//            $package_item = CartModel::wherePackageId($item->id)->whereStatus(1)->whereType(1)->get();
//
//            $item->package_item = $package_item;
//        }

    }

    public function calculationSubtotal()
    {
        $this->productSubtotal = 0;
        foreach ($this->carts as $key => $cart) {
            $unit_price = 0;

            if ($this->wallet == 1) {
                if($cart->product_variant != NULL){
                    $unit_price = $cart->product_variant->agent_executive_price;
                }
            } else if ($this->wallet == 2) {
                if($cart->product_variant != NULL){
                    $unit_price = $cart->product_variant->agent_director_price;
                }
            } else if ($this->wallet == 3) {
                if($cart->product_variant != NULL){
                    $unit_price = $cart->product_variant->merchant_president_price;
                }
            } else if ($this->wallet == 4) {
                if($cart->product_variant != NULL){
                    $unit_price = $cart->product_variant->sales_price;
                }
            }
            $this->productSubtotal += ($cart->quantity * $unit_price);

        }
    }

    public function onWalletSelect()
    {
        $this->calculationSubtotal();
    }

    public function checkout()
    {
        if ($this->selected_user_id != Auth::guard('user')->user()->id) {
            return redirect()->route('user.cart.show.checkout', ['vip_id' => $this->selected_user_id, 'wallet_id' => $this->wallet]);
        } else {
            return redirect()->route('user.cart.show.checkout', ['wallet_id' => $this->wallet]);
        }
    }

    public function showModal($id)
    {
        $cart = \App\Models\Cart::whereId($id)->first();
        $this->modal_product_id = $cart->product_id;

        $product = Product::whereId($cart->product_id)->first()->product_list->pluck('id');

        $this->modal_product = ProductVariant::whereIn('product_id', $product)->whereStatus(1)->where(function ($query) {
            $query->where('type', 1)
                ->orWhere('type',2);
        })->get();

//        $this->modal_cart_id = CartModel::whereUserId(Auth::user()->id)->whereProductId($id)->whereStatus(1)->whereIsPackage(1)->value('id');
        $this->modal_cart_id = $id;

    }

    public function addToCart($id, $package_id, $product_id) //cart_id
    {
        $model = ProductVariant::whereId($id)->first();
        $product = Product::whereId($product_id)->first();

        $check_variant_quantity = CartModel::wherePackageId($package_id)->whereStatus(1)->whereType(1)->whereIsPackage(3)->sum('quantity');

        if($check_variant_quantity < $product->product_variant_quantity){

            if($product->product_variant_item_quantity != 0){
                $check_variant_item_quantity = CartModel::wherePackageId($package_id)->whereProductId($model->product->id)->whereStatus(1)->whereType(1)->whereIsPackage(3)->sum('quantity');

                if($check_variant_item_quantity < $product->product_variant_item_quantity){

                    $check_exists_in_cart = CartModel::whereProductVariantId($id)->wherePackageId($package_id)->whereStatus(1)->first();

                    if($check_exists_in_cart){
                        $check_exists_in_cart->update([
                            'quantity' => ($check_exists_in_cart->quantity + 1),
                        ]);
                    }else{
                        $cart = \App\Models\Cart::create([
                            'user_id' => $this->selected_user_id,
                            'product_id' => $model->product->id,
                            'product_variant_id' => $id,
                            'to_user_id' => $this->selected_user_id,
                            'quantity' => 1,
                            'status' => 1,
                            'type' => 1,
                            'is_package' => 3,
                            'package_id' => $package_id,
                        ]);
                    }

                    $this->getCart();
                    $this->calculationSubtotal();
                    $this->emit('update_cart_vip_pv_summary');
                }
            }else{

                $check_exists_in_cart = CartModel::whereProductVariantId($id)->wherePackageId($package_id)->whereStatus(1)->first();

                if($check_exists_in_cart){
                    $check_exists_in_cart->update([
                        'quantity' => ($check_exists_in_cart->quantity + 1),
                    ]);
                }else{
                    $cart = \App\Models\Cart::create([
                        'user_id' => $this->selected_user_id,
                        'product_id' => $model->product->id,
                        'product_variant_id' => $id,
                        'to_user_id' => $this->selected_user_id,
                        'quantity' => 1,
                        'status' => 1,
                        'type' => 1,
                        'is_package' => 3,
                        'package_id' => $package_id,
                    ]);
                }


                $this->getCart();
                $this->calculationSubtotal();
                $this->emit('update_cart_vip_pv_summary');
            }
        }else{

        }


    }

}
