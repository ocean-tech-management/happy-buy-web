<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class OrderItem extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        '1' => 'Sales',
        '2' => 'Free',
    ];

    public $table = 'order_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'product_name_en',
        'product_name_zh',
        'product_desc_en',
        'product_desc_zh',
        'product_quantity',
        'product_color',
        'product_size',
        'product_sku',
        'purchase_price',
        'sales_price',
        'merchant_president_price',
        'agent_director_price',
        'agent_executive_price',
        'vip_redeem_pv',
        'price_add_on',
        'type',
        'admin_id',
        'parent_id',
        'is_new',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_detail()
    {
        return $this->hasMany(ProductQuantity::class, 'order_item_id')->where('status', '!=', 6);
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function child_list()
    {
        return $this->hasMany(OrderItem::class, 'parent_id');
    }

    public function getNameAttribute(){
        if (App::isLocale('en')) {
            return $this->product_name_en;
        }else{
            return $this->product_name_zh;
        }
    }

    public function getPriceAttribute(){
        $user = User::find($this->order->user_id);
        if($user->user_type == 1){
            return $this->agent_executive_price;
        }else if ($user->user_type == 2){
            return $this->agent_director_price;
        }else if ($user->user_type == 3){
            return $this->merchant_president_price;
        }
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
