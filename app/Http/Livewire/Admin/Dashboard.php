<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductQuantity;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Livewire\Component;

class Dashboard extends Component
{
    public $order;
    public $products;
    public $productSize;
    public $productColor;
    public $startDate;
    public $endDate;

    public $productId;
    public $productSizeName;
    public $productColorName;

    public function mount()
    {
        $this->products = Product::whereStatus(1)->whereType(1)->get();
        $this->productSize = ProductSize::whereStatus(1)->get();
        $this->productColor = ProductColor::whereStatus(1)->get();

        $this->updateSearch();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }

    public function searchProductSales($productId, $productSize, $productColor, $date)
    {

    }

    public function updatedProductId($value)
    {
        $this->productId = $value;
        $this->updateSearch();
    }

    public function updatedProductSizeName($value)
    {
        $this->productSizeName = $value;
        $this->updateSearch();
    }

    public function updatedProductColorName($value)
    {
        $this->productColorName = $value;
        $this->updateSearch();
    }

    public function updateSearch()
    {
        $start = $this->startDate;
        $end = $this->endDate;
        $productId = $this->productId;
        $productSizeName = $this->productSizeName;
        $productColorName = $this->productColorName;

        $this->order = Order::when($this->startDate, function($query) use ($start, $end, $productId, $productSizeName, $productColorName){
            return $query->whereBetween('orders.completed_at', [$start, $end]);
        }, function($query) use ($end){
            return $query->whereDate('orders.completed_at', $end);
        })->where('orders.status',5)
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->where('order_items.product_variant_id','!=', null)
            ->when($productId,
                function($query) use ($productId) {
                    return $query
                        ->where('order_items.product_id', '=', $productId);
                })
            ->when($productSizeName,
                function($query) use ($productSizeName) {
                    return $query
                        ->where('order_items.product_size', '=', $productSizeName);
                })
            ->when($productColorName,
                function($query) use ($productColorName) {
                    return $query
                        ->where('order_items.product_color', '=', $productColorName);
                })
            ->selectRaw("order_items.product_id,order_items.product_variant_id,order_items.product_name_en, order_items.product_size, order_items.product_color, SUM(order_items.product_quantity) as total")
            ->groupBy('order_items.product_variant_id')->orderByDesc('total')->get();

        foreach ($this->order as $item){

            $stock_total = ProductQuantity::where('product_variant_id', $item->product_variant_id)->whereIn('status',[2,3,4,5,6,7])->whereIn('actual_stock', [1,2])->count();
            $stock_balance = ProductQuantity::where('product_variant_id', $item->product_variant_id)->whereIn('status',[2])->whereIn('actual_stock', [1,2])->count();
            $item->stock_total = $stock_total;

            if($end == "2023-09-23 23:59:59"){

                if($item->product_variant_id == '167') {
                    $item->stock_balance = 15;
                }else if($item->product_variant_id == '170'){
                    $item->stock_balance = 12;
                }else if($item->product_variant_id == '142'){
                    $item->stock_balance = 8;
                }else if($item->product_variant_id == '143'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '144'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '145'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '146'){
                    $item->stock_balance = 51;
                }else if($item->product_variant_id == '147'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '149'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '150'){
                    $item->stock_balance = 11;
                }else if($item->product_variant_id == '151'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '21'){
                    $item->stock_balance = 12;
                }else if($item->product_variant_id == '22'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '23'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '24'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '25'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '74'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '75'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '76'){
                    $item->stock_balance = 107;
                }else if($item->product_variant_id == '77'){
                    $item->stock_balance = 119;
                }else if($item->product_variant_id == '78'){
                    $item->stock_balance = 192;
                }else if($item->product_variant_id == '133'){
                    $item->stock_balance = 127;
                }else if($item->product_variant_id == '134'){
                    $item->stock_balance = 53;
                }else if($item->product_variant_id == '135'){
                    $item->stock_balance = 133;
                }else if($item->product_variant_id == '136'){
                    $item->stock_balance = 110;
                }else if($item->product_variant_id == '137'){
                    $item->stock_balance = 154;
                }else if($item->product_variant_id == '79'){
                    $item->stock_balance = 3;
                }else if($item->product_variant_id == '80'){
                    $item->stock_balance = 4;
                }else if($item->product_variant_id == '81'){
                    $item->stock_balance = 157;
                }else if($item->product_variant_id == '82'){
                    $item->stock_balance = 105;
                }else if($item->product_variant_id == '83'){
                    $item->stock_balance = 142;
                }else if($item->product_variant_id == '84'){
                    $item->stock_balance = 156;
                }else if($item->product_variant_id == '85'){
                    $item->stock_balance = 54;
                }else if($item->product_variant_id == '86'){
                    $item->stock_balance = 70;
                }else if($item->product_variant_id == '87'){
                    $item->stock_balance = 107;
                }else if($item->product_variant_id == '88'){
                    $item->stock_balance = 65;
                }else if($item->product_variant_id == '47'){
                    $item->stock_balance = 6;
                }else if($item->product_variant_id == '48'){
                    $item->stock_balance = 95;
                }else if($item->product_variant_id == '49'){
                    $item->stock_balance = 176;
                }else if($item->product_variant_id == '50'){
                    $item->stock_balance = 229;
                }else if($item->product_variant_id == '95'){
                    $item->stock_balance = 82;
                }else if($item->product_variant_id == '51'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '52'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '53'){
                    $item->stock_balance = 1;
                }else if($item->product_variant_id == '54'){
                    $item->stock_balance = 64;
                }else if($item->product_variant_id == '96'){
                    $item->stock_balance = 68;
                }else if($item->product_variant_id == '128'){
                    $item->stock_balance = 61;
                }else if($item->product_variant_id == '129'){
                    $item->stock_balance = 255;
                }else if($item->product_variant_id == '130'){
                    $item->stock_balance = 235;
                }else if($item->product_variant_id == '131'){
                    $item->stock_balance = 147;
                }else if($item->product_variant_id == '132'){
                    $item->stock_balance = 288;
                }else if($item->product_variant_id == '30'){
                    $item->stock_balance = 97;
                }else if($item->product_variant_id == '31'){
                    $item->stock_balance = 98;
                }else if($item->product_variant_id == '32'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '33'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '26'){
                    $item->stock_balance = 139;
                }else if($item->product_variant_id == '27'){
                    $item->stock_balance = 116;
                }else if($item->product_variant_id == '28'){
                    $item->stock_balance = 9;
                }else if($item->product_variant_id == '29'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '89'){
                    $item->stock_balance = 78;
                }else if($item->product_variant_id == '90'){
                    $item->stock_balance = 48;
                }else if($item->product_variant_id == '91'){
                    $item->stock_balance = 89;
                }else if($item->product_variant_id == '92'){
                    $item->stock_balance = 126;
                }else if($item->product_variant_id == '93'){
                    $item->stock_balance = 144;
                }else if($item->product_variant_id == '98'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '99'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '100'){
                    $item->stock_balance = 8;
                }else if($item->product_variant_id == '101'){
                    $item->stock_balance = 11;
                }else if($item->product_variant_id == '102'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '103'){
                    $item->stock_balance = 13;
                }else if($item->product_variant_id == '104'){
                    $item->stock_balance = 35;
                }else if($item->product_variant_id == '105'){
                    $item->stock_balance = 21;
                }else if($item->product_variant_id == '106'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '107'){
                    $item->stock_balance = 86;
                }else if($item->product_variant_id == '108'){
                    $item->stock_balance = 99;
                }else if($item->product_variant_id == '109'){
                    $item->stock_balance = 54;
                }else if($item->product_variant_id == '171'){
                    $item->stock_balance = 91;
                }else if($item->product_variant_id == '172'){
                    $item->stock_balance = 125;
                }else if($item->product_variant_id == '173'){
                    $item->stock_balance = 109;
                }else if($item->product_variant_id == '174'){
                    $item->stock_balance = 116;
                }else if($item->product_variant_id == '152'){
                    $item->stock_balance = 211;
                }else if($item->product_variant_id == '153'){
                    $item->stock_balance = 185;
                }else if($item->product_variant_id == '154'){
                    $item->stock_balance = 133;
                }else if($item->product_variant_id == '155'){
                    $item->stock_balance = 32;
                }else if($item->product_variant_id == '156'){
                    $item->stock_balance = 276;
                }else if($item->product_variant_id == '157'){
                    $item->stock_balance = 189;
                }else if($item->product_variant_id == '158'){
                    $item->stock_balance = 185;
                }else if($item->product_variant_id == '159'){
                    $item->stock_balance = 122;
                }else if($item->product_variant_id == '63'){
                    $item->stock_balance = 4;
                }else if($item->product_variant_id == '64'){
                    $item->stock_balance = 25;
                }else if($item->product_variant_id == '65'){
                    $item->stock_balance = 40;
                }else if($item->product_variant_id == '57'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '58'){
                    $item->stock_balance = 3;
                }else if($item->product_variant_id == '59'){
                    $item->stock_balance = 57;
                }else if($item->product_variant_id == '110'){
                    $item->stock_balance = 5;
                }else if($item->product_variant_id == '111'){
                    $item->stock_balance = 11;
                }else if($item->product_variant_id == '112'){
                    $item->stock_balance = 37;
                }else if($item->product_variant_id == '66'){
                    $item->stock_balance = 27;
                }else if($item->product_variant_id == '67'){
                    $item->stock_balance = 43;
                }else if($item->product_variant_id == '68'){
                    $item->stock_balance = 66;
                }else if($item->product_variant_id == '11'){
                    $item->stock_balance = 14;
                }else if($item->product_variant_id == '12'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '13'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '14'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '15'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '34'){
                    $item->stock_balance = 16;
                }else if($item->product_variant_id == '35'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '36'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '37'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '38'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '1'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '2'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '3'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '4'){
                    $item->stock_balance = 16;
                }else if($item->product_variant_id == '5'){
                    $item->stock_balance = 27;
                }else if($item->product_variant_id == '6'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '7'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '8'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '9'){
                    $item->stock_balance = 0;
                }else if($item->product_variant_id == '10'){
                    $item->stock_balance = 0;
                }else{
                    $item->stock_balance = $stock_balance;
                }
            }else{
                $item->stock_balance = $stock_balance;
            }

            $stock_total_time = ProductQuantity::where('product_variant_id', $item->product_variant_id)->whereBetween('created_at', [$start, $end])->whereIn('status',[2,3,4,5,6,7])->whereIn('actual_stock', [1,2])->count();
            $stock_balance_time = ProductQuantity::where('product_variant_id', $item->product_variant_id)->whereBetween('created_at', [$start, $end])->whereIn('status',[2])->whereIn('actual_stock', [1,2])->count();
            $item->stock_total_time = $stock_total_time;
            $item->stock_balance_time = $stock_balance_time;
        }

    }

    public function clearSearch()
    {
        $this->productId = null;
        $this->productSizeName = null;
        $this->productColorName = null;

        $this->updateSearch();
    }
}
