<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductQuantity;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function home()
    {
        return view('landing.home');
    }

    public function productAndServices()
    {
        return view('landing.product-and-services');
    }

    public function product()
    {
        $categories = ProductCategory::where('status', 1)->get();
        return view('landing.product', compact('categories'));
    }

    public function productList(Request $request)
    {
        $category_id = $request->category_id;
        $products = Product::where('category_id', $category_id)->where('status', 1)->where('type', 1)->get();
        foreach ($products as $product) {
            $variants = ProductVariant::where('product_id', $product->id)->where('status', 1)->get();

            $product->variants = $variants;
        }

        return view('user.components.products', compact('products'));
    }

    public function productDetails($id)
    {
        $type = 1;
        $product = Product::find($id);
        $color_variances = ProductVariant::where('product_id', $product->id)->where('status', 1)->groupBy('color_id')->get();

        $product->color_variances = $color_variances;
        $my_vips = [];

        return view('landing.product-details', compact('product', 'type', 'my_vips'));
    }

    public function getSizeVariant(Request $request)
    {
        $product = Product::find($request->product_id);
        $size_variants = ProductVariant::where('product_id', $product->id)->where('color_id', $request->color_id)->where('status', 1)->groupBy('size_id')->get();
        foreach ($size_variants as $size_variant) {
            $size_variant->size = ProductSize::find($size_variant->size_id);
        }

        return json_encode(['variances' => $size_variants]);
    }

    public function getQtyVariant(Request $request)
    {
        $product = Product::find($request->product_id);
        $qty_variances = ProductVariant::where('product_id', $product->id)->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)->where('status', 1)->get();
        foreach ($qty_variances as $qty_variance) {
            //noprice show to non member
            $qty_variance->price = 0;
        }

        return json_encode(['variances' => $qty_variances]);
    }

    public function about_us()
    {
        return view('landing.about-us');
    }

    public function join_us()
    {
        return view('landing.join-us');
    }

    public function product_qr_check()
    {
        return view('landing.product-qr-check');
    }

    public function product_qr_check_action(Request $request)
    {
        $product_code = $request->product_code;

        $validate = Validator::make($request->all(), [
            'product_code' => ['required', 'min:28', 'max:28'],
        ]);

        $validate->validate();

        $product_quantity = ProductQuantity::where('qr_code', $product_code)->where('order_item_id', '!=', null)->first();



        if (!$product_quantity) {

            return redirect()->route('landing.productQRCheck')->withErrors(['product_code' => __('landing.invalid_product_code')]);
        } else {
            $order_item = OrderItem::where('id', $product_quantity->order_item_id)->first();
            $order = Order::where('id', $order_item->order_id)->where('completed_at' ,'!=', null)->get();
            if(!$order){
                return redirect()->route('landing.productQRCheck')->withErrors(['product_code' => __('landing.invalid_product_code')]);
            }else{
                $order_item->product_variant = ProductVariant::find($order_item->product_variant_id);
                //show product details
                return view('landing.product-qr-check-details', compact('order_item'));
            }
        }

    }

    public function contact_us()
    {
        return view('landing.contact-us');
    }

//    public function contactUsAction(Request $request){
//
//
//        return redirect(route('landing.contactUs'))->with('message', __('landing.thank_you_for_contacting_us)'));
//    }

    public function privacyPolicy()
    {
        return view('user.privacy-policy');
    }

    public function termsOfUse()
    {
        return view('user.terms-of-use');
    }

    public function deliveryPolicy()
    {
        return view('user.delivery-policy');
    }

    public function refundReturnPolicy()
    {
        return view('user.refund-return-policy');
    }
}
