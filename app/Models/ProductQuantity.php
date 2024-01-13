<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQuantity extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Generate',
        '2' => 'In Stock',
        '3' => 'Allocate to order',
        '4' => 'Sold',
        '5' => 'Scanned',
        '6' => 'Damaged',
        '7' => 'FOC/Non-Profit',
        '8' => 'Sample',
    ];

    public $table = 'product_quantities';

    protected $dates = [
        'qr_generate_at',
        'in_stock_at',
        'sold_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'batch_id',
        'product_id',
        'product_variant_id',
        'order_item_id',
        'status',
        'sold_to_user_id',
        'qr_code',
        'qr_generate_at',
        'in_stock_at',
        'sold_at',
        'first_scan_at',
        'in_stock_by_id',
        'cost_price',
        'remark',
        'actual_stock',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function batch()
    {
        return $this->belongsTo(ProductBatch::class, 'batch_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function sold_to_user()
    {
        return $this->belongsTo(User::class, 'sold_to_user_id');
    }

    public function in_stock_by()
    {
        return $this->belongsTo(Admin::class, 'in_stock_by_id');
    }

    public function getQrGenerateAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setQrGenerateAtAttribute($value)
    {
        $this->attributes['qr_generate_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getInStockAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setInStockAtAttribute($value)
    {
        $this->attributes['in_stock_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getSoldAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setSoldAtAttribute($value)
    {
        $this->attributes['sold_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {

        if($request->has('product_name')){
            $query->when($request['product_name'] && filled($request['product_name']), function ($q) use($request) {
                $q->whereHas(
                    'product', function($q) use($request){
                        $q->where('name_en','like', '%'. $request['product_name']. '%');
                    }
                );
            });
        };

        if($request->has('product_batch')){
            $query->when($request['product_batch'] && filled($request['product_batch']), function ($q) use($request) {
                $q->whereHas(
                    'batch', function($q) use($request){
                        $q->where('name','like', '%'. $request['product_batch']. '%');
                    }
                );
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->where('status', 'like', '%'. $request['status'] . '%');
            });
        };

        if ($request->has('transaction')){
            $query->when($request['transaction'] && filled($request['transaction']), function($q) use($request){
                $q->where('transaction', 'like', '%'. $request['transaction'] . '%');
            });
        };

        if($request->has('sold_to_user')){
            $query->when($request['sold_to_user'] && filled($request['sold_to_user']), function ($q) use($request) {
                $q->whereHas(
                    'sold_to_user', function($q) use($request){
                        $q->where('name','like', '%'. $request['sold_to_user']. '%');
                    }
                );
            });
        };

        if ($request->has('batch_id')){
            $query->when($request['batch_id'] && filled($request['batch_id']), function($q) use($request){
                $q->where('batch_id', 'like', '%'. $request['batch_id'] . '%');
            });
        };

        return $query;
    }

}
