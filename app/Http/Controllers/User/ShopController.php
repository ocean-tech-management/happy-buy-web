<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function shop()
    {
        $type = 1; //normal and promotion product
        $product_ids = ProductVariant::whereIn('type', [1, 2])->groupby('product_id')->pluck('product_id');
        // $product_category_ids = Product::whereIn('id', $product_ids)->groupby('category_id')->pluck('category_id');
        $categories = ProductCategory::where('status', 1)->get();

        return view('user.shop', compact('categories', 'type'));
    }

    public function shopRedeem()
    {
        $type = 2; //only for redeem product for vip
        //listout all categories that have redeem variant

        $product_ids = ProductVariant::where('type', 3)->groupby('product_id')->pluck('product_id');
        $product_category_ids = Product::whereIn('id', $product_ids)->groupby('category_id')->pluck('category_id');
        $categories = ProductCategory::whereIn('id', $product_category_ids)->where('status', 1)->get();

        return view('user.shop', compact('categories', 'type'));
    }

    public function productList(Request $request)
    {
        $category_id = $request->category_id;
        $type = 1;
        if ($request->has('type')) {
            $type = $request->type;
        }
//        $products = Product::where('category_id', $category_id)->where('status', 1)->where(function ($q) use ($type) {
//            $product_ids = ProductVariant::whereIn('type', $type == 1 ? [1, 2] : [3])->groupby('product_id')->pluck('product_id');
//            $q->whereIn('id', $product_ids)->get();
//        })->get();
        $products = Product::where('category_id', $category_id)->where('status', 1)
        ->where('type', $type)->get();
        
//         {$product_ids = ProductVariant::whereIn('type', $type == 1 ? [1, 2] : [3])->groupby('product_id')->pluck('product_id');
//             $q->where(function ($qq) use ($product_ids){
//                 $qq->whereIn('id', $product_ids);
// //                    ->orWhere('type', '2');
            // })->get();
        // })->get();
        

        foreach ($products as $product) {
            $variants = ProductVariant::where('product_id', $product->id)->where('status', 1)->whereIn('type', $type == 1 ? [1, 2] : [3])->get();

            $product->variants = $variants;
        }

        return view('user.components.products', compact('products'));
    }

    public function productDetails($id)
    {
        $type = 1;
        $product = Product::find($id);
        $color_variances = ProductVariant::where('product_id', $product->id)->whereIn('type', [1,2])->groupBy('color_id')->get();
        if(!$color_variances){
           return redirect()->back();
        }else {
            $product->color_variances = $color_variances;
            $total_images = 0;
            if ($product->image_1) {
                $total_images += 1;
            }
            if ($product->image_2) {
                $total_images += 1;
            }
            if ($product->image_3) {
                $total_images += 1;
            }
            if ($product->image_4) {
                $total_images += 1;
            }
            if ($product->image_5) {
                $total_images += 1;
            }

            $product->total_images = $total_images;

            $downlines = User::where('upline_user_id', Auth::user()->id)->role(['Agent-Executive','Agent-Manager'])->where('user_type', '!=',4)->pluck('id');

            $my_vips = User::where(function ($q) use ($downlines) {
                $q->where('direct_upline_id', Auth::user()->id)
                    ->orWhereIn('direct_upline_id', $downlines);
            })->where('user_type', 5)->get();

            return view('landing.product-details', compact('product', 'my_vips', 'type', 'downlines'));
        }
    }

    public function redeemProductDetails($id)
    {
        $type = 2;
        $product = Product::find($id);
        $color_variances = ProductVariant::where('product_id', $product->id)->where('type', 3)->groupBy('color_id')->get();
        if(!$color_variances){
            return redirect()->back();
        }else {
            $product->color_variances = $color_variances;
            $total_images = 0;
            if ($product->image_1) {
                $total_images += 1;
            }
            if ($product->image_2) {
                $total_images += 1;
            }
            if ($product->image_3) {
                $total_images += 1;
            }
            if ($product->image_4) {
                $total_images += 1;
            }
            if ($product->image_5) {
                $total_images += 1;
            }

            $product->total_images = $total_images;
            $my_vips = User::where('direct_upline_id', Auth::user()->id)->where('user_type', 4)->get();
            return view('landing.product-details', compact('product', 'my_vips', 'type'));
        }
    }

    public function getSizeVariant(Request $request)
    {
        $product = Product::find($request->product_id);
        $type = 1;
        if ($request->has('type')) {
            $type = $request->type;
        }

        $size_variances = ProductVariant::where('product_id', $product->id)->where('color_id', $request->color_id)->whereIn('type', $type == 1 ? [1, 2] : [3])->where('status', 1)->groupBy('size_id')->get();
        foreach ($size_variances as $size_variance) {
            $size_variance->size = ProductSize::find($size_variance->size_id);
            $size_variance->price = $size_variance->price;
        }

        return json_encode(['variances' => $size_variances]);
    }

    public function getQtyVariant(Request $request)
    {
        $product = Product::find($request->product_id);
        $qty_variances = ProductVariant::where('product_id', $product->id)->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)->where('status', 1)->get();
        foreach ($qty_variances as $qty_variance) {
            $qty_variance->price = $qty_variance->price;
        }

        return json_encode(['variances' => $qty_variances]);
    }


//    public function addToCart(Request $request)
//    {
//        $cart = Cart::create([
//            'product_variant_id' => $request->variant_id,
//            'product_id' => $request->product_id,
//            'quantity' => 1,
//            'status' => 1,
//            'user_id' => Auth::user()->id,
//        ]);
//
//        if ($cart) {
//            return json_encode(['success' => true]);
//        } else {
//            return json_encode(['success' => false]);
//        }
//    }

    public function addToCart(Request $request)
    {
        $product_variant_id = request('product_variant_id');
        $product_id = request('product_id');

        if($product_variant_id != 0){
            $variant = ProductVariant::findOrFail($request->product_variant_id);
            //check if item already exist in cart
            $current_cart_with_selected_product_n_variant = Cart::where('user_id', Auth::user()->id)->where('product_id', $variant->product_id)
                ->where('product_variant_id', $variant->id)
                ->where('to_user_id', $request->to_user_id)
                ->where('status', 1)->first();

//            if ($current_cart_with_selected_product_n_variant) {
//                $cart = $current_cart_with_selected_product_n_variant->update([
//                    'quantity' => $current_cart_with_selected_product_n_variant->quantity + $request->quantity,
//                ]);
//            } else {
                $request->request->add(['product_id' => $variant->product_id]);
                $request->request->add(['quantity' => $request->quantity]);

                //todo to_user_id : either self or vip id
                $request->request->add(['to_user_id' => $request->to_user_id]);
                $request->request->add(['type' => 1]);
                $request->request->add(['is_package' => 2]);
                $cart = Cart::create($request->all());
            //}
            promotionItemUpdate(Auth::user()->id);
            if ($cart) {
                return json_encode(['success' => true]);
            } else {
                return json_encode(['success' => false]);
            }
        }else{

            $current_cart_with_selected_product_ = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)
                ->where('to_user_id', $request->to_user_id)
                ->where('status', 1)->first();

//            if ($current_cart_with_selected_product_) {
//                $cart = $current_cart_with_selected_product_->update([
//                    'quantity' => $current_cart_with_selected_product_->quantity + $request->quantity,
//                ]);
//            } else {
                $request->request->add(['product_id' => $product_id]);
                $request->request->add(['quantity' => $request->quantity]);

                //todo to_user_id : either self or vip id
                $request->request->add(['to_user_id' => $request->to_user_id]);
                $request->request->add(['type' => 1]);

                $request->request->add(['product_variant_id' => NULL]);
                $request->request->add(['is_package' => 1]);
                $cart = Cart::create($request->all());

                if($product_id == 59){
                    addToCart($request->to_user_id, 127, 2);
                }else if($product_id == 60){
                    addToCart($request->to_user_id, 127, 5);
                }else if($product_id == 61){
                    addToCart($request->to_user_id, 127, 7);
                }

//            }
            promotionItemUpdate(Auth::user()->id);
            if ($cart) {
                return json_encode(['success' => true]);
            } else {
                return json_encode(['success' => false]);
            }
        }
    }
}
